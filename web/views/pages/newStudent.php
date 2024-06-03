<div class="container pt-4 pb-3">
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header bg-custom text-black text-center">
                    <h4 class="my-1 font-weight-bold">Nuevo alumno</h4>
                </div>
                <div class="card-body">
                    <form method='POST'>
                        <!-- <div class="form-group">
                            <label class="py-1 p-2" for="fileNumber">Número de legajo</label>
                            <input type="text" class="form-control" name="fileNumber" placeholder="Ingresa el legajo">
                        </div> -->
                        <div class="row px-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="name">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Ingrese el nombre" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="lastName">Apellido <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="lastName" placeholder="Ingrese el apellido" required>
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
                            <label class="pt-1" for="mail">Fecha de ingreso <span class="text-danger">*</span></label>
                            <input type="text" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="date" placeholder="Ingrese la fecha de ingreso" required>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" name='loadUser' class="btn bg-custom btn-block w-50">Crear alumno</button>
                        </div>
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-info text-center">
                <p class="my-1"><b>NOTA: </b>La contraseña por defecto es <span class="font-weight-bold">1234</span>. Luego deberá cambiarla.</p>
            </div>
        </div>
    </div>
</div>