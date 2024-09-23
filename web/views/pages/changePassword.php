<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card w-100" style="max-width: 400px;">
        <div class="card-header text-center bg-warning text-dark fs-6 fw-bold">
            <span class="fs-5 font-weight-bold">
                <h4 class="my-1 font-weight-bold">Cambiar contraseña</h4>
            </span>
        </div>
        <div class="card-body">
            <form id="changepassword">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label fw-bold">Contraseña actual</label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control border-primary password reset" name="currentPassword"
                            placeholder="Introduzca su contraseña actual">
                        <button class="btn btn-outline-primary togglePassword" type="button" data-bs-toggle="button">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="newPassword" class="form-label fw-bold">Nueva contraseña</label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control border-primary password reset" name="newPassword"
                            placeholder="Introduzca su nueva contraseña">
                        <button class="btn btn-outline-primary togglePassword" type="button" data-bs-toggle="button">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="confirmPassword" class="form-label fw-bold">Confirmar nueva contraseña</label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control border-primary password reset" name="confirmPassword"
                            placeholder="Confirme su nueva contraseña">
                        <button class="btn btn-outline-primary togglePassword" type="button" data-bs-toggle="button">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" name="enviar" class="btn btn-warning text-dark w-50 ladda-button">Cambiar</button>
                </div>
            </form>
            <div class="response-message text-center"></div>

        </div>
    </div>
</div>