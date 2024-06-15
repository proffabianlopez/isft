<div class="container pt-4 pb-3">
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header bg-custom text-black text-center">
                    <h4 class="my-1 font-weight-bold">Nuevo usuario</h4>
                </div>
                <div class="card-body">
                    <form method='POST'>
                        <p class="form-group px-2 py-2">Los campos con (<span class="text-danger">*</span>) son obligatorios.</p>
                        <div class="row px-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="lastName">Apellido <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="lastName" placeholder="Ingrese el apellido" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="name">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Ingrese el nombre" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group px-2">
                            <label class="pt-1" for="dni">DNI <span class="text-danger">*</span></label>
                            <input type="text" maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="dni" placeholder="Ingrese el dni" required>
                        </div>
                        <div class="form-group px-2">
                            <label class="pt-1" for="mail">Correo electrónico <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="mail" placeholder="Ingrese el correo electrónico" required>
                        </div>
                        <div class="form-group px-2">
                            <label class="pt-1" for="gender">Género <span class="text-danger">*</span></label>
                            <select class="form-control" id="gender" name="gender" required>
                                <?php
                                (new GendersController())->gendersSelect();
                                ?>
                            </select>
                        </div>
                        <div class="form-group px-2">
                            <label class="pt-1" for="roles">Rol <span class="text-danger">*</span></label>
                            <select class="form-control" id="roles" name="roles" required>
                                <?php
                                (new RolesController())->rolesSelect();
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" name='loadUser' class="btn bg-custom btn-block w-50 btn-warning">Crear</button>
                        </div>
                        <?php
                        if (isset($_POST['loadUser'])) {
                            $controller = new UserController();
                            $controller->newUser();
                        }
                        ?>
                    </form>
                    <br>
                    <?php $message = new MessageController();
                    $message->showMessageVerify('message', "Se creó correctamente el usuario") ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-info text-center">
                <p class="my-1"><b>NOTA: </b>Cuando se crea un nuevo usuario, se le enviarán todos los datos por correo electrónico.</p>
            </div>
        </div>
    </div>
</div>