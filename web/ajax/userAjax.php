<?php

require ('../config/MysqlDb.php');
require ('../models/UserModel.php');
require ('../controllers/UserController.php');
require ('../vendor/autoload.php');
require ('../controllers/MailerController.php');


class UserAjax {
        public function newUser() {
            $user = new UserController();
            $result = $user->newUser();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        public function editUser() {
            $user = new UserController();
            $result = $user->editarUser();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

}

if(isset($_POST['action']) && $_POST['action'] == 'newuser'){
    $var = new UserAjax();
    $var->newUser();
}else if(isset($_POST['action']) && $_POST['action'] == 'edituser'){
        $var = new UserAjax();
        $var->editUser();
}
