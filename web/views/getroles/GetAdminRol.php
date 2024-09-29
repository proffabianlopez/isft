<?php

if (
      ($_GET['pages'] == "home") ||
      # links administracion de carreras
      ($_GET['pages'] == "allCareers") ||
      ($_GET['pages'] == "toolsCareer") ||
      ($_GET['pages'] == "manageSubject") ||
      ($_GET['pages'] == "manageCorrelatives") ||
      ($_GET['pages'] == "managePreceptor") ||
      ($_GET['pages'] == "viewsCorrelatives") ||
      ($_GET['pages'] == "careerEdit") ||
      ($_GET['pages'] == "careerInfo") ||
      # links administracion de usuarios           
      ($_GET['pages'] == "myData") ||
      ($_GET['pages'] == "autoEmail") ||
      ($_GET['pages'] == "changedPasswordStart") ||
      ($_GET['pages'] == "manageUser") ||
      ($_GET['pages'] == "manageStudent") ||
      ($_GET['pages'] == "manageTeacher") ||
      ($_GET['pages'] == "teacherCareer") ||
      ($_GET['pages'] == "manageTeacherAssignement") ||
      ($_GET['pages'] == "previewCourse") ||
      ($_GET['pages'] == "manageCourse") ||
      # links simples
      ($_GET['pages'] == "changePassword")
) {
      include "views/pages/" . $_GET['pages'] . ".php";
} elseif ($_GET['pages'] == "logout") {
      include "views/pages/logout.php";
} else {
      include "views/pages/error404.php";
}
