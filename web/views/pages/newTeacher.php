<div class="container pt-4 pb-3">
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header bg-custom text-black text-center">
                    <h4 class="my-1 font-weight-bold">Nuevo profesor</h4>
                </div>
                <div class="card-body">
                    <form method='POST'>
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
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" name='loadTeacher' class="btn bg-custom btn-block w-50 btn-warning">Crear profesor</button>
                        </div>

                        <?php
                        if (isset($_POST['loadTeacher'])) {
                            $controller = new TeacherController();
                            $controller->newTeacher();
                        }
                        ?>
                    </form>
                    <br>
                    <?php $message = new MessageController();
                    $message->showMessageVerify('message', "Se creó correctamente al profesor") ?>
                </div>
            </div>
        </div>
    </div>
</div>
