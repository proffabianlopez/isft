 <?php $data = UserController::sessionDataUser($_SESSION['id_user'])?>
<?php if($data['change_password'] != 0): ?>

    <li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users-cog"></i>
        <p>
            Gestión de Usuarios
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        
        <li class="nav-item">
            <a href="index.php?pages=newAdmin" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nuevo Usuario</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="index.php?pages=manageUser" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Gestionar Usuarios</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="fas fa-university nav-icon"></i>
        <p>
            Gestión de Carreras
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">        
        <li class="nav-item">
            <a href="index.php?pages=newCarreer" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nueva carrera</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="index.php?pages=allCarreer" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Todas las Carreras</p>
            </a>
        </li>            
    </ul>
</li>
<?php endif; ?>
