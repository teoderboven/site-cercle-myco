(function(){
    const subscriptionMailModal = document.getElementById("subscription-mail-modal");
    const mailForm = document.getElementById("subscription-mail-form");
    const mailModalActivityTitleElement = subscriptionMailModal.querySelector(".activity-title");

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // storage keys
    const storageSubscriberKey = 'subscriber';
    const storageSubscribedActivityIdsKey = 'subscribed_activity_ids';

    // error messages
    const errorEmailPromptCancelledMessage = 'email_prompt_cancelled';

    // global state variables
    let pendingEmailPromise = null;
    let activeActivityTitle = null;

    // event listeners registration
    mailForm.addEventListener('submit', handleMailFormSubmit);
    document.querySelectorAll(".notify-btn-wrapper").forEach(initNotifyButton);
    subscriptionMailModal.querySelectorAll(".close-btn").forEach(registerMailModalCloseListener);
    subscriptionMailModal.addEventListener('close', handleModalClose);

    window.addEventListener('storage', (e) => {
        if (e.key === storageSubscribedActivityIdsKey) {
            syncSubscribedButtons();
        }
    });

    // initial UI state synchronization
    document.addEventListener('DOMContentLoaded', updateAndSyncActivitySubscriptions);

    // ui and modal handling
    /**
     * Updates the UI state of a notification button.
     * @param {HTMLElement} notifyBtn - The notification button element.
     * @param {boolean} isSubscribed - Subscription status to reflect.
     */
    function updateButtonState(notifyBtn, isSubscribed) {
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

        notifyBtnText.textContent = isSubscribed ? subscribedText : notSubscribedText;
        notifyBtn.setAttribute('title', isSubscribed ? subscribedLabel : defaultLabel);
        notifyBtn.setAttribute('aria-label', isSubscribed ? subscribedLabel : defaultLabel);
    }

    /**
     * Synchronizes the display state of all notification buttons based on local storage.
     */
    function syncSubscribedButtons() {
        const cachedIds = getCachedSubscribedActivityIds();

        document.querySelectorAll(".notify-btn-wrapper").forEach(btnWrapper => {
            const notifyBtn = btnWrapper.querySelector(".notify-btn");
            const activityId = notifyBtn.dataset.activityId;

            updateButtonState(notifyBtn, cachedIds.includes(activityId));
        });
    }

    function updateAndSyncActivitySubscriptions() {
        getActivitySubscriptions().then((subscriptions) => {
            setCachedSubscribedActivityIds(subscriptions);
        }).finally(() => {
            syncSubscribedButtons();
        });
    }

    function registerMailModalCloseListener(closeBtn) {
        closeBtn.addEventListener("click", closeMailModal);
    }

    function openMailModal() {
        mailModalActivityTitleElement.innerText = activeActivityTitle;
        subscriptionMailModal.showModal();
    }

    function closeMailModal() {
        subscriptionMailModal.close();
    }

    /**
     * Handles the email modal cancellation or closure and rejects the pending request.
     */
    function handleModalClose() {
        if (pendingEmailPromise) {
            pendingEmailPromise.reject(new Error(errorEmailPromptCancelledMessage));
            pendingEmailPromise = null;
        }
    }

    /**
     * Processes the mail form submission from the modal and resolves the pending email request.
     * @param {SubmitEvent} event - The form submission event object.
     */
    function handleMailFormSubmit(event) {
        event.preventDefault();

        const formData = new FormData(event.target);
        const email = formData.get('subscription-mail');

        if (pendingEmailPromise) {
            pendingEmailPromise.resolve(email);
            pendingEmailPromise = null;
        } else {
            console.error('No pending email promise to resolve.');
        }

        closeMailModal();
    }

    // button component logic
    function initNotifyButton(btnWrapper) {
        const notifyBtn = btnWrapper.querySelector(".notify-btn");
        const statusMessage = btnWrapper.querySelector(".status-message");

        const activityId = notifyBtn.dataset.activityId;
        const activityTitle = notifyBtn.dataset.activityTitle;

        notifyBtn.addEventListener("click", handleNotifyBtnClick);

        function handleNotifyBtnClick(e) {
            activeActivityTitle = activityTitle;

            if (!isSubscribed()) handleSubscriptionRequest();
            else handleUnsubscribeRequest();
        }

        function handleSubscriptionRequest() {
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

        function handleUnsubscribeRequest() {
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

        function handleSubscriptionResponse(response) {
            if (response.success || response.reminderAlreadyExists) {
                displayStatus(response.message);
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
                displayStatus(Object.values(response.errors).flat().join('\n'), true);
            }
        }

        function handleUnsubscribeResponse(response) {
            if (response.success) {
                displayStatus(response.message);
                setUnsubscribed();
            }
            else {
                if(response.reminderNotFound) {
                    displayStatus(response.message, true);
                    setUnsubscribed();
                } else {
                    throw new Error(Object.values(response.errors).flat().join('\n'));
                }
            }
        }

        function setSubscribed() {
            updateButtonState(notifyBtn, true);
            addCachedSubscribedActivityId(activityId);
        }

        function setUnsubscribed() {
            updateButtonState(notifyBtn, false);
            removeCachedSubscribedActivityId(activityId);
        }

        function isSubscribed() {
            return notifyBtn.dataset.subscribed === "true";
        }

        function setLoading() {
            notifyBtn.classList.add('loading');
            notifyBtn.disabled = true;
            notifyBtn.setAttribute('aria-busy', 'true');
        }

        function setLoadingComplete() {
            notifyBtn.classList.remove('loading');
            notifyBtn.disabled = false;
            notifyBtn.removeAttribute('aria-busy');
        }

        let messageTimeout;

        /**
         * Displays the given message below the button
         * @param msg the message to display
         * @param isError whether the message is an error
         */
        function displayStatus(msg, isError = false) {
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

            if(messageTimeout) {
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
     * @param {boolean} [forcePrompt=false] - If true, forces the modal to open even if the email is cached.
     * @returns {Promise<string>} A promise that resolves with the user email address.
     */
    function getUserMail(forcePrompt = false) {
        if (!forcePrompt) {
            const subscriber = getCachedSubscriber();
            if (subscriber?.email) {
                return Promise.resolve(subscriber.email);
            }
        }

        return new Promise((resolve, reject) => {
            pendingEmailPromise = { resolve, reject };
            openMailModal();
        });
    }

    function setCachedSubscriber(subscriber) {
        localStorage.setItem(storageSubscriberKey, JSON.stringify(subscriber));
    }

    function clearCachedSubscriber() {
        localStorage.removeItem(storageSubscriberKey);
    }

    function getCachedSubscriber() {
        const subscriber = localStorage.getItem(storageSubscriberKey);
        return subscriber ? JSON.parse(subscriber) : null;
    }

    function getCachedSubscribedActivityIds() {
        const activityIds = localStorage.getItem(storageSubscribedActivityIdsKey);
        return activityIds ? JSON.parse(activityIds) : [];
    }

    function addCachedSubscribedActivityId(activityId) {
        const activityIds = getCachedSubscribedActivityIds();
        if (!activityIds.includes(activityId)) {
            activityIds.push(activityId);
            localStorage.setItem(storageSubscribedActivityIdsKey, JSON.stringify(activityIds));
        }
    }

    function removeCachedSubscribedActivityId(activityId) {
        const activityIds = getCachedSubscribedActivityIds();
        const index = activityIds.indexOf(activityId);
        if (index !== -1) {
            activityIds.splice(index, 1);
            localStorage.setItem(storageSubscribedActivityIdsKey, JSON.stringify(activityIds));
        }
    }

    function setCachedSubscribedActivityIds(activityIds) {
        localStorage.setItem(storageSubscribedActivityIdsKey, JSON.stringify(activityIds));
    }

    // api helpers
    function sendNotificationApi(activityId, method, body) {
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

    function sendSubscriptionRequest(email, activityId) {
        return sendNotificationApi(activityId, 'POST', { email });
    }

    function sendUnsubscriptionRequest(activityId) {
        return sendNotificationApi(activityId, 'DELETE', { subscriber: getCachedSubscriber() });
    }

    /**
     * Fetches the list of activities the current subscriber is subscribed to.
     * @returns {Promise<any>|Promise<Awaited<*[]>>} A promise that resolves with an array of activity IDs the subscriber is subscribed to.
     */
    function getActivitySubscriptions() {
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
        .then(data => data.activityIds || []);
    }
})();