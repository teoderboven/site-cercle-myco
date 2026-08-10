(function(){
    const subscriptionModal = document.getElementById("subscription-modal");
    const subscriptionForm = document.getElementById("subscription-form");
    const modalActivityTitleElement = subscriptionModal.querySelector(".activity-title");

    document.querySelectorAll(".notify-btn-wrapper").forEach(initNotifyButton);
    subscriptionModal.querySelectorAll(".close-btn").forEach(registerModalCloseListener);

    function initNotifyButton(btnWrapper) {
        const notifyBtn = btnWrapper.querySelector(".notify-btn");
        const statusMessage = btnWrapper.querySelector(".status-message");

        const activityId = notifyBtn.dataset.activityId;
        const activityTitle = notifyBtn.dataset.activityTitle;


        notifyBtn.addEventListener("click", handleNotifyBtnClick);

        function handleNotifyBtnClick(e) {
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
        closeBtn.addEventListener("click", (e) => {
            subscriptionModal.close();
        })
    }

    function openMailModal(activityTitle) {
        modalActivityTitleElement.innerText = activityTitle;
        subscriptionModal.showModal();
    }
})();