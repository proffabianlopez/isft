<?php
session_start();
?>
<html lang="es">
<head>
<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//   head
    include_once "./views/modules/head.php";
?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
<?php 
//  <!-- Navbar -->
       
?>        
<?php 
//  <!-- Main Sidebar Container -->
        //include_once "./views/modules/sidebar.php";
?>
<div class="py-4 mb-2"></div>
<div class="content-wrapper">
<?php
/* AQUI DEBEN IR LOS FILTROS DE ROL PARA HABILITAR LAS OPCIONES CORRESPONDIENTES, CON $_SESSION */
    if( (isset($_GET['pages'])) && (isset($_SESSION['fk_rol_id'])) ) {
        switch ($_SESSION['fk_rol_id']) {
            case 1:
                include_once "views/getroles/GetAdminRol.php";
                break;
            case 2:
                include_once "views/getroles/GetPreceptoryRol.php";
                break;
            case 3:
                include_once "views/getroles/GetStudentRol.php";
                break;
        }
    } else {
        include "views/page/home.php";     
    }       
?>    
</div>
<?php  
/*
*  <!-- Main Footer -->
*/
include_once "./views/modules/footer.php";
?>
</div>
<?php 
/*
* <!-- SCRIPTS JS -->
*/
include_once "./views/modules/scripts.php";
?>
</body>
</html>
