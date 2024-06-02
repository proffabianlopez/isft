<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Nuevo Usuario</h4>
                </div>
                <div class="card-body">
                    <form method='POST'>
                        <div class="form-group">
                            <label class="py-1 p-2" for="dni">DNI</label>
                            <input type="text" maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="dni" placeholder="Ingresa el dni">
                        </div>
                        <div class="form-group">
                            <label class="py-1 p-2" for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" placeholder="Ingresa el nombre">
                        </div>
                        <div class="form-group">
                            <label class="py-1 p-2" for="lastName">Apellido</label>
                            <input type="text" class="form-control" name="lastName" placeholder="Ingresa el apellido">
                        </div>
                        <div class="form-group">
                            <label class="py-1 p-2" for="mail">Correo electrónico</label>
                            <input type="email" class="form-control" name="mail" placeholder="Ingresa el correo electrónico">
                        </div>
                        <div class="form-group">
                            <label class="py-1 p-2" for="gender">Gender: </label>
                            <select class="form-control" id="gender" name="gender">
                                <?php
                                (new GendersController())->gendersSelect();
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="py-1 p-2" for="roles">Rol: </label>
                            <select class="form-control" id="roles" name="roles">
                                <?php
                                (new RolesController())->rolesSelect();
                                ?>
                            </select>
                        </div>
                        <button type="submit" name='loadUser' class="btn btn-primary btn-block">Enviar</button>
                        <?php
                        if (isset($_POST['loadUser'])) {
                            $controller = new UserController();
                            $controller->newUser();
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-info text-center">
                <p><b>NOTA: </b>Cuando se crea un nuevo usuario, se le enviarán todos los datos por correo electrónico.</p>
            </div>
        </div>
    </div>
</div>