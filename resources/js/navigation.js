let sidebarVisible = false

const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');

sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('sidebar-hidden');
    sidebarVisible = !sidebarVisible
});

window.addEventListener('resize', function () {
    if (window.innerWidth > 992) {
        if (!sidebarVisible) {
            sidebar.classList.remove('sidebar-hidden');
        }
        sidebarToggle.style.display = 'none';
    } else {
        if (sidebarVisible) {
            sidebar.classList.add('sidebar-hidden');
        }
        sidebarToggle.style.display = 'block';
    }
});