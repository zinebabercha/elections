console.log(4);
const popupNotification = document.getElementById('popup-notification');
popupNotification.style.display = 'block';
setTimeout(() => {
    popupNotification.style.display = 'none';
}, 3000);