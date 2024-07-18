<?php

require ('../config/MysqlDb.php');
require ('../models/UserModel.php');
require ('../models/CareerModel.php');
require ('../controllers/CareerController.php');


class CareerAjax {
        public function newCareer() {
            $career = new CareerController();
            $result = $career->newCareer();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        public function editCareer() {
            $career = new CareerController();
            $result = $career->editCareer();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

}

if(isset($_POST['action']) && $_POST['action'] == 'newcareer'){
    $var = new CareerAjax();
    $var->newCareer();
}else if(isset($_POST['action']) && $_POST['action'] == 'editcareer'){
        $var = new CareerAjax();
        $var->editCareer();
}
