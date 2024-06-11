<?php

if (
      ($_GET['pages'] == "home") ||
      # links administracion de carreras
      ($_GET['pages'] == "allCareers") ||
      ($_GET['pages'] == "toolsCareer") ||
      ($_GET['pages'] == "manageSubject") ||
      ($_GET['pages'] == "manageCorrelatives") ||
      ($_GET['pages'] == "assignmentPreceptor") ||
      ($_GET['pages'] == "viewsCorrelatives") ||
      ($_GET['pages'] == "careerFinishReview") ||
      ($_GET['pages'] == "careerEdit") ||
      ($_GET['pages'] == "careerVerifyCheck") ||
      ($_GET['pages'] == "careerInfo") ||
      ($_GET['pages']=="manageSubjectStudent")  ||
      # links administracion de Personas           
      ($_GET['pages'] == "newStudent") ||

      ($_GET['pages'] == "newTeacher") ||
      # links administracion de usuarios           
      ($_GET['pages'] == "newUser") ||
      ($_GET['pages'] == "myData") ||
      ($_GET['pages'] == "changedPasswordStart") ||
      ($_GET['pages'] == "manageUser") ||
      ($_GET['pages'] == "manageStudent") ||
      ($_GET['pages'] == "manageTeacher") ||
      # links simples
      ($_GET['pages'] == "changePassword")
) {
      include "views/pages/" . $_GET['pages'] . ".php";
} elseif ($_GET['pages'] == "logout") {
      include "views/pages/logout.php";
} else {
      include "views/pages/error404.php";
}
