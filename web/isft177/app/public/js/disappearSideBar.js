document.addEventListener("DOMContentLoaded", function() {
    const toggleSidebarBtn = document.getElementById('toggle-sidebar-btn');
    const sidebar = document.querySelector('.main-sidebar');
    const contentWrapper = document.querySelector('.content-wrapper');

    toggleSidebarBtn.addEventListener('click', function() {
        sidebar.classList.toggle('sidebar-hidden');
        contentWrapper.classList.toggle('sidebar-hidden');

        // Agregar o eliminar la clase 'navbar-expanded' al body para ajustar el margen izquierdo del contenido de la barra de navegación
        if (document.body.classList.contains('navbar-expanded')) {
            document.body.classList.remove('navbar-expanded');
        } else {
            document.body.classList.add('navbar-expanded');
        }
    });
});