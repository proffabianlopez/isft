<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Nuevo alumno</h4>
                </div>
                <div class="card-body">
                    <form method='POST'>
                        <!-- <div class="form-group">
                            <label class="py-1 p-2" for="fileNumber">Número de legajo</label>
                            <input type="text" class="form-control" name="fileNumber" placeholder="Ingresa el legajo">
                        </div> -->
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
                            <label class="py-1 p-2" for="mail">Fecha de ingreso</label>
                            <input type="text" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="date" placeholder="Ingresa la fecha de ingreso">
                        </div>
                        <button type="submit" name='loadUser' class="btn btn-primary btn-block">Enviar</button>
                        <?php
                        if (isset($_POST['loadUser'])) {
                            $controller = new UserController();
                            $controller->newStudent();
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
                <p><b>NOTA: </b>Recordar que, al crear un nuevo usuario, éste tendrá de forma predeterminada la contraseña 1234. Luego deberá cambiarla.</p>
            </div>
        </div>
    </div>
</div>