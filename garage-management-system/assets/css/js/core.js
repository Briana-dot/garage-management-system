function updateDateTime() {

    const now = new Date();

    document.getElementById('liveDateTime').innerText =
        now.toLocaleString();
}

setInterval(updateDateTime, 1000);

const profileToggle =
document.getElementById('profileToggle');

const profileDropdown =
document.getElementById('profileDropdown');

profileToggle.addEventListener('click', () => {

    if(
        profileDropdown.style.display === 'flex'
    ) {

        profileDropdown.style.display = 'none';

    } else {

        profileDropdown.style.display = 'flex';
    }
});

document
.getElementById('notificationBtn')
.addEventListener('click', () => {

    alert('Opening Notifications...');
});

const menuToggle =
document.getElementById('menuToggle');

const sidebar =
document.querySelector('.sidebar');

menuToggle.addEventListener('click', () => {

    sidebar.classList.toggle('sidebar-collapsed');
});