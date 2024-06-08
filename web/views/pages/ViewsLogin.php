<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">


            <div class="card">

                <!-- Logo -->
                <div class="card-header py-4 text-center d-flex justify-content-center align-items-center slider">
                    <span><img src="public/img/logoisft177.png" alt="logo" height="220"></span>
                </div>

                <div class="card-body p-4">

                    <div class="text-center w-75 m-auto">
                        <h4 class="text-dark-50 text-center pb-0 fw-bold">Iniciar sesión</h4>
                    </div>

                    <form method="post" data-bitwarden-watching="1">

                        <div class="pt-3 mb-3">
                            <label for="emailaddress" class="form-label fw-medium pr-5">Email</label>
                            <input class="form-control" type="email" id="emailaddress" required="" placeholder="Ingrese su email" name="mail">
                        </div>

                        <div class="pt-3 mb-3">
                            <!-- <a href="pages-recoverpw.html" class="text-muted float-end"><small>¿Olvidaste tu contraseña?</small></a> -->
                            <label for="password" class="form-label fw-medium pl-2">Contraseña</label>
                                <div class="input-group input-group-merge">
                                     <input type="password" id="password" class="form-control" placeholder="Ingrese su contraseña" name="password">
                                          <button class="btn btn-outline-primary" type="button" id="togglePassword" data-bs-toggle="button">
                                              <i class="bi bi-eye-slash"></i>
                                              </button>
                                </div>
                        </div>

                        <!-- <div class="mb-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked="">
                                        <label class="form-check-label" for="checkbox-signin">Recordar</label>
                                    </div>
                                </div> -->

                        <div class="pt-4 mb-3 mb-0 text-center">
                            <button class="btn btn-primary p-2" type="submit" name="enviar"> Iniciar sesión </button>
                        </div>

                        <?php
                        if (isset($_POST['enviar'])) {
                            $controller = new UserController(); // Instancia el controlador
                            $controller->control_login(); // Llama al método control_login()
                        }
                        ?>

                    </form>
                </div> <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
        <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-info text-center">
                    <p><b>NOTA: </b>Si es tu primera vez entrando, deberás cambiar la contraseña.</p>  
                </div>
            </div>
        </div>
        </div>

    <script src="public/js/showEyePassword.js"></script>
    <script src="public/js/bootstrap.bundle.min.js"></script>
</body>

</html>