
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
        <img src="./img/isft177_logo_chico.png" alt="logo isft177" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ISFT Nº 177</span>
    </a>  
    <div class="sidebar">
        <div class="user-panel mt-3 pb-1 mb-1 d-flex">
            <div class="image">
                <img src="./img/usr_login.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info"><?php

?>
                <a href="#" class="d-block">Administrador</a>
                <div style="color:grey;">(SysAdmin)</div>    
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php?pages=home" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <?php 
                
                if ($_SESSION['fk_rol_id'] == 1){
                    include_once "sidebarAdmin.php";
                } 
            ?>
            <?php 
                if ($_SESSION['fk_rol_id'] == 2){
                    include_once "sidebarPreceptor.php";
                }
            ?>
            <?php 
                if ($_SESSION['fk_rol_id'] == 3){
                    include_once "sidebarStudent.php";   
                }
                
                ?>
                
                <?php if ($_SESSION['fk_rol_id'] != 1): ?>
                    <li class="nav-item">
                        <a href="index.php?pages=usrProfile" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Mis Datos</p>
                        </a>
                    </li>
                <?php endif;?>  

                
                <li class="nav-item">
                    <a href="index.php?pages=logout"  class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Cerrar Sesión</p>

                    </a>
                </li>
                
            </ul>
        </nav>
    </div>
</aside>
