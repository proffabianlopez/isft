<?php

require ('../config/MysqlDb.php');
require ('../models/UserModel.php');
require ('../models/CourseModel.php');
require ('../controllers/CourseController.php');


class CourseAjax {
        public function asinngNotesCoursesSubjectStudentAjax() {
            $course = new CourseController();
            $result = $course->asinngNotesCoursesSubjectStudent($_POST['id_subject'], $_POST['id_student'], $_POST['note1'], $_POST['note2'], $_POST['recuperatory1'], $_POST['recuperatory2']);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

        public function finshCourseAjax() {
            $course = new CourseController();
            $result = $course->finishCourse($_POST['id_career']);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
}

if(isset($_POST['action']) && $_POST['action'] == 'addNote') {
    $var = new CourseAjax();
    $var->asinngNotesCoursesSubjectStudentAjax();
}else if($_POST['action'] && $_POST['action'] == 'finish') {
$var = new CourseAjax();
$var->finshCourseAjax();
}