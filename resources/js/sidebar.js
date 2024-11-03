document.getElementById('toggleSidebar').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('toggleSidebar');
    const openIcon = document.getElementById('openIcon');
    const closeIcon = document.getElementById('closeIcon');
    
    sidebar.classList.toggle('-translate-x-full');
    toggleButton.classList.toggle('left-[17rem]');
    toggleButton.classList.toggle('left-4');
    
    openIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
});
