<?php 

if( 
      ($_GET['pages'] == "home") ||       
# links administracion de carreras
      ($_GET['pages'] == "") ||           
      ($_GET['pages'] == "") ||
# links administracion de materias           
      ($_GET['pages'] == "") || 
# links administracion de usuarios           
      ($_GET['pages'] == "") || 
      ($_GET['pages'] == "") || 
      ($_GET['pages'] == "myData")||
      ($_GET['pages'] == "changedPasswordStart") ||
      ($_GET['pages'] == "") || 
# links simples
      ($_GET['pages'] == "changePassword") 
    ) { 
      include "views/pages/".$_GET['pages'].".php";    
    } elseif ($_GET['pages'] == "logout") {
      include "views/pages/logout.php";   
    } else {
      include "views/pages/error404.php";   
    }
