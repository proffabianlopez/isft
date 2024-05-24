<!-- HTML con el botón de cierre de sesión -->
<nav class="fixed-top main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav d-xl-none d-lg-none">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" title="Ocultar Barra Lateral"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Botón para ocultar la barra lateral -->
        <li class="nav-item">
            <button id="toggle-sidebar-btn" class="nav-link" role="button" style="background-color: transparent; border: none;" title="Ocultar Barra Lateral">
                <i class="fas fa-angle-left" style="margin-right: 5px;"></i> <!-- Icono de flecha hacia la izquierda -->
                <i class="fas fa-angle-right"></i> <!-- Icono de flecha hacia la derecha -->
            </button>
        </li>
        <!-- Username con opción de cambiar contraseña -->
        <li class="nav-item">
            <a class="nav-link" href="#" role="button">
                <i class="fas fa-user"></i> Username <!-- Cambiado a Username -->
            </a>
        </li>
        <!-- Botón de Cerrar Sesión con SweetAlert -->
        <li class="nav-item">
            <a class="nav-link" id="logout-button" href="#" role="button" title="Cerrar Sesión">
                <i class="fas fa-power-off"></i> <!-- Icono de apagado para cerrar sesión -->
            </a>
        </li>
    </ul>
</nav>
