<div class="container-x1 py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Cambiar contraseña</h4>
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
                    <button type="submit" name="send" class="btn btn-primary btn-block">Cambiar Contraseña</button>
                    <?php
                    if(isset($_POST['send'])){
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
                    <p><b>NOTA: </b>Esta pestaña solo aparecerá una vez.</p>  
                </div>
            </div>
        </div>
    </div>

</div>