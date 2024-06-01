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

    static public function newStudent()
{
   
    if ((!empty($_POST['name'])) && (!empty($_POST['lastName'])) &&
        (!empty($_POST['mail'])) && (!empty($_POST['dni'])) &&
        (!empty($_POST['fileNumber'])) && (!empty($_POST['gender'])) &&
        (!empty($_POST['date']))
    ) {
        $name = $_POST['name'];
        $lastname = $_POST['lastName'];
        $email = $_POST['mail'];
        $dni = $_POST['dni'];
        $fileNumber = $_POST['fileNumber'];
        $gender = $_POST['gender'];
        $date = $_POST['date'];
 

        // Hash de la contraseña
        $hashedPassword = password_hash($generatePassword, PASSWORD_DEFAULT);
        
        // Registrar al estudiante
        $execute = UserModel::newStudent($name, $lastname, $email, $dni, $date, $fileNumber, $hashedPassword, $gender);

        if ($execute) {
            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=newStudent";
                </script>
                <div class="alert alert-succes mt-2">Se guardó el registro correctamente</div>';
        } else {
            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=newStudent";
                </script>
                <div class="alert alert-danger mt-2">Hubo un problema al crearlo</div>';
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

   
    static public function newMail()
{
    if (!empty($_POST['email'])) {
        $newEmail = trim($_POST['email']);

        // Obtener el correo electrónico actual del usuario
        $currentEmail = UserModel::dataUser($_SESSION['id_user']);

        if ($newEmail === trim($currentEmail['email'])) {
            echo '<div class="alert alert-danger mt-2">El correo es existente</div>';
            return;
        }

        if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $checkEmailDuplicate = UserModel::checkForDuplicatesEmail($newEmail);
            if ($checkEmailDuplicate !== false) {
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    </script>
                    <div class="alert alert-danger mt-2">Ya existe el Email</div>';
            } else {
                $execute = UserModel::updateMail($_SESSION['id_user'], $newEmail);

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
            }
        } else {
            echo '<div class="alert alert-danger mt-2">El correo NO es válido</div>';
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

            // Hash de la nueva contraseña
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



    static public function newAdmin()
{
    if ((!empty($_POST['name'])) && (!empty($_POST['lastName'])) &&
        (!empty($_POST['mail'])) && (!empty($_POST['dni'])) && (!empty($_POST['gender'])) &&
        !empty($_POST['roles'])) {

        $name = $_POST['name'];
        $lastname = $_POST['lastName'];
        $email = $_POST['mail'];
        $dni = $_POST['dni'];
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
            $execute = UserModel::newAdmin($name, $lastname, $email, $dni, $hashedPassword, $gender, $roles);
            if ($execute) {

                $mailController = MailerController::sendNewUser($generatePassword, $email,$name,$lastname);
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    
                    window.location="../index.php?pages=newAdmin";
                    </script>
                    <div class="alert alert-succes mt-2">Se guardó el registro correctamente</div>';

            } else {
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location="../index.php?pages=newAdmin";
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


static public function generateRandomPassword($length){
    $character='123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $password="";
    for($i=0;$i<$length;$i++){
        $index=rand(0,strlen($character)-1);
        $password.=$character[$index];
    }    

    return $password;
   
}
}