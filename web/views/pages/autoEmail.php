<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h4 class="mt-5 text-center">Configuración de Email Automático</h4>
      <form class="mt-3">
        <div class="mb-3">
          <label for="host_email" class="form-label">Host Email*</label>
          <input type="text" class="form-control" id="host_email" placeholder="Ingrese el host de su email ej smtp.gmail.com">
        </div>
        <div class="mb-3">
          <label for="password_email" class="form-label">Email*</label>
          <input type="text" class="form-control" id="email" placeholder="Ingrese el email">
        </div>
        <div class="mb-3">
          <label for="password_email" class="form-label">Contraseña*</label>
          <input type="password" class="form-control" name="password" placeholder="Ingrese su contraseña">
        </div>
        <div class="mb-3">
          <label for="port_email" class="form-label">Port*</label>
          <input type="number" class="form-control" name="port_email" placeholder="Ingrese el puerto del email">
        </div>
        <div class="mb-3">
          <label for="port_email" class="form-label">certificado (opcional)</label>
          <input type="text" class="form-control" name="certificate" placeholder="por defecto tls">
        </div>
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
      </form>
    </div>
  </div>
</div>
