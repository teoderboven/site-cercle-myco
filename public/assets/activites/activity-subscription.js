(function(){
    const subscriptionMailModal = document.getElementById("subscription-mail-modal");
    const mailForm = document.getElementById("subscription-mail-form");
    const mailModalActivityTitleElement = subscriptionMailModal.querySelector(".activity-title");

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    mailForm.addEventListener('submit', handleMailFormSubmit);
    document.querySelectorAll(".notify-btn-wrapper").forEach(initNotifyButton);
    subscriptionMailModal.querySelectorAll(".close-btn").forEach(registerMailModalCloseListener);
    subscriptionMailModal.addEventListener('close', handleModalClose);

    // global state variables
    let pendingEmailPromise = null;
    let activeActivityTitle = null;

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
                    if (err.message !== 'email_prompt_cancelled') {
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
                    console.error(err.message);
                    displayStatus('Une erreur est survenue lors de la désinscription.', true);
                })
                .finally(() => setLoadingComplete());
        }

        function handleSubscriptionResponse(response) {
            if (response.success || response.reminderAlreadyExists) {
                displayStatus(response.message);
                setSubscribed();
                setCachedSubscriber(response.subscriber);
            }
            else {
                if(response.errors?.email){
                    clearCachedEmail();
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
                throw new Error(Object.values(response.errors).flat().join('\n'));
            }
        }

        function setSubscribed() {
            notifyBtn.dataset.subscribed = "true";
        }

        function setUnsubscribed() {
            notifyBtn.dataset.subscribed = "false";
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
            statusMessage.setAttribute("title", msg)

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

    function registerMailModalCloseListener(closeBtn) {
        closeBtn.addEventListener("click", closeMailModal)
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
            pendingEmailPromise.reject(new Error('email_prompt_cancelled'));
            pendingEmailPromise = null;
        }
    }

    const storageEmailKey = 'user_email';
    const storageSubscriberKey = 'subscriber';

    /**
     * Retrieves the user email from local storage or opens a prompt modal if not cached.
     * @param {boolean} [forcePrompt=false] - If true, forces the modal to open even if the email is cached.
     * @returns {Promise<string>} A promise that resolves with the user email address.
     */
    function getUserMail(forcePrompt = false) {
        if (!forcePrompt) {
            const cachedEmail = localStorage.getItem(storageEmailKey);
            if (cachedEmail) {
                return Promise.resolve(cachedEmail);
            }
        }

        return new Promise((resolve, reject) => {
            pendingEmailPromise = { resolve, reject };
            openMailModal();
        });
    }

    function clearCachedEmail() {
        localStorage.removeItem(storageEmailKey);
    }

    function setCachedSubscriber(subscriber) {
        localStorage.setItem(storageSubscriberKey, JSON.stringify(subscriber));
    }

    function getCachedSubscriber() {
        const subscriber = localStorage.getItem(storageSubscriberKey);
        return subscriber ? JSON.parse(subscriber) : null;
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
            localStorage.setItem(storageEmailKey, email);
            pendingEmailPromise.resolve(email);
            pendingEmailPromise = null;
        } else {
            console.error('No pending email promise to resolve.');
        }

        closeMailModal();
    }

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
})();