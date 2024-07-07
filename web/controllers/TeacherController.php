<?php
class TeacherController
{
    static public function newTeacher()
    {

        if ((!empty($_POST['name'])) && (!empty($_POST['lastName'])) &&
            (!empty($_POST['mail'])) && (!empty($_POST['dni'])) &&
            (!empty($_POST['gender']))
        ) {

            $name = ucwords(strtolower(trim($_POST['name'])));
            $lastname = ucwords(strtolower(trim($_POST['lastName'])));
            if (!preg_match("/^[a-zA-Z]+$/", $name) || !preg_match("/^[a-zA-Z]+$/", $lastname)) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="alert alert-danger mt-2">El nombre y/o apellido solo pueden contener letras.</div>
                    </div>
                </div>';
                return;
            }

            if (strlen($name) > 128 || strlen($lastname) > 128) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">El nombre y/o apellido no pueden tener más de 128 caracteres.</div>
                    </div>
                </div>';
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

            if (strlen($email) > 255) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">El email no puede tener más de 255 caracteres.</div>
                    </div>
                </div>';
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

            // Filtra el duplicado del DNI
            $checkCountDniOrEmail = TeacherModel::checkForDuplicates($dni, $email);

            if ($checkCountDniOrEmail !== false) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">Ya existe el Email o el DNI</div>';
                return;
            }
            $execute = TeacherModel::newTeacher($name, $lastname, $email, $dni, $gender);

            if ($execute) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=manageTeacher&subfolder=newTeacher&message=correcto";
                </script>
                <div class="alert alert-succes mt-2">Se guardó el registro correctamente</div>';
            } else {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=manageTeacher&subfolder=newTeacher";
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

    static public function getAllTeachers()
    {
        return TeacherModel::getAllTeachers();
    }

    static public function editTeacher()
    {
        $name = ucwords(strtolower(trim($_POST['name_teacher'])));
        $lastname = ucwords(strtolower(trim($_POST['last_name_teacher'])));

        if (!preg_match("/^[a-zA-Z]+$/", $name) || !preg_match("/^[a-zA-Z]+$/", $lastname)) {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="col-sm-12 pt-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="alert alert-danger mt-2">El nombre y/o apellido solo pueden contener letras.</div>
                    </div>
            </div>';
            return;
        }
        if (strlen($name) > 128 || strlen($lastname) > 128) {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="col-sm-12 pt-3">
                <div class="d-flex justify-content-center align-items-center">             
                    <div class="alert alert-danger mt-2">El nombre y/o apellido no pueden tener más de 128 caracteres.</div>
                </div>
            </div>';
            return;
        }


        $id_teacher = $_POST['id_teacher'];
        /*$checkCountEmail = TeacherModel::checkForDuplicatesEmail($id_teacher, $email);

        if ($checkCountEmail !== false) {
            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">Ya existe el email</div>';
            return;
        }*/

        $execute = TeacherModel::updateTeacherData($name, $lastname, $id_teacher);
        if ($execute) {

            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                
                window.location="../index.php?pages=manageTeacher&subfolder=listTeacher";
                </script>
                <div class="alert alert-succes mt-2">Se guardó el registro correctamente</div>';
        } else {
            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=manageTeacher&subfolder=listTeacher";
                </script>
                <div class="alert alert-danger mt-2">Hubo un problema al editar</div>';
        }
    }


     //no borrar por el momento no se usara
    // static public function generateAccountTeacher()
    // {
    //     if (isset($_GET['id_teacher'])) {
    //         $id_teacher = $_GET['id_teacher'];

    //         $dataTeacher = TeacherModel::dataUser($id_teacher);

    //         $name = $dataTeacher['name_user'];
    //         $lastname = $dataTeacher['last_name_user'];
    //         $email = $dataTeacher['email'];
    //         $state = $dataTeacher['state'];
    //         $generatePassword = UserController::generateRandomPassword(14);
    //         $hashedPassword = password_hash($generatePassword, PASSWORD_DEFAULT);
    //         $changeState = TeacherModel::changeStateTeacher($id_teacher);
    //         if ($state == 1) {
    //             echo '<script>
    //             if (window.history.replaceState) {
    //                 window.history.replaceState(null, null, window.location.href);
    //             }
    //             alert("No se pudo crear el usuario, ya existe.")</script>';
    //             return;
    //         }
    //         if ($changeState) {
    //             $newPassword = TeacherModel::updatePassword($id_teacher, $hashedPassword);
    //             if ($newPassword) {
    //                 $execute = MailerController::sendNewUser($generatePassword, $email, $name, $lastname);
    //                 if ($execute) {
    //                     echo '<script>
    //                         if (window.history.replaceState) {
    //                             window.history.replaceState(null, null, window.location.href);
    //                         }
    //                         window.location="../index.php?pages=manageTeacher&message=correcto";
    //                         </script>';
    //                 } else {
    //                     echo '<script>
    //                         if (window.history.replaceState) {
    //                             window.history.replaceState(null, null, window.location.href);
    //                         }
    //                         alert("No se pudo enviar el email.");
    //                         </script>';
    //                 }
    //             } else {
    //                 echo '<script>
    //                     if (window.history.replaceState) {
    //                         window.history.replaceState(null, null, window.location.href);
    //                     }
    //                     alert("No se pudo actualizar la contraseña.");
    //                     </script>';
    //             }
    //         } else {
    //             echo '<script>
    //                 if (window.history.replaceState) {
    //                     window.history.replaceState(null, null, window.location.href);
    //                 }
    //                 alert("No se pudo cambiar el estado del profesor.");
    //                 </script>';
    //         }
    //     }
    // }
}
