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
                // $changed = $verificar['changedpassword'];
                $_SESSION['email'] = $mail_user;
                $_SESSION['fk_rol_id'] = $rol;
                if ($state == 1) {
                    $_SESSION['state'] = $state;

                    //     if ($changed == 0) {
                    //         echo '<script>
                    // if ( window.history.replaceState ) {
                    //     window.history.replaceState(null, null, window.location.href);
                    // }

                    // window.location="../views/pages/ChangedPassword.php"; //AGREGAR VISTA CHANGEDPASSWORD
                    // </script>';
                    //     }

                    //if borra todos las variables post
                    echo '<script>
        if ( window.history.replaceState ) {
            window.history.replaceState(null, null, window.location.href);
        }
        
        window.location="../public/index.php?pages=home";
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
}
