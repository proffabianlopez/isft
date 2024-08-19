<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailerController
{
    static public function sendNewUser($password, $email, $name, $last_name)
    {
        $credential = UserModel::getFirstValidCredential();
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $credential['email'];
        $mail->Password = $credential['token'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('institutec16@gmail.com', 'ISFT 177');
        $mail->addAddress($email, 'Usuario');
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "¡Tu cuenta ha sido activada!";

        $htmlFile = 'views/html/activateAccount.html';


        $htmlContent = file_get_contents($htmlFile);
        $htmlContent = str_replace('{{name}}', $name, $htmlContent);
        $htmlContent = str_replace('{{last_name}}', $last_name, $htmlContent);
        $htmlContent = str_replace('{{email}}', $email, $htmlContent);
        $htmlContent = str_replace('{{password}}', $password, $htmlContent);
        $mail->Body = $htmlContent;
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }



    static public function generateNewPasswordviaEmail($email,$password){

        $credential = UserModel::getFirstValidCredential();
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $credential['email'];
        $mail->Password = $credential['token'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('institutec16@gmail.com', 'ISFT 177');
        $mail->addAddress($email, 'Usuario');
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "¡Se le genero una nueva clave aleatoria!";

        $htmlFile = 'views/html/emailGeneratePassword.html';
        $htmlContent = file_get_contents($htmlFile);
        $htmlContent = str_replace('{{password}}', $password, $htmlContent);
        $mail->Body = $htmlContent;
         if ($mail->send()) {
            return true;
        } else {
            return false;
        }


    }


}
