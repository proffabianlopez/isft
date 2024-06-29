<?php

class StudentController
{

    //logica controlador para crear un nuevo estudiante
    static public function newStudent()
    {

        if ((!empty($_POST['name'])) && (!empty($_POST['lastName'])) &&
            (!empty($_POST['mail'])) && (!empty($_POST['dni'])) &&
            (!empty($_POST['gender'])) && (!empty($_POST['date']))

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

            $email = strtolower(trim($_POST['mail']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            if ($email === false) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">                
                        <div class="alert alert-danger mt-2">Email inválido</div>
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
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">                
                        <div class="alert alert-danger mt-2">DNI inválido. Debe ser un número entre 6 y 8 dígitos.</div>
                    </div>
                </div>';
                return;
            }
            $gender = $_POST['gender'];
            $date = $_POST['date'];
            $id_career = $_POST['carrer'];

            if (!ctype_digit($date) || strlen($date) > 4 || strlen($date) < 4) {
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    </script>
                    <div class="col-sm-12 pt-3">
                        <div class="d-flex justify-content-center align-items-center">                
                            <div class="alert alert-danger mt-2">Año inválido. Recuerde que deben ser 4 números.</div>
                        </div>
                    </div>';
                return;
            }


            // Filtra el duplicado del DNI
            $checkCountDniOrEmail = StudentModel::checkForDuplicates($dni, $email);

            if ($checkCountDniOrEmail !== false) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">                
                        <div class="alert alert-danger mt-2">Ya existe el Email o el Dni</div>
                    </div>
                </div>';
                return;
            }

            $execute = StudentModel::newStudent($name, $lastname, $email, $dni, $date, $gender);


            if ($execute) {
                AssignmentModel::insertCareerPerson($id_career, $execute);

                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=manageStudent&subfolder=newStudent&message=correcto";
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">                
                        <div class="alert alert-succes mt-2">Se guardó el registro correctamente</div>
                    </div>
                </div>';
            } else {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=manageStudent&subfolder=newStudent";
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">                
                        <div class="alert alert-danger mt-2">Hubo un problema al crearlo</div>
                    </div>
                </div>';
            }
        } else {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">                
                        <div class="alert alert-danger mt-2">Debes completar los campos</div>
                    </div>
                </div>';
        }
    }
    //trae todo los datos del estudiante
    static public function getAllStudent()
    {
        return StudentModel::getAllStudent();
    }
    //para eliminar un registro de estudiante
    static public function eliminatedStudent()
    {
        if (isset($_POST['id_student'])) {
            $id = $_POST['id_student'];

            $execute = StudentModel::updateStudentState($id); // Agregar el punto y coma (;) aquí

            if ($execute) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                
                window.location="../index.php?pages=manageStudent";
                </script>
                <div class="alert alert-success mt-2">Se borró el registro correctamente</div>';
            } else {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">No se pudo borrar</div>';
            }
        }
    }

    //para editar los datos del estudiante
    static public function editStudent()
    {
        $name = ucwords(strtolower(trim($_POST['name_student'])));
        $lastname = ucwords(strtolower(trim($_POST['last_name_student'])));



        $id_student = $_POST['id_student'];
        $id_career_person = $_POST['id_career_person'];
        $id_career = $_POST['carrer'];

        $execute = StudentModel::updateStudentData($name, $lastname, $id_student);
        if ($execute) {
            AssignmentModel::updateCareerStudent($id_career, $id_career_person);

            echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    
                    window.location="../index.php?pages=manageStudent&subfolder=listStudent";
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
    }
    //para crear la cuenta del estudiante usuario
    static public function generateAccountStudent()
    {
        if (isset($_GET['id_student'])) {
            $id_student = $_GET['id_student'];

            $dataStudent = StudentModel::dataUser($id_student);

            $name = $dataStudent['name_user'];
            $lastname = $dataStudent['last_name_user'];
            $email = $dataStudent['email'];
            $state = $dataStudent['state'];
            $generatePassword = UserController::generateRandomPassword(14);
            $hashedPassword = password_hash($generatePassword, PASSWORD_DEFAULT);

            $changeState = StudentModel::changeStateStudent($id_student);
            if ($state == 1) {
                echo '<script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                        alert("No se pudo crear el usuario, ya existe.")</script>';
                return;
            }
            if ($changeState) {
                $newPassword = StudentModel::updatePassword($id_student, $hashedPassword);
                if ($newPassword) {
                    $execute = MailerController::sendNewUser($generatePassword, $email, $name, $lastname);
                    if ($execute) {
                        echo '<script>
                                    if (window.history.replaceState) {
                                        window.history.replaceState(null, null, window.location.href);
                                    }
                                    window.location="../index.php?pages=manageStudent&message=correcto";
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
            } else {
                echo '<script>
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }
                            alert("No se pudo cambiar el estado del Alumno.");
                            </script>';
            }
        }
    }

    //logica para darle al estudiante un legajo
    static public function AssingnamentLegajo()
    {
        if (!empty($_POST['student_id']) && !empty($_POST['career_id']) && !empty($_POST['file'])) {
            // Obtener datos del formulario
            $id_student = $_POST['student_id'];
            $id_career = $_POST['career_id'];
            $file = $_POST['file'];

            // Obtener abreviatura de la carrera
            $data_career = CareerModel::careerInfo($id_career);
            $abbreviation = $data_career['abbreviation'];

            // Concatenar abreviatura al nombre del archivo
            $file_with_abbreviation = $abbreviation . $file;

            // Actualizar legajo en la base de datos
            $execute = StudentModel::updateLegajo($file_with_abbreviation, $id_student);

            if ($execute) {
                // Redireccionar con mensaje de éxito si la actualización fue exitosa
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location="../index.php?pages=manageStudent&message=correcto";
                    </script>';
            } else {
                // Redireccionar con mensaje de error si hubo un problema en la actualización
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location="../index.php?pages=newStudent";
                    </script>
                    <div class="alert alert-danger mt-2">Hubo un problema al asignar legajo</div>';
            }
        } else {
            // Mostrar mensaje si algún campo está vacío
            echo '<div class="alert alert-danger mt-2">No puede estar vacío el legajo</div>';
        }
    }

    //traer datos de los alumnos que maneja el preceptor segun las carreras que administre
    static public function getStudentCareerPreceptor($id)
    {
        $careers = CareerModel::careerPreceptor($id);

        if ($careers) {
            $dataStudents = [];
            foreach ($careers as $career) {
                $students = StudentModel::getAllStudentCareerPreceptor($career['id_career']);
                $dataStudents = array_merge($dataStudents, $students);
            }
            return $dataStudents;
        } else {
            return [];
        }
    }
}
