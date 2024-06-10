<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-header bg-custom text-dark text-center">
                    <h4 class="my-1 font-weight-bold">Cambiar contraseña</h4>
                </div>
                <div class="card-body">
                    <form method='POST'>
                        <div class="form-group">
                            <label for="newPassword">Nueva Contraseña</label>
                            <input type="password" class="form-control" name="newPassword" placeholder="Introduce tu nueva contraseña" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Repetir Contraseña</label>
                            <input type="password" class="form-control" name="confirmPassword" placeholder="Repite tu nueva contraseña" required>
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