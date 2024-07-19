<?php

require ('../config/MysqlDb.php');
require ('../models/UserModel.php');
require ('../models/CorrelativeModel.php');
require ('../models/SubjectModel.php');
require ('../controllers/CorrelativeController.php');


class CorrelativeAjax {
        public function newCorrelative() {
            $correlative = new CorrelativeController();
            $result = $correlative->newCorrelative();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        public function editCorrelative() {
            $correlative = new CorrelativeController();
            $result = $correlative->editCorrelative();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

}

if(isset($_POST['action']) && $_POST['action'] == 'newcorrelative'){
    $var = new CorrelativeAjax();
    $var->newCorrelative();
}else if(isset($_POST['action']) && $_POST['action'] == 'editcorrelative'){
        $var = new CorrelativeAjax();
        $var->editCorrelative();
}
