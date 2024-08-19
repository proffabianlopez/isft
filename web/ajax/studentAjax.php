<?php

require ('../config/MysqlDb.php');
require ('../models/UserModel.php');
require ('../controllers/StudentController.php');
require ('../models/StudentModel.php');
require ('../models/AssignmentModel.php');
require ('../models/CareerModel.php');


class StudentAjax {

    
        public function newStudent() {
            $student = new StudentController();
            $result = $student->newStudent();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        public function editStudent() {
            $student = new StudentController();
            $result = $student->editStudent();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
         public function assignLegajo() {
            $student = new StudentController();
            $result = $student->AssingnamentLegajo();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

}

if(isset($_POST['action']) && $_POST['action'] == 'newstudent'){
    $var = new StudentAjax();
    $var->newStudent();
}else if(isset($_POST['action']) && $_POST['action'] == 'editstudent'){
        $var = new StudentAjax();
        $var->editStudent();
}else if(isset($_POST['action']) && $_POST['action'] == 'assignlegajo'){
        $var = new StudentAjax();
        $var->assignLegajo();
}
