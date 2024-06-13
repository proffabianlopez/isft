<?php

class UserController
{

    public function control_login()
    {

        if ((!empty($_POST['mail'])) && !empty($_POST['password'])) {

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
                    $_SESSION['state'] = $state;
                    $_SESSION['email'] = $mail_user;
                    $_SESSION['fk_rol_id'] = $rol;
                    $_SESSION['id_user'] = $id_user;
                    $_SESSION['change_password'] = $changed;
                    if ($changed == 0) {
                        echo '<script>
                    if ( window.history.replaceState ) {
                        window.history.replaceState(null, null, window.location.href);
                    }

                    window.location="../index.php?pages=changedPasswordStart"; //AGREGAR VISTA CHANGEDPASSWORD
                    </script>';
                    }

                    //if borra todos las variables post
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

           

            // Actualización de datos sin incluir el email
            $execute = UserModel::updateData($name, $lastname, $_SESSION['id_user']);

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
            if (!preg_match("/^[a-zA-Z]+$/", $name) || !preg_match("/^[a-zA-Z]+$/", $lastname)) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">El nombre y/o apellido solo pueden contener letras.</div>';
                return;
            }

            $email = strtolower(trim($_POST['mail']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            if ($email === false) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">Email inválido</div>';
                return;
            }

            $dni = trim($_POST['dni']);
            if (!ctype_digit($dni) || strlen($dni) > 8 || strlen($dni) < 6) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">DNI inválido. Debe ser un número entre 6 y 8 dígitos.</div>';
                return;
            }

            $gender = $_POST['gender'];
            $roles = $_POST['roles'];

            $generatePassword = self::generateRandomPassword(14);
            $hashedPassword = password_hash($generatePassword, PASSWORD_DEFAULT);
            $checkCountDniOrEmail = UserModel::checkForDuplicates($dni, $email);
            if ($checkCountDniOrEmail !== false) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">Ya existe el Email o el Dni</div>';
            } else {
                $execute = UserModel::newUser($name, $lastname, $email, $dni, $hashedPassword, $gender, $roles);
                if ($execute) {
                    $mailController = MailerController::sendNewUser($generatePassword, $email, $name, $lastname);
                    echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    
                    window.location="../index.php?pages=newUser&message=correcto";
                    </script>
                    <div class="alert alert-succes mt-2">Se guardó el registro correctamente</div>';
                } else {
                    echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location="../index.php?pages=newUser";
                    </script>
                    <div class="alert alert-danger mt-2">Hubo un problema al crearlo</div>';
                }
            }
        } else {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="alert alert-danger mt-2">Debes completar los campos</div>';
        }
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
        $name = ucwords(strtolower(trim($_POST['name'])));
        $lastname = ucwords(strtolower(trim($_POST['last_name'])));

        $roles = $_POST['roles'];
        $id = $_POST['id_user'];

        $execute = UserModel::updateUserData($name, $lastname, $roles, $id);
        if ($execute) {

            echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }

                    window.location="../index.php?pages=manageUser&subfolder=listUser";
                    </script>
                    <div class="alert alert-succes mt-2">Se guardó el registro correctamente</div>';
        } else {
            echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location="../index.php?pages=newUser";
                    </script>
                    <div class="alert alert-danger mt-2">Hubo un problema al crearlo</div>';
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

    //hay que usar decode primero para desencriptar el id career que viene de la vista

    static public function dataUserCareer($id)
    {
        // Verifica si se pasó el parámetro id_career
        if (isset($id)) {
            // Decodifica el valor de id_career
            $id_career = $id; //decodifica

            return UserModel::dataUserCareer($id_career);


            // Luego, puedes devolver los datos que hayas obtenido
            // return $datos_de_la_carrera; //ESTA LÍNEA ME DA ERROR. CORREGIR
        } else {

            return "No se proporcionó un ID de carrera";
        }
    }
}
