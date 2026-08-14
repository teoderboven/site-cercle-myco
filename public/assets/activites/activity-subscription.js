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

            getUserMail()
                .then(email => {
                    displayLoading();
                    sendSubscriptionRequest(email, activityId)
                        .then(handleSubscriptionResponse)
                        .catch(err => {
                            console.error(err.message);
                            displayStatus('Une erreur est survenue lors de l\'inscription.', true);
                        })
                        .finally(() => hideLoading());
                })
                .catch(err => {
                    if (err.message !== 'email_prompt_cancelled') {
                        console.error(err.message);
                        displayStatus('Une erreur est survenue lors de l\'inscription.', true);
                    }
                });
        }

        function handleSubscriptionResponse(response) {
            if (response.success || response.reminderAlreadyExists) {
                displayStatus(response.message);
                displayValidationCheck();
            }
            else {
                displayStatus(Object.values(response.errors).flat().join('\n'), true);
            }
        }

        function displayValidationCheck() {
            notifyBtn.classList.add('validate');
        }

        function displayLoading() {
            notifyBtn.classList.add('loading');
        }

        function hideLoading() {
            notifyBtn.classList.remove('loading');
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

    /**
     * Retrieves the user email from local storage or opens a prompt modal if not cached.
     * @param {boolean} [forcePrompt=false] - If true, forces the modal to open even if the email is cached.
     * @returns {Promise<string>} A promise that resolves with the user email address.
     */
    function getUserMail(forcePrompt = false) {
        if (!forcePrompt) {
            const cachedEmail = localStorage.getItem('user_email');
            if (cachedEmail) {
                return Promise.resolve(cachedEmail);
            }
        }

        return new Promise((resolve, reject) => {
            pendingEmailPromise = { resolve, reject };
            openMailModal();
        });
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
            localStorage.setItem('user_email', email);
            pendingEmailPromise.resolve(email);
            pendingEmailPromise = null;
        } else {
            console.error('No pending email promise to resolve.');
        }

        closeMailModal();
    }

    function sendSubscriptionRequest(email, activityId) {
        return fetch(`/activites/rappel`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken
            },
            body: JSON.stringify({ email, activity: activityId })
        })
        .then(response => response.json());
    }
})();