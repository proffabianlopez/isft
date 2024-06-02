<?php 

if( 
      ($_GET['pages'] == "home") ||       
# links administracion de carreras
      ($_GET['pages'] == "newCarreer") ||           
      ($_GET['pages'] == "allCarreer") ||
# links administracion de Personas           
      ($_GET['pages'] == "newStudent") || 
      ($_GET['pages'] == "listStudent") || 
      ($_GET['pages'] == "newTeacher") ||
      ($_GET['pages'] == "listTeacher") ||  
# links administracion de usuarios           
      ($_GET['pages'] == "newUser") ||  
      ($_GET['pages'] == "myData")||
      ($_GET['pages'] == "changedPasswordStart") ||
      ($_GET['pages'] == "manageUser") || 
# links simples
      ($_GET['pages'] == "changePassword") 
    ) { 
      include "views/pages/".$_GET['pages'].".php";    
    } elseif ($_GET['pages'] == "logout") {
      include "views/pages/logout.php";   
    } else {
      include "views/pages/error404.php";   
    }
