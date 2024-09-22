<?php 
$id = $_SESSION['id_user'];
$infoCredentialUser=UserModel::getFirstValidCredential($id);
 if(empty($infoCredentialUser)): ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg p-4 mt-5">
        <h4 class="text-center mb-4">Configurar correo</h4>
        <form id="formEmailInsert" method="Post">
          <div class="mb-3">
            <label for="host_email" class="form-label">Host Email*</label>
            <input type="email" class="form-control" name="host" placeholder="Ingrese el host de su email ej smtp.gmail.com" required maxlength="255">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email*</label>
            <input type="text" class="form-control" name="email" placeholder="Ingrese el email" maxlength="255" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label fw-medium">Contraseña*</label>
            <div class="input-group input-group-merge">
              <input type="password" class="form-control password" placeholder="Ingrese su contraseña" name="password" required>
              <button class="btn btn-outline-primary togglePassword" type="button" data-bs-toggle="button">
                <i class="bi bi-eye-slash"></i>
              </button>
            </div>
          </div>
          <div class="mb-3">
            <label for="port_email" class="form-label">Port*</label>
            <input type="number" class="form-control" name="port_email" placeholder="Ingrese el puerto del email" min="0" required>
          </div>
          <div class="mb-3">
            <label for="certificate" class="form-label">Certificado (opcional)</label>
            <input type="text" class="form-control" name="certificate" placeholder="por defecto tls">
          </div>
          <button type="submit" name="saveData" class="btn btn-warning w-100">Guardar Datos</button>
          <div class="response-message text-center mt-3"></div>
        </form>
      </div>
      <br>
      <?php 
        $message = new MessageController();
        $message->show_messages_error('void', "Debe completar los campos * Obligatorio"); 
        $message->show_messages_error('email', "El email debe ser válido");
        $message->show_messages_error('caracter', "El email o el host no deben superar los 255 caracteres");
        $message->show_messages_error('port', "El puerto debe ser un número positivo sin caracteres especiales.");
        $message->showMessageVerify('insert', "Se guardaron los datos correctamente");
        $message->show_messages_error('save', "No se pudieron guardar los datos, error");
      ?> 
    </div>
  </div>
</div>

<?php if(isset($_POST['saveData'])){
  $controller = new UserController();
  $controller->insertCredentialEmail();
} ?>
<div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="alert alert-info text-center">
                    <p class="mb-0 py-2"><b>NOTA: </b>Establecer los datos necesarios para el envío automático de correos</p>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg p-4 mt-5">
        <h4 class="text-center mb-4">Editar correo</h4>
        <form id="formEmail" method="post">
          <div class="mb-3">
            <label for="host_email" class="form-label">Host Email*</label>
            <input type="text" class="form-control" id="host_email" name="host_email" placeholder="Ingrese el host de su email ej smtp.gmail.com" value="<?= $infoCredentialUser['host'] ?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email*</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese el email" maxlength="255" value="<?= $infoCredentialUser['email'] ?>">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label fw-medium">Contraseña*</label>
            <div class="input-group input-group-merge">
              <input type="password" class="form-control password" placeholder="Ingrese su contraseña" name="password" value="<?= $infoCredentialUser['token'] ?>" required>
              <button class="btn btn-outline-primary togglePassword" type="button" data-bs-toggle="button">
                <i class="bi bi-eye-slash"></i>
              </button>
            </div>
          </div>
          <div class="mb-3">
            <label for="port_email" class="form-label">Port*</label>
            <input type="number" class="form-control" name="port_email" placeholder="Ingrese el puerto del email" min="0" value="<?= $infoCredentialUser['port_email'] ?>">
          </div>
          <div class="mb-3">
            <label for="certificate" class="form-label">Certificado (opcional)</label>
            <input type="text" class="form-control" name="certificate" placeholder="Por defecto tls" value="<?= $infoCredentialUser['certificatedSSL'] ?>">
          </div>
          <button type="submit" class="btn btn-warning w-100" name="edit">Guardar</button>
        </form>
        <br>
        <?php 
        $message = new MessageController();
        $message->show_messages_error('void', "Debe completar los campos * Obligatorio"); 
        $message->show_messages_error('email', "El email debe ser válido");
        $message->show_messages_error('caracter', "El email o el host no deben superar los 255 caracteres");
        $message->show_messages_error('port', "El puerto debe ser un número positivo sin caracteres especiales.");
        $message->showMessageVerify('insert', "Se guardaron los datos correctamente");
        $message->show_messages_error('save', "No se pudieron guardar los datos, error");
      ?> 
      </div>
    </div>
  </div>
</div>
<?php if(isset($_POST['edit'])){
  $controller = new UserController();
  $controller->updateCredentialEmail();
} ?>
 <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="alert alert-info text-center">
                    <p class="mb-0 py-2"><b>NOTA: </b>Editar la configuración para el envío automático de correos</p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
