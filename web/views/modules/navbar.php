<nav class="fixed-top main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" title="Ocultar Barra Lateral"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <!-- Username con dropdown para "Mis datos" -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user pr-1"></i>
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

        <!-- Botón de Cerrar Sesión con SweetAlert -->
        <li class="nav-item">
            <a class="nav-link" id="logout-button" href="#" role="button" title="Cerrar Sesión">
                <i class="fas fa-power-off"></i>
            </a>
        </li>
    <?php endif; ?>
    </ul>

</nav>