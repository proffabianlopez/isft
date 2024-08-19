<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body class="d-flex justify-content-center align-items-center">
    <div class="pt-2 pt-sm-5 pb-4 pb-sm-5">
        <!--Form login -->
        <div class="container-fluid bg-white rounded border border-light border-4" id="login-form">
            <div class="row">
                <!-- Logo -->
                <div class="col-sm-6 slider rounded">
                    <span><img src="public/img/logoisft177.png" alt="logo" height="220"></span>
                </div>

                <div class="col-sm-6 p-4">
                    <form method="post">

                        <div class="pt-3 mb-3">
                            <label for="emailaddress" class="col-sm-2 form-label fw-medium">Email</label>
                            <div class="">
                                <input class="form-control" type="email" id="emailaddress" placeholder="Ingrese su email" name="mail" required>
                            </div>
                        </div>

                        <div class="pt-3 mb-1">
                            <label for="password" class="form-label fw-medium pl-2">Contraseña</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control password" placeholder="Ingrese su contraseña" name="password" required>
                                <button class="btn btn-outline-primary togglePassword" type="button" data-bs-toggle="button">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <a href="#" id="forgot-password-link" class="text-decoration-none">Recordar</a>

                        <div class="pt-3 mb-0 mt-3 text-center">
                            <button class="btn btn-primary p-2" type="submit" name="enviar"> Iniciar sesión </button>
                        </div>

                        <?php
                        if (isset($_POST['enviar'])) {
                            $controller = new UserController(); // Instancia el controlador
                            $controller->control_login(); // Llama al método control_login()
                        }
                        ?>

                    </form>
                </div>
            </div>
        </div>
        <!--Form recordar contraseña -->
        <div class="container-fluid bg-white rounded border border-light border-4" id="forgot-password-form" style="display: none;">
            <div class="row">
                <!-- Logo -->
                <div class="col-sm-6 slider rounded">
                    <span><img src="public/img/logoisft177.png" alt="logo" height="220"></span>
                </div>

                <div class="col-sm-6 p-4">
                    <form method="post">

                        <div class="pt-3 mb-3">
                            <label for="emailaddress" class="col-sm-2 form-label fw-medium">Email</label>
                            <div class="">
                                <input class="form-control" type="email" id="emailaddress" placeholder="Ingrese su email" name="mail" required>
                            </div>
                        </div>

                        <div class="pt-3 pb-4 mt-3 text-center">
                            <button class="btn btn-primary p-2" type="submit" name="enviar"> Recordar contraseña </button>
                        </div>

                        <a href="#" id="back-to-login-link" class="text-decoration-none">Volver</a>
                        <?php
                        /*if (isset($_POST['enviar'])) {
                            $controller = new UserController(); // Instancia el controlador
                            $controller->control_login(); // Llama al método control_login()
                        }*/
                        ?>

                    </form>
                </div>
            </div>
        </div>
        <!-- end container -->
        <div class="container mt-4" id="password-note">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-info text-center">
                        <p class="mb-0"><b>NOTA: </b>Si es su primera vez ingresando, deberá cambiar la contraseña.</p>
                    </div>
                </div>
            </div>
        </div>

        <script src="public/js/showEyePassword.js"></script>
        <script src="public/js/loginForm.js"></script>
        <script src="public/js/bootstrap.bundle.min.js"></script>
</body>

</html>