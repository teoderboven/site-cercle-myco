interface Subscriber {
    id: string | number;
    email: string;
    token: string;
}

interface PendingEmailPromise {
    resolve: (value: string | PromiseLike<string>) => void;
    reject: (reason?: any) => void;
}

interface ApiResponse {
    success?: boolean;
    message?: string;
    reminderAlreadyExists?: boolean;
    reminderNotFound?: boolean;
    subscriber?: Subscriber;
    errors?: Record<string, string[]>;
}

const subscriptionMailModal = document.getElementById("subscription-mail-modal") as HTMLDialogElement | null;
const mailForm = document.getElementById("subscription-mail-form") as HTMLFormElement | null;
const mailModalActivityTitleElement = subscriptionMailModal?.querySelector(".activity-title") as HTMLElement | null;

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

// storage keys
const storageSubscriberKey = 'subscriber';
const storageSubscribedActivityIdsKey = 'subscribed_activity_ids';

// error messages
const errorEmailPromptCancelledMessage = 'email_prompt_cancelled';

// global state variables
let pendingEmailPromise: PendingEmailPromise | null = null;
let activeActivityTitle: string | null = null;

// event listeners registration
mailForm?.addEventListener('submit', handleMailFormSubmit);
document.querySelectorAll<HTMLElement>(".notify-btn-wrapper").forEach(initNotifyButton);
subscriptionMailModal?.querySelectorAll<HTMLElement>(".close-btn").forEach(registerMailModalCloseListener);
subscriptionMailModal?.addEventListener('close', handleModalClose);

window.addEventListener('storage', (e: StorageEvent) => {
    if (e.key === storageSubscribedActivityIdsKey) {
        syncSubscribedButtons();
    }
});

// initial UI state synchronization
document.addEventListener('DOMContentLoaded', updateAndSyncActivitySubscriptions);

// ui and modal handling
/**
 * Updates the UI state of a notification button.
 */
function updateButtonState(notifyBtn: HTMLButtonElement, isSubscribed: boolean): void {
    const email = getCachedSubscriber()?.email;
    const {
        subscribedText = "Inscrit(e) aux notifications",
        notSubscribedText = "M'informer par e-mail",
        defaultLabel = "S'abonner aux notifications",
        subscribedLabel: templateLabel,
        emailMarker
    } = notifyBtn.dataset; // Destructure dataset with default values

    const baseLabel = (templateLabel && emailMarker && email)
        ? templateLabel.replace(emailMarker, email)
        : "Se désabonner des notifications";

    const subscribedLabel = `${baseLabel}\nCliquez pour vous désabonner`;

    const notifyBtnText = notifyBtn.querySelector(".notify-text");
    notifyBtn.dataset.subscribed = isSubscribed ? "true" : "false";

    if (notifyBtnText) {
        notifyBtnText.textContent = isSubscribed ? subscribedText : notSubscribedText;
    }
    notifyBtn.setAttribute('title', isSubscribed ? subscribedLabel : defaultLabel);
    notifyBtn.setAttribute('aria-label', isSubscribed ? subscribedLabel : defaultLabel);
}

/**
 * Synchronizes the display state of all notification buttons based on local storage.
 */
function syncSubscribedButtons(): void {
    const cachedIds = getCachedSubscribedActivityIds();

    document.querySelectorAll(".notify-btn-wrapper").forEach(btnWrapper => {
        const notifyBtn = btnWrapper.querySelector<HTMLButtonElement>(".notify-btn");
        if (!notifyBtn) return;

        const activityId = notifyBtn.dataset.activityId;
        if (activityId) {
            updateButtonState(notifyBtn, cachedIds.includes(activityId));
        }
    });
}

function updateAndSyncActivitySubscriptions(): void {
    getActivitySubscriptions().then((subscriptions: string[]) => {
        setCachedSubscribedActivityIds(subscriptions);
    }).finally(() => {
        syncSubscribedButtons();
    });
}

function registerMailModalCloseListener(closeBtn: HTMLElement): void {
    closeBtn.addEventListener("click", closeMailModal);
}

function openMailModal(): void {
    if (mailModalActivityTitleElement && activeActivityTitle) {
        mailModalActivityTitleElement.innerText = activeActivityTitle;
    }
    subscriptionMailModal?.showModal();
}

function closeMailModal(): void {
    subscriptionMailModal?.close();
}

/**
 * Handles the email modal cancellation or closure and rejects the pending request.
 */
function handleModalClose(): void {
    if (pendingEmailPromise) {
        pendingEmailPromise.reject(new Error(errorEmailPromptCancelledMessage));
        pendingEmailPromise = null;
    }
}

/**
 * Processes the mail form submission from the modal and resolves the pending email request.
 */
function handleMailFormSubmit(event: SubmitEvent): void {
    event.preventDefault();

    const formData = new FormData(event.target as HTMLFormElement);
    const email = formData.get('subscription-mail') as string | null;

    if (pendingEmailPromise) {
        if (email) {
            pendingEmailPromise.resolve(email);
        } else {
            pendingEmailPromise.reject(new Error('No email provided'));
        }
        pendingEmailPromise = null;
    } else {
        console.error('No pending email promise to resolve.');
    }

    closeMailModal();
}

// button component logic
function initNotifyButton(btnWrapper: HTMLElement): void {
    const notifyBtn = btnWrapper.querySelector<HTMLButtonElement>(".notify-btn");
    const statusMessage = btnWrapper.querySelector<HTMLElement>(".status-message");

    if (!notifyBtn || !statusMessage) return;

    const activityId = notifyBtn.dataset.activityId ?? '';
    const activityTitle = notifyBtn.dataset.activityTitle ?? '';

    notifyBtn.addEventListener("click", handleNotifyBtnClick);

    function handleNotifyBtnClick(_e: MouseEvent): void {
        activeActivityTitle = activityTitle;

        if (!isSubscribed()) handleSubscriptionRequest();
        else handleUnsubscribeRequest();
    }

    function handleSubscriptionRequest(): void {
        setLoading();
        getUserMail()
            .then(email => sendSubscriptionRequest(email, activityId))
            .then(handleSubscriptionResponse)
            .catch(err => {
                if (err.message !== errorEmailPromptCancelledMessage) {
                    console.error(err.message);
                    displayStatus('Une erreur est survenue lors de l\'inscription.', true);
                }
            })
            .finally(() => setLoadingComplete());
    }

    function handleUnsubscribeRequest(): void {
        setLoading();
        sendUnsubscriptionRequest(activityId)
            .then(handleUnsubscribeResponse)
            .catch(err => {
                if (err.message !== errorEmailPromptCancelledMessage) {
                    console.error(err.message);
                    displayStatus('Une erreur est survenue lors de la désinscription.', true);
                }
            })
            .finally(() => setLoadingComplete());
    }

    function handleSubscriptionResponse(response: ApiResponse): void {
        if (response.success || response.reminderAlreadyExists) {
            if (response.message) displayStatus(response.message);
            setSubscribed();

            const previousSubscriber = getCachedSubscriber();
            if (JSON.stringify(previousSubscriber) !== JSON.stringify(response.subscriber)) {
                console.log("Subscriber data has changed. Updating cached subscriber and syncing activity subscriptions.");
                setCachedSubscriber(response.subscriber);
                updateAndSyncActivitySubscriptions();
            }
        }
        else {
            if (response.errors?.email) {
                clearCachedSubscriber();
            }
            const errList = response.errors ? Object.values(response.errors).flat().join('\n') : 'Error';
            displayStatus(errList, true);
        }
    }

    function handleUnsubscribeResponse(response: ApiResponse): void {
        if (response.success) {
            if (response.message) displayStatus(response.message);
            setUnsubscribed();
        }
        else {
            if (response.reminderNotFound) {
                if (response.message) displayStatus(response.message, true);
                setUnsubscribed();
            } else {
                const errList = response.errors ? Object.values(response.errors).flat().join('\n') : 'Error';
                throw new Error(errList);
            }
        }
    }

    function setSubscribed(): void {
        if (notifyBtn) {
            updateButtonState(notifyBtn, true);
        }
        addCachedSubscribedActivityId(activityId);
    }

    function setUnsubscribed(): void {
        if (notifyBtn) {
            updateButtonState(notifyBtn, false);
        }
        removeCachedSubscribedActivityId(activityId);
    }

    function isSubscribed(): boolean {
        return notifyBtn?.dataset.subscribed === "true";
    }

    function setLoading(): void {
        if (!notifyBtn) return;
        notifyBtn.classList.add('loading');
        notifyBtn.disabled = true;
        notifyBtn.setAttribute('aria-busy', 'true');
    }

    function setLoadingComplete(): void {
        if (!notifyBtn) return;
        notifyBtn.classList.remove('loading');
        notifyBtn.disabled = false;
        notifyBtn.removeAttribute('aria-busy');
    }

    let messageTimeout: ReturnType<typeof setTimeout> | null = null;

    /**
     * Displays the given message below the button
     */
    function displayStatus(msg: string, isError = false): void {
        if (!statusMessage) return;

        const revealedClass = "revealed";
        statusMessage.classList.remove(revealedClass);

        const emailRegex = /([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/;

        if (emailRegex.test(msg)) {
            statusMessage.innerHTML = msg.replace(emailRegex, '<span class="status-email">$1</span>');
        } else {
            statusMessage.textContent = msg;
        }
        statusMessage.setAttribute("title", msg);

        statusMessage.classList.add(revealedClass);
        if (isError) {
            statusMessage.classList.add("error");
        } else {
            statusMessage.classList.remove("error");
        }

        if (messageTimeout) {
            clearTimeout(messageTimeout);
        }
        messageTimeout = setTimeout(() => {
            statusMessage.classList.remove(revealedClass);
            messageTimeout = null;
        }, 5000);
    }
}

// storage helpers
/**
 * Retrieves the user email from local storage subscriber data or opens a prompt modal if not cached.
 */
function getUserMail(forcePrompt = false): Promise<string> {
    if (!forcePrompt) {
        const subscriber = getCachedSubscriber();
        if (subscriber?.email) {
            return Promise.resolve(subscriber.email);
        }
    }

    return new Promise<string>((resolve, reject) => {
        pendingEmailPromise = { resolve, reject };
        openMailModal();
    });
}

function setCachedSubscriber(subscriber: Subscriber | undefined): void {
    if (subscriber) {
        localStorage.setItem(storageSubscriberKey, JSON.stringify(subscriber));
    }
}

function clearCachedSubscriber(): void {
    localStorage.removeItem(storageSubscriberKey);
}

function getCachedSubscriber(): Subscriber | null {
    const subscriber = localStorage.getItem(storageSubscriberKey);
    return subscriber ? (JSON.parse(subscriber) as Subscriber) : null;
}

function getCachedSubscribedActivityIds(): string[] {
    const activityIds = localStorage.getItem(storageSubscribedActivityIdsKey);
    return activityIds ? (JSON.parse(activityIds) as string[]) : [];
}

function addCachedSubscribedActivityId(activityId: string): void {
    const activityIds = getCachedSubscribedActivityIds();
    if (!activityIds.includes(activityId)) {
        activityIds.push(activityId);
        localStorage.setItem(storageSubscribedActivityIdsKey, JSON.stringify(activityIds));
    }
}

function removeCachedSubscribedActivityId(activityId: string): void {
    const activityIds = getCachedSubscribedActivityIds();
    const index = activityIds.indexOf(activityId);
    if (index !== -1) {
        activityIds.splice(index, 1);
        localStorage.setItem(storageSubscribedActivityIdsKey, JSON.stringify(activityIds));
    }
}

function setCachedSubscribedActivityIds(activityIds: string[]): void {
    localStorage.setItem(storageSubscribedActivityIdsKey, JSON.stringify(activityIds));
}

// api helpers
function sendNotificationApi(activityId: string, method: string, body: unknown): Promise<ApiResponse> {
    return fetch(`/api/activity/${activityId}/notifications`, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-Token': csrfToken
        },
        body: JSON.stringify(body)
    })
        .then(response => response.json());
}

function sendSubscriptionRequest(email: string, activityId: string): Promise<ApiResponse> {
    return sendNotificationApi(activityId, 'POST', { email });
}

function sendUnsubscriptionRequest(activityId: string): Promise<ApiResponse> {
    return sendNotificationApi(activityId, 'DELETE', { subscriber: getCachedSubscriber() });
}

/**
 * Fetches the list of activities the current subscriber is subscribed to.
 */
function getActivitySubscriptions(): Promise<string[]> {
    const subscriber = getCachedSubscriber();
    if (!subscriber) {
        return Promise.resolve([]);
    }

    return fetch(`api/subscriber/${subscriber.id}/activities`, {
        headers: {
            'X-Subscriber-Token': subscriber.token,
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then((data: { activityIds?: string[] }) => data.activityIds || []);
}
