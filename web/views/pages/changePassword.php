<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card w-100" style="max-width: 400px;">
        <div class="card-header text-center bg-warning text-dark fs-6 fw-bold">
            <span class="fs-5 font-weight-bold">
                <h4 class="my-1 font-weight-bold">Cambiar contraseña</h4>
            </span>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label fw-bold">Contraseña actual</label>
                    <input type="password" class="form-control border-primary" name="currentPassword" placeholder="Introduzca su contraseña actual">
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label fw-bold">Nueva contraseña</label>
                    <input type="password" class="form-control border-primary" name="newPassword" placeholder="Introduzca su nueva contraseña">
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label fw-bold">Confirmar nueva contraseña</label>
                    <input type="password" class="form-control border-primary" name="confirmPassword" placeholder="Confirme su nueva contraseña">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" name="enviar" class="btn btn-warning text-dark w-50">Cambiar</button>
                </div>
            </form>
            <?php

            if (isset($_POST['enviar'])) {
                $controller = new UserController();
                $controller->newPassword();
            }

            ?>
        </div>
    </div>
</div>