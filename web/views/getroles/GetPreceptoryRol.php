<?php

if (
      ($_GET['pages'] == "home") ||
      # links administracion de carreras
      ($_GET['pages'] == "allCareers") ||
      ($_GET['pages'] == "toolsCareer") ||
      ($_GET['pages'] == "careerInfo") ||
      ($_GET['pages'] == "manageFinals") ||
      # links administracion de materias           
      ($_GET['pages'] == "manageSubject") ||
      ($_GET['pages'] == "manageCorrelatives") ||
      ($_GET['pages'] == "previewCourse") ||
      ($_GET['pages'] == "manageCourse") ||
      # links administracion de Estudiantes           
      ($_GET['pages'] == "manageStudent") ||
      ($_GET['pages'] == "") ||
      # links administracion de Usuarios    
      ($_GET['pages'] == "myData") ||
      ($_GET['pages'] == "changedPasswordStart") ||
      ($_GET['pages'] == "manageStudentAssignement") ||
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
