<?php 

class StudentController extends UserModel {

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
            $date = $_POST['date'];
            if (!ctype_digit($date) || strlen($date) > 4 || strlen($date) < 4) {
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    </script>
                    <div class="alert alert-danger mt-2">Año inválido. Recuerde que deben ser 4 números.</div>';
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
                <div class="alert alert-danger mt-2">Ya existe el Email o el Dni</div>';
                return;
        }
            $execute = StudentModel::newStudent($name, $lastname, $email, $dni, $date, $gender);

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


}