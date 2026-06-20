<div class="topbar">
    <div class="topbar-left">
        <div class="brand-section">
            <!-- Updated path and class name -->
            <img src="assets/images/logo/ml.svg" class="brand-logo" alt="AUTO GARAGE Logo">
            <h2 class="brand-title">AUTO GARAGE</h2>
        </div>
    </div>

    <div class="topbar-right">
        <!-- Text-based dropdown button matching the UI -->
       <div class="notifications-wrapper">
    <button class="notification-btn" id="notificationBtn" aria-label="View notifications">
        <!-- SVG Notification Bell Icon -->
        <svg xmlns="http://w3.org" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bell-icon">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
        </svg>
        <!-- Dynamic Alert Badge Counter -->
        <span class="notification-badge" id="notificationBadge">3</span>
    </button>
    
    <!-- Hidden Dropdown Container -->
    <div class="notifications-dropdown" id="notificationsDropdown">
        <div class="dropdown-header">Recent Alerts</div>
        <div class="dropdown-item">parking 1: Oil Change completed</div>
        <div class="dropdown-item">parking 5: New booking added</div>
        <div class="dropdown-item">System: Backup generated</div>
    </div>
</div>


        <div class="profile-section">
            <img src="assets/images/users/users.jpg" class="profile-image" alt="Admin">
            <!-- User identifier label matching standard dashboard systems -->
            <span class="profile-name">User</span>
            <button class="profile-toggle" id="profileToggle">&#9662;</button>
            
            <div class="profile-dropdown" id="profileDropdown">
                <a href="#">My Profile</a>
                <a href="#">Settings</a>
                <a href="#">Logout</a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileSection = document.querySelector('.profile-section');
        const profileDropdown = document.getElementById('profileDropdown');

        // Toggle dropdown when clicking anywhere inside the profile section
        profileSection.addEventListener('click', function (event) {
            // Prevent event from bubbling up to the document listener below
            event.stopPropagation(); 
            profileDropdown.classList.toggle('show');
        });

        // Close dropdown automatically if the user clicks anywhere else on the page
        document.addEventListener('click', function () {
            if (profileDropdown.classList.contains('show')) {
                profileDropdown.classList.remove('show');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
    const notificationBtn = document.getElementById('notificationBtn');
    const notificationsDropdown = document.getElementById('notificationsDropdown');
    const notificationBadge = document.getElementById('notificationBadge');

    // Toggle menu popup on icon button click
    notificationBtn.addEventListener('click', function (event) {
        event.stopPropagation();
        notificationsDropdown.classList.toggle('show');
        
        // Optional: Clear or hide badge indicator number once user views it
        if(notificationBadge) {
            notificationBadge.style.display = 'none';
        }
    });

    // Universal clear trigger when selecting anywhere outside the window view
    document.addEventListener('click', function (event) {
        if (!notificationsDropdown.contains(event.target) && event.target !== notificationBtn) {
            notificationsDropdown.classList.remove('show');
        }
    });
});

</script>


