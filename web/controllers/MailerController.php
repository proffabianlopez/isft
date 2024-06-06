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

        // Contenido HTML del correo
        $htmlContent = '
            <html>
            <head>
                <title>¡Tu cuenta ha sido activada!</title>
                <style>
                /* Estilos CSS aquí */
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f5f5f5;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
                .container {
                    text-align: center;
                    background-color: white;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
                .logo {
                    width: 150px;
                    margin-top: 20px;
                }
                .warning {
                    background-color: #ffcccc;
                    padding: 10px;
                    border-radius: 5px;
                    margin-top: 20px;
                }
                .login-link {
                    color: #007bff; /* Color del texto del enlace */
                    text-decoration: none; /* Eliminar subrayado predeterminado */
                    font-weight: bold; /* Texto en negrita */
                    transition: color 0.3s; /* Transición de color para un efecto suave al pasar el mouse */
                }
                .login-link:hover {
                    color: #0056b3; /* Color del texto del enlace al pasar el mouse */
                    text-decoration: underline; /* Subrayado al pasar el mouse */
                }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>¡Bienvenido a ISFT177!</h1>
                    <p>Su usuario ya está activo: ' . $name . ' ' . $last_name . '</p>
                    <p>usuario: ' . $email . '</p>
                    <p>contraseña: ' . $password . '</p>
                    <div class="login-div">
                        <p>Podrás iniciar sesión haciendo click <a href="http://isft177.duckdns.org/" class="login-link">aquí</a>.</p>
                    </div>                  
                    <div class="warning">
                        <p><strong>Recuerda:</strong> No compartas tu contraseña con nadie. Al iniciar por primera vez se te pedirá cambiar la contraseña.</p>
                    </div>
                    <img src="https://isft177.edu.ar/img/home/logoisft177.png" alt="Logo" class="logo">
                </div>
            </body>
            </html>
        ';

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

      
        $htmlContent = '
        <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>¡Tu contraseña ha sido restablecida!</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }
            .container {
                text-align: center;
                background-color: white;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                width: 100%;
                margin: auto;
            }
            .logo {
                width: 150px;
                margin-top: 20px;
            }
            .warning {
                background-color: #ffcccc;
                padding: 10px;
                border-radius: 5px;
                margin-top: 20px;
            }
            .login-link {
                color: #007bff; /* Color del texto del enlace */
                text-decoration: none; /* Eliminar subrayado predeterminado */
                font-weight: bold; /* Texto en negrita */
                transition: color 0.3s; /* Transición de color para un efecto suave al pasar el mouse */
            }
            .login-link:hover {
                color: #0056b3; /* Color del texto del enlace al pasar el mouse */
                text-decoration: underline; /* Subrayado al pasar el mouse */
            }
            h1 {
                color: #007bff;
                margin-bottom: 20px;
            }
            p {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <img src="https://isft177.edu.ar/img/home/logoisft177.png" alt="Logo" class="logo">
            <h1>¡Tu contraseña ha sido restablecida!</h1>
            <p>Se ha generado una nueva contraseña aleatoria para tu cuenta.</p>
            <p><strong>Contraseña: ' . $password . '</strong></p>
            <p>Por razones de seguridad, te recomendamos que cambies esta contraseña después de iniciar sesión.</p>
            <div class="login-div">
                <p>Puedes iniciar sesión haciendo click <a href="http://isft177.duckdns.org/" class="login-link">aquí</a>.</p>
            </div>                  
            <div class="warning">
                <p><strong>Recuerda:</strong> No compartas tu contraseña con nadie.</p>
            </div>
        </div>
    </body>
    </html>';
    


    $mail->Body = $htmlContent;

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }


    }


}
