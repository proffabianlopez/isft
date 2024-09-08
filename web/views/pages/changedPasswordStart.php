<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-header bg-custom text-dark text-center">
                    <h4 class="my-1 font-weight-bold">Cambiar contraseña</h4>
                </div>
                <div class="card-body">
                    <form method='POST'>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label fw-bold">Nueva contraseña</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control password" name="newPassword"
                                    placeholder="Introduzca tu nueva contraseña">
                                <button class="btn btn-outline-primary togglePassword" type="button" data-bs-toggle="button">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <!-- <div class="pt-3 mb-1">
                            <label for="password" class="form-label fw-medium pl-2">Contraseña</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control password" placeholder="Ingrese su contraseña" name="password" required>
                                <button class="btn btn-outline-primary togglePassword" type="button" data-bs-toggle="button">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div> -->
                        
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label fw-bold">Repetir contraseña</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control password" name="confirmPassword"
                                    placeholder="Repite tu nueva contraseña">
                                <button class="btn btn-outline-primary togglePassword" type="button" data-bs-toggle="button">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" name="send" class="btn bg-custom btn-warning btn-block">Cambiar Contraseña</button>
                        <?php
                        if (isset($_POST['send'])) {
                            $controller = new UserController();
                            $controller->changePasswordStart();
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="alert alert-info text-center">
                    <p class="mb-0 py-2"><b>NOTA: </b>Esta pestaña solo aparecerá una vez.</p>
                </div>
            </div>
        </div>
    </div>

</div>