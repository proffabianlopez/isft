<?php

require ('../config/MysqlDb.php');
require ('../models/UserModel.php');
require ('../controllers/TeacherController.php');
require ('../models/TeacherModel.php');


class TeacherAjax {

    
        public function newTeacher() {
            $teacher = new TeacherController();
            $result = $teacher->newTeacher();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        public function editTeacher() {
            $teacher = new TeacherController();
            $result = $teacher->editTeacher();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

}

if(isset($_POST['action']) && $_POST['action'] == 'newteacher'){
    $var = new TeacherAjax();
    $var->newTeacher();
}else if(isset($_POST['action']) && $_POST['action'] == 'editteacher'){

        $var = new TeacherAjax();
        $var->editTeacher();
}
