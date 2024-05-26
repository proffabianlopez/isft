<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card w-100" style="max-width: 400px;">
      <div class="card-header text-center text-primary fs-4 fw-bold">
        Cambiar Contraseña
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="mb-3">
            <label for="currentPassword" class="form-label fw-bold">Contraseña Actual</label>
            <input type="password" class="form-control border-primary" name="currentPassword" placeholder="Introduce tu contraseña actual">
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label fw-bold">Nueva Contraseña</label>
            <input type="password" class="form-control border-primary" name="newPassword" placeholder="Introduce tu nueva contraseña">
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label fw-bold">Confirmar Nueva Contraseña</label>
            <input type="password" class="form-control border-primary" name="confirmPassword" placeholder="Confirma tu nueva contraseña">
          </div>
          <button type="submit" name="enviar" class="btn btn-primary w-100">Cambiar Contraseña</button>
        </form>
        <?php
        
        if(isset($_POST['enviar'])){
          $controller = new UserController();
          $controller->newPassword();
        }

        ?>
      </div>
    </div>
  </div>