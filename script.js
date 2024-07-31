document.addEventListener('DOMContentLoaded', function() {
    function loadNotifications() {
        fetch('load_notifications.php')
            .then(response => response.json())
            .then(data => {
                let notifications = document.getElementById('notifications');
                notifications.innerHTML = '';
                data.forEach(notification => {
                    let div = document.createElement('div');
                    div.className = 'notification';
                    div.innerText = notification.message;
                    notifications.appendChild(div);
                });
            });
    }

    setInterval(loadNotifications, 5000); // Check for new notifications every 5 seconds
});
