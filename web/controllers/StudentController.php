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
            $date = $_POST['date'];
            $id_career = $_POST['carrer'];

            if (!ctype_digit($date) || strlen($date) != 4 || $date < 1992 || $date > ($currentYear = date('Y'))) {
                $response["status"] = "error";
                $response["message"] = "Año inválido. Recuerde que deben ser 4 números, entre 1992 y el año actual.";
                return $response;
            }


            // Filtra el duplicado del DNI
            $checkCountDniOrEmail = StudentModel::checkForDuplicates($dni, $email);

            if ($checkCountDniOrEmail !== false) {
                $response["status"] = "error";
                $response["message"] = "Ya existe el Email o el DNI";
                return $response;
            }

            $execute = StudentModel::newStudent($name, $lastname, $email, $dni, $date, $gender);


            if ($execute) {
                AssignmentModel::insertCareerPerson($id_career, $execute);

                $response['title'] = "¡Éxito!";
                $response["status"] = "successReset";
                $response["message"] = "Se guardó los datos correctamente";
                return $response;
            } else {
                $response["status"] = "error";
                $response["message"] = "Hubo un problema al crearlo";
                return $response;
            }
        } else {
            $response["status"] = "error";
            $response["message"] = "Debes completar los campos";
        }
        return $response;
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

        $dni = trim($_POST['dni']);
        if (!ctype_digit($dni) || strlen($dni) > 8 || strlen($dni) < 6 || intval($dni) < 5000000) {
            $response["status"] = "error";
            $response["message"] = "DNI inválido. Debe ser un número entre 6 y 8 dígitos.";
            return $response;
        }
        
        $date = $_POST['date'];
        if (!ctype_digit($date) || strlen($date) != 4 || $date < 1992 || $date > ($currentYear = date('Y'))) {
            $response["status"] = "error";
            $response["message"] = "Año inválido. Recuerde que deben ser 4 números, entre 1992 y el año actual.";
            return $response;
        }

        $id_student = $_POST['id_student'];
        $id_career_person = $_POST['id_career_person'];
        $id_career = $_POST['carrer'];

        $execute = StudentModel::updateStudentData($name, $lastname, $id_student, $dni, $date);
        if ($execute) {
            AssignmentModel::updateCareerStudent($id_career, $id_career_person);

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
        if (!empty($_POST['student_id']) && !empty($_POST['career_id']) && isset($_POST['file'])) {
            // Obtener datos del formulario
            $id_student = $_POST['student_id'];
            $id_career = $_POST['career_id'];
            $file = $_POST['file'];
    
            // Validar y completar el número de legajo con ceros a la izquierda si es necesario
            $file = str_pad($file, 4, '0', STR_PAD_LEFT);
    
            // Verificar que el legajo no supere los 4 dígitos
            if (strlen($file) > 4) {
                $response["status"] = "error";
                $response["message"] = "El legajo no puede tener más de 4 dígitos.";
                return $response;
            }
    
            // Obtener abreviatura de la carrera
            $data_career = CareerModel::nameCareer($id_career);
            $abbreviation = $data_career['abbreviation'];
    
            // Concatenar abreviatura al nombre del archivo
            $file_with_abbreviation = $abbreviation . $file;
    
            // Actualizar legajo en la base de datos
            $execute = StudentModel::updateLegajo($file_with_abbreviation, $id_student);
    
            if ($execute === true) {
                // Redireccionar con mensaje de éxito si la actualización fue exitosa
                $response['title'] = "¡Éxito!";
                $response["status"] = "successReset";
                $response["message"] = "Se guardó los datos correctamente";
                return $response;
            } elseif ($execute === false) {
                // Redireccionar con mensaje de error si el legajo ya existe
                $response["status"] = "error";
                $response["message"] = "El legajo ya está en uso por otro estudiante.";
                return $response;
            } else {
                // Manejar otros posibles errores
                $response["status"] = "error";
                $response["message"] = "Hubo un problema al asignar legajo";
                return $response;
            }
        } else {
            // Mostrar mensaje si algún campo está vacío
            $response["status"] = "error";
            $response["message"] = "Debes completar los campos";
        }
        return $response;
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
