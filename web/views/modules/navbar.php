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

        <!-- Username con dropdown para "Mis datos" -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
                <?php $data = UserController::sessionDataUser($_SESSION['id_user']) ?>
                <?php echo $data['name_user'] . " " . $data['last_name_user'] ?>
            </a>
            <?php if ($data['change_password'] != 0) : ?>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="index.php?pages=myData">
                        <i class="fas fa-id-card"></i> Mis datos
                    </a>
                    <a class="dropdown-item" href="index.php?pages=changePassword">
                        <i class="fas fa-key"></i> Cambiar Contraseña
                    </a>
                </div>
        </li>



        <!-- Botón para ocultar la barra lateral -->
        <li class="nav-item">
            <button id="toggle-sidebar-btn" class="nav-link d-none d-lg-inline" role="button" style="background-color: transparent; border: none;" title="Ocultar Barra Lateral">
                <i class="fas fa-angle-left" style="margin-right: 5px;"></i> <!-- Icono de flecha hacia la izquierda -->
                <i class="fas fa-angle-right"></i> <!-- Icono de flecha hacia la derecha -->
            </button>
        </li>
        <!-- Botón de Cerrar Sesión con SweetAlert -->
        <li class="nav-item">
            <a class="nav-link" id="logout-button" href="#" role="button" title="Cerrar Sesión">
                <i class="fas fa-power-off"></i> <!-- Icono de apagado para cerrar sesión -->
            </a>
        </li>
    <?php endif; ?>
    </ul>

</nav>