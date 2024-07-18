<?php

require ('../config/MysqlDb.php');
require ('../models/UserModel.php');
require ('../models/SubjectModel.php');
require ('../controllers/SubjectController.php');


class SubjectAjax {
        public function newSubject() {
            $subject = new SubjectController();
            $result = $subject->newSubject();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        public function editSubject() {
            $subject = new SubjectController();
            $result = $subject->updateSubject();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

}

if(isset($_POST['action']) && $_POST['action'] == 'newsubject'){
    $var = new SubjectAjax();
    $var->newSubject();
}else if(isset($_POST['action']) && $_POST['action'] == 'editsubject'){
        $var = new SubjectAjax();
        $var->editSubject();
}
