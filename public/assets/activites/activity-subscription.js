(function(){
    const subscriptionModal = document.getElementById("subscription-modal");
    const subscriptionForm = document.getElementById("subscription-form");
    const modalActivityTitleElement = subscriptionModal.querySelector(".activity-title");

    subscriptionForm.addEventListener('submit', handleSubscriptionFormSubmit);
    document.querySelectorAll(".notify-btn-wrapper").forEach(initNotifyButton);
    subscriptionModal.querySelectorAll(".close-btn").forEach(registerModalCloseListener);
    subscriptionModal.addEventListener('close', handleModalClose);

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

            getUserMail().then(email => {
            })
            .catch(err => {
                if (err.message !== 'email_prompt_cancelled') {
                    console.error(err.message);
                    displayStatus('Une erreur est survenue lors de l\'inscription.');
                }
            });
        }

        let messageTimeout;

        /**
         * Displays the given message below the button
         * @param msg the message to display
         */
        function displayStatus(msg) {
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

            if(messageTimeout) {
                clearTimeout(messageTimeout);
            }
            messageTimeout = setTimeout(() => {
                statusMessage.classList.remove(revealedClass);
                messageTimeout = null;
            }, 5000);
        }
    }

    function registerModalCloseListener(closeBtn) {
        closeBtn.addEventListener("click", closeMailModal)
    }

    function openMailModal() {
        modalActivityTitleElement.innerText = activeActivityTitle;
        subscriptionModal.showModal();
    }

    function closeMailModal() {
        subscriptionModal.close();
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
     * @returns {Promise<string>} A promise that resolves with the user email address.
     */
    function getUserMail() {
        const cachedEmail = localStorage.getItem('user_email');
        if (cachedEmail) {
            return Promise.resolve(cachedEmail);
        }

        return new Promise((resolve, reject) => {
            pendingEmailPromise = { resolve, reject };
            openMailModal();
        });
    }

    /**
     * Processes the subscription form submission from the modal and resolves the pending email request.
     * @param {SubmitEvent} event - The form submission event object.
     */
    function handleSubscriptionFormSubmit(event) {
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
})();