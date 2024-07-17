<?php

require ('../config/MysqlDb.php');
require ('../models/UserModel.php');
require ('../controllers/TeacherController.php');
require ('../models/TeacherModel.php');


class TeacherAjax {

    
        public function newTeacher() {
           //echo 'HOLA '.$_POST['action'];
            $product = new TeacherController();
            $result = $product->newTeacher();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        public function editTeacher() {
           //echo 'HOLA '.$_POST['action'];
            $product = new TeacherController();
            $result = $product->editTeacher();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

}

if(isset($_POST['action']) && $_POST['action'] == 'newteacher'){
// error_log("ACTION: ".$_POST['action']);
    $var = new TeacherAjax();
    $var->newTeacher();
}else if(isset($_POST['action']) && $_POST['action'] == 'editteacher'){
    // error_log("ACTION: ".$_POST['action']);
        $var = new TeacherAjax();
        $var->editTeacher();
}
