<?php 

if( 
      ($_GET['pages'] == "home") ||       
# links administracion de carreras
      ($_GET['pages'] == "newCarreer") ||           
      ($_GET['pages'] == "allCarreer") ||
# links administracion de materias           
      ($_GET['pages'] == "allSubjects") || 
# links administracion de usuarios           
      ($_GET['pages'] == "newAdmin") || 
      ($_GET['pages'] == "newStudent") || 

# links simples
      ($_GET['pages'] == "usrProfile") 
    ) { 
      include "../views/pages/".$_GET['pages'].".php";    
    } elseif ($_GET['pages'] == "logout") {
      include "../views/pages/logout.php";   
    } else {
      include "../views/pages/error404.php";   
    }