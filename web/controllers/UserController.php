<?php
class UserController
{
    public function __construct()
    {
        // Inicia la sesión si no está ya iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function control_login()
    {
        if (!empty($_POST['mail']) && !empty($_POST['password'])) {

            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $verificar = UserModel::login($mail, $password);
            if ($verificar != false) {
                $mail_user = $verificar['email'];
                $id_user = $verificar['id_user'];
                $rol = $verificar['fk_rol_id'];
                $state = $verificar['state'];
                $changed = $verificar['change_password'];

                if ($state == 1) {
                    $this->setSessionData('state', $state);
                    $this->setSessionData('email', $mail_user);
                    $this->setSessionData('fk_rol_id', $rol);
                    $this->setSessionData('id_user', $id_user);
                    $this->setSessionData('change_password', $changed);

                    if ($changed == 0) {
                        echo '<script>
                            if ( window.history.replaceState ) {
                                window.history.replaceState(null, null, window.location.href);
                            }
                            window.location="../index.php?pages=changedPasswordStart";
                        </script>';
                    }

                    // Limpiar las variables POST y redireccionar
                    echo '<script>
                        if ( window.history.replaceState ) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                        window.location="../index.php?pages=home";
                    </script>';
                }
            } else {
                echo '<script>
                    if ( window.history.replaceState ) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>
                <div class="alert alert-danger mt-2">Usuario o Contraseña incorrecta</div>';
            }
        } else {
            echo '<script>
                if ( window.history.replaceState ) {
                    window.history.replaceState(null, null, window.location.href);
                }
                alert("Debes completar los campos");
            </script>';
        }
    }



    // Método estático para obtener datos de la sesión
    public static function getSessionData($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    // Método estático para establecer datos en la sesión
    public static function setSessionData($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    static public function sessionDataUser($id)
    {
        $dataUser = UserModel::dataUser($id);
        return $dataUser;
    }





    static public function newPassword()
    {
        if (!empty($_POST['currentPassword']) && !empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])) {
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            // Verificar que las contraseñas nuevas coincidan
            if ($newPassword !== $confirmPassword) {
                echo '<div class="alert alert-danger mt-2">Las contraseñas nuevas no coinciden.</div>';
                return;
            }

            // Verificar la longitud de la nueva contraseña
            if (strlen($newPassword) < 8) {
                echo '<div class="alert alert-danger mt-2">La nueva contraseña debe tener al menos 8 caracteres.</div>';
                return;
            }

            // Obtener la contraseña actual del usuario
            $verifyPassword = UserModel::getPassword($_SESSION['id_user']);
            $oldPassword = $verifyPassword['password'];

            // Verificar si la contraseña actual es correcta
            if (password_verify($currentPassword, $oldPassword)) {
                // Hash de la nueva contraseña
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Actualizar la contraseña en la base de datos
                $result = UserModel::updatePassword($_SESSION['id_user'], $hashedPassword);

                if ($result) {
                    echo '<script>
                        if ( window.history.replaceState ) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                        window.location="../index.php?pages=changePassword";
                        </script>
                        <div class="alert alert-success mt-2">Se guardó el registro correctamente.</div>';
                } else {
                    echo '<div class="alert alert-danger mt-2">Error al actualizar la contraseña. Por favor, inténtalo de nuevo más tarde.</div>';
                }
            } else {
                echo '<div class="alert alert-danger mt-2">La contraseña actual es incorrecta.</div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-2">Por favor, completa todos los campos.</div>';
        }
    }

    //recibe datos desde el formulario de mydata.php para poder editar los datos del usuario
    static public function updateData()
    {
        if (!empty($_POST['name']) && !empty($_POST['last_name'])) {
            $name = ucwords(strtolower(trim($_POST['name'])));
            $lastname = ucwords(strtolower(trim($_POST['last_name'])));

            // Validación de nombre y apellido
            if (!preg_match("/^[a-zA-Z]+$/", $name) || !preg_match("/^[a-zA-Z]+$/", $lastname)) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">El nombre y/o apellido solo pueden contener letras.</div>';
                return;
            }

            $telephone = trim($_POST['tel']);
            if (!ctype_digit($telephone) || strlen($telephone) != 10 || intval(substr($telephone, 0, 2)) < 11) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">El número telefónico es inválido.</div>';
                return;
            }

            // Actualización de datos sin incluir el email
            $execute = UserModel::updateData($name, $lastname, $_SESSION['id_user'], $telephone);

            if ($execute) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=myData";
              </script>';
                echo '<div class="alert alert-success mt-2">Se guardó el registro correctamente</div>';
                return;
            } else {
                echo '<div class="alert alert-danger mt-2">Error al guardar el registro</div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-2">El campo está Vacío</div>';
        }
    }



    static public function changePasswordStart()
    {
        if (!empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])) {
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            if ($newPassword !== $confirmPassword) {
                echo '<div class="alert alert-danger mt-2">Las contraseñas nuevas no coinciden.</div>';
                return;
            }

            if (strlen($newPassword) < 8) {
                echo '<div class="alert alert-danger mt-2">La nueva contraseña debe tener al menos 8 caracteres.</div>';
                return;
            }

            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $result = UserModel::changePasswordStart($_SESSION['id_user'], $hashedPassword);

            if ($result) {
                $_SESSION['change_password'] = 1;
                echo '<script>
                            if ( window.history.replaceState ) {
                                window.history.replaceState(null, null, window.location.href);
                            }
                            window.location="../index.php?pages=logout";
                          </script>';
            } else {
                echo '<div class="alert alert-danger mt-2">Error al actualizar la contraseña. Por favor, inténtalo de nuevo más tarde.</div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-2">Por favor, completa todos los campos.</div>';
        }
    }




    static public function newUser()
    {
        if ((!empty($_POST['name'])) && (!empty($_POST['lastName'])) &&
            (!empty($_POST['mail'])) && (!empty($_POST['dni'])) && (!empty($_POST['gender'])) &&
            !empty($_POST['roles'])
        ) {

            $name = ucwords(strtolower(trim($_POST['name'])));
            $lastname = ucwords(strtolower(trim($_POST['lastName'])));
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u", $name) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u", $lastname)) {
                $response["status"] = "error";
                $response["message"] = "El nombre y/o apellido solo pueden contener letras, espacios y tildes.";
                return $response;
            }

            if (strlen($name) > 128 || strlen($lastname) > 128) {
                $response["status"] = "error";
                $response["message"] = "El nombre y/o apellido no pueden tener más de 128 caracteres.";
                return $response;
            }

            $telephone = trim($_POST['tel']);
            if (!ctype_digit($telephone) || strlen($telephone) != 10 || intval(substr($telephone, 0, 2)) < 11) {
                $response["status"] = "error";
                $response["message"] = "Número de teléfono inválido. Debe tener 10 dígitos y comenzar con un código de área válido.";
                return $response;
            }

            $checkCountTel = UserModel::checkForDuplicatesTel($telephone);

            if ($checkCountTel !== false) {
                $response["status"] = "error";
                $response["message"] = "El teléfono ya está registrado.";
                return $response;
            }

            $email = strtolower(trim($_POST['mail']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            if ($email === false) {
                $response["status"] = "error";
                $response["message"] = "Email invalido";
                return $response;
            }

            if (strlen($email) > 255) {
                $response["status"] = "error";
                $response["message"] = "El email no puede tener más de 255 caracteres.";
                return $response;
            }

            $dni = trim($_POST['dni']);
            if (!ctype_digit($dni) || strlen($dni) > 8 || strlen($dni) < 6 || intval($dni) < 5000000) {
                $response["status"] = "error";
                $response["message"] = "DNI inválido. Debe ser un número entre 6 y 8 dígitos.";
                return $response;
            }

            $gender = $_POST['gender'];
            $roles = $_POST['roles'];

            $generatePassword = self::generateRandomPassword(14);
            $hashedPassword = password_hash($generatePassword, PASSWORD_DEFAULT);
            $checkCountDniOrEmail = UserModel::checkForDuplicates($dni, $email);
            if ($checkCountDniOrEmail !== false) {
                $response["status"] = "error";
                $response["message"] = "Ya existe el Email o el DNI";
                return $response;
            } else {
                $execute = UserModel::newUser($name, $lastname, $email, $dni, $hashedPassword, $gender, $roles, $telephone);
                if ($execute) {
                    $mailController = MailerController::sendNewUser($generatePassword, $email, $name, $lastname);
                    error_log('mailController ' . $mailController);
                    if ($mailController) {
                        $response['title'] = "¡Éxito!";
                        $response["status"] = "successReset";
                        $response["message"] = "Se guardó los datos correctamente y envio email";
                        return $response;
                    } else {

                        $response['title'] = "¡Éxito!";
                        $response["status"] = "successReset";
                        $response["message"] = "Se guardó los datos correctamente";
                        return $response;
                    }
                } else {
                    $response["status"] = "error";
                    $response["message"] = "Hubo un problema al crearlo";
                    return $response;
                }
            }
        } else {
            $response["status"] = "error";
            $response["message"] = "Debes completar los campos";
        }
        return $response;
    }


    static public function generateRandomPassword($length)
    {
        $character = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
        $password = "";
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($character) - 1);
            $password .= $character[$index];
        }

        return $password;
    }

    static public function getAllUser()
    {
        return UserModel::getAllUser();
    }

    static public function eliminatedUser()
    {
        if (isset($_POST['id_user'])) {
            $id = $_POST['id_user'];

            $execute = UserModel::updateUserState($id); // Agregar el punto y coma (;) aquí

            if ($execute) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                
                window.location="../index.php?pages=manageUser";
                </script>
                <div class="alert alert-success mt-2">Se borró el registro correctamente</div>'; // Corregir la palabra "success"
            } else {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">No se pudo borrar</div>'; // Corregir la palabra "pudo"
            }
        }
    }


    static public function disableAccountUser()
    {
        if (isset($_GET['id_user'])) { // Cambiar $_POST a $_GET
            $id = $_GET['id_user']; // Cambiar $_POST a $_GET
            $execute = UserModel::disableUser($id); // Agregar el punto y coma (;) aquí

            if ($execute) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                
                window.location="../index.php?pages=manageUser";
                </script>
                <div class="alert alert-success mt-2">Se desabilito la cuenta</div>'; // Corregir la palabra "success"
            } else {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">No se pudo borrar</div>'; // Corregir la palabra "pudo"
            }
        }
    }


    static public function enableAccountUser()
    {
        if (isset($_GET['id_user'])) { // Cambiar $_POST a $_GET
            $id = $_GET['id_user']; // Cambiar $_POST a $_GET
            $execute = UserModel::activateUser($id); // Agregar el punto y coma (;) aquí

            if ($execute) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                
                window.location="../index.php?pages=manageUser";
                </script>
                <div class="alert alert-success mt-2">Se borró el registro correctamente</div>'; // Corregir la palabra "success"
            } else {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">No se pudo borrar</div>'; // Corregir la palabra "pudo"
            }
        }
    }

    static public function editarUser()
    {
        $id = $_POST['id_user'];
        $name = ucwords(strtolower(trim($_POST['name'])));
        $lastname = ucwords(strtolower(trim($_POST['last_name'])));
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u", $name) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u", $lastname)) {
            $response["status"] = "error";
            $response["message"] = "El nombre y/o apellido solo pueden contener letras, espacios y tildes.";
            return $response;
        }

        if (!preg_match("/^[a-zA-Z]+$/", $name) || !preg_match("/^[a-zA-Z]+$/", $lastname)) {
            $response["status"] = "error";
            $response["message"] = "El nombre y/o apellido solo pueden contener letras.";
            return $response;
        }
        if (strlen($name) > 128 || strlen($lastname) > 128) {
            $response["status"] = "error";
            $response["message"] = "El nombre y/o apellido no pueden tener más de 128 caracteres.";
            return $response;
        }

        $telephone = trim($_POST['tel']);
        if (!ctype_digit($telephone) || strlen($telephone) != 10 || intval(substr($telephone, 0, 2)) < 11) {
            $response["status"] = "error";
            $response["message"] = "Número de teléfono inválido. Debe tener 10 dígitos y comenzar con un código de área válido.";
            return $response;
        }

        $checkDuplicatesEditionTel = UserModel::checkForDuplicatesEditionTel($id, $telephone);

        if ($checkDuplicatesEditionTel !== false) {
            $response["status"] = "error";
            $response["message"] = "El teléfono ya está registrado.";
            return $response;
        }

        $roles = $_POST['roles'];

        $execute = UserModel::updateUserData($name, $lastname, $roles, $telephone, $id);
        if ($execute) {

            $response['title'] = "¡Actualizado!";
            $response["status"] = "successLoad";
            $response["message"] = "Se guardó los datos correctamente";
            return $response;
        } else {
            $response["status"] = "error";
            $response["message"] = "Hubo un problema al crearlo";
            return $response;
        }
    }

    static public function sendNewAleatoryPasswordEmail()
    {
        if (isset($_GET['id_user'])) {
            $id = $_GET['id_user'];
            $changedPassword = UserModel::updateChangedPassword($id);

            if ($changedPassword) {
                $dataUser = UserModel::dataUser($id);
                $emailData = $dataUser['email'];
                $generatePassword = self::generateRandomPassword(14);
                $hashedPassword = password_hash($generatePassword, PASSWORD_DEFAULT);

                // Actualizar la nueva contraseña y verificar si se realiza correctamente
                $updateNewPassword = UserModel::updateNewPassword($hashedPassword, $id);
                if ($updateNewPassword) {
                    // Enviar correo electrónico con la nueva contraseña
                    $mailSend = MailerController::generateNewPasswordviaEmail($emailData, $generatePassword);
                    if ($mailSend) {
                        echo '<script>
                                    if (window.history.replaceState) {
                                        window.history.replaceState(null, null, window.location.href);
                                    }
                                    window.location="../index.php?pages=manageUser&message=correcto";
                                    </script>';
                    } else {
                        echo '<script>
                                    if (window.history.replaceState) {
                                        window.history.replaceState(null, null, window.location.href);
                                    }
                                    alert("No se pudo enviar el email.");
                                    </script>';
                    }
                } else {
                    echo '<script>
                                if (window.history.replaceState) {
                                    window.history.replaceState(null, null, window.location.href);
                                }
                                alert("No se pudo actualizar la contraseña.");
                                </script>';
                }
            }
        }
    }
    //TRAE TODOS LOS DATOS DEL PRECEPTOR
    static public function showPreceptor()
    {
        return UserModel::getAllPreceptor();
    }
    static public function showTeacherCareer($id_career)
    {
        return UserModel::getTeacherCareer($id_career);
    }


    static public function insertCredentialEmail()
    {

        if (!empty($_POST['host']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['port_email'])) {


            $email_host = $_POST['host'];
            $email_validated_host = filter_var($email_host, FILTER_VALIDATE_EMAIL);
            $email = strtolower(trim($_POST['email']));
            $email_validated = filter_var($email, FILTER_VALIDATE_EMAIL);

            if (strlen($email) > 255 || strlen($email_host) > 255) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="index.php?pages=autoEmail&caracter=error";
                </script>';
                return;
            }
            if (!$email_validated) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="index.php?pages=autoEmail&email=error";
                </script>';
                return;
            }
            $port_email = $_POST['port_email'];

            if (!ctype_digit($port_email) || strlen($port_email) < 2 || strlen($port_email) > 5) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="index.php?pages=autoEmail&port=error";
                </script>';
                return;
            }

            $tls_optional = empty($_POST['certificate']) ? "tls" : $_POST['certificate'];
            $token = $_POST['password'];

            $execute = UserModel::insertValidCredential($email_host, $email, $token, $port_email, $tls_optional, $_SESSION['id_user']);

            if ($execute) {
                echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            window.location="index.php?pages=autoEmail&insert=correcto";
            </script>';

                return;
            } else {
                echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            window.location="index.php?pages=autoEmail&save=error";
            </script>';

                return;
            }
        } else {
            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="index.php?pages=autoEmail&void=error";
                </script>';
        }
    }

    static public function updateCredentialEmail()
    {

        if (!empty($_POST['host_email']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['port_email'])) {


            $email_host = $_POST['host_email'];
            $email_validated_host = filter_var($email_host, FILTER_VALIDATE_EMAIL);
            $email = strtolower(trim($_POST['email']));
            $email_validated = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (strlen($email) > 255 || strlen($email_host) > 255) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="index.php?pages=autoEmail&caracter=error";
                </script>';
                return;
            }
            if (!$email_validated) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="index.php?pages=autoEmail&email=error";
                </script>';
                return;
            }

            $port_email = $_POST['port_email'];

            if (!ctype_digit($port_email) || strlen($port_email) < 2 || strlen($port_email) > 5) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="index.php?pages=autoEmail&port=error";
                </script>';
                return;
            }

            $tls_optional = empty($_POST['certificate']) ? "tls" : $_POST['certificate'];
            $token = $_POST['password'];

            $execute = UserModel::updateCredential($email_host, $email, $token, $port_email, $tls_optional, $_SESSION['id_user']);
            error_log("ejecusion", $execute);
            if ($execute) {
                echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            window.location="index.php?pages=autoEmail&insert=correcto";
            </script>';

                return;
            } else {
                echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            window.location="index.php?pages=autoEmail&save=error";
            </script>';

                return;
            }
        } else {
            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="index.php?pages=autoEmail&void=error";
                </script>';
        }
    }
}
