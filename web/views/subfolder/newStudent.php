<div class="container pt-4 pb-3">
    <div class="row justify-content-center">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header bg-custom text-black text-center">
                    <h4 class="my-1 font-weight-bold">Nuevo alumno</h4>
                </div>
                <div class="card-body pb-0">
                    <form method='POST'>
                        <div class="row">

                            <!-- <div class="form-group">
                            <label class="py-1 p-2" for="fileNumber">Número de legajo</label>
                            <input type="text" class="form-control" name="fileNumber" placeholder="Ingresa el legajo">
                        </div> -->
                            <div class="col-sm-12">
                                <p class="form-group px-2 py-2">Los campos con (<span class="text-danger">*</span>) son obligatorios.</p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="row px-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pt-1" for="lastName">Apellido <span class="text-danger">*</span></label>
                                            <input type="text" maxlength="128" class="form-control" name="lastName" placeholder="Ingrese el apellido" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pt-1" for="name">Nombre <span class="text-danger">*</span></label>
                                            <input type="text" maxlength="128" class="form-control" name="name" placeholder="Ingrese el nombre" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group px-2">
                                    <label class="pt-1" for="dni">DNI <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="dni" placeholder="Ingrese el dni" value="<?php echo isset($_POST['dni']) ? htmlspecialchars($_POST['dni']) : ''; ?>" required>
                                </div>
                                <div class="form-group px-2">
                                    <label class="pt-1" for="mail">Correo electrónico <span class="text-danger">*</span></label>
                                    <input type="email" maxlength="255" class="form-control" name="mail" placeholder="Ingrese el correo electrónico" value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : ''; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">

                                <div class="form-group px-2">
                                    <label class="pt-1" for="gender">Género <span class="text-danger">*</span></label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <?php
                                        $selectedGender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
                                        (new GendersController())->gendersSelect($selectedGender);
                                        ?>
                                    </select>
                                </div>
                                <?php if ($_SESSION['fk_rol_id'] == 1) : ?>
                                    <div class="form-group px-2">
                                        <label class="pt-1" for="carrer">Carrera <span class="text-danger">*</span></label>
                                        <select class="form-control" id="carrer" name="carrer" required>
                                            <?php
                                            $selectedCareer = isset($_POST['carrer']) ? htmlspecialchars($_POST['carrer']) : '';
                                            (new CareerController())->careerSelect($selectedCareer);
                                            ?>
                                        </select>
                                    </div>
                                <?php else : ?>
                                    <div class="form-group px-2">
                                        <label class="pt-1" for="carrer">Carrera <span class="text-danger">*</span></label>
                                        <select class="form-control" id="carrer" name="carrer" required>
                                            <?php
                                            $selectedCareer = isset($_POST['carrer']) ? htmlspecialchars($_POST['carrer']) : '';
                                            (new CareerController())->careerSelectPreceptor($_SESSION['id_user'], $selectedCareer);
                                            ?>
                                        </select>

                                    </div>
                                <?php endif ?>
                                <div class="form-group px-2">
                                    <label class="pt-1" for="cohorte">Cohorte <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="date" placeholder="Ingrese el cohorte" value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : ''; ?>" required>
                                </div>


                            </div>
                            <div class="col-sm-12 pt-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" name='loadUser' class="btn bg-custom btn-block w-25 btn-warning">Crear</button>
                                </div>
                            </div>

                            <?php
                            if (isset($_POST['loadUser'])) {
                                $controller = new StudentController();
                                $controller->newStudent();
                            }
                            ?>
                        </div>
                    </form>
                    <br>
                    <?php $message = new MessageController();
                    $message->showMessageVerify('message', "Se creó correctamente al alumno") ?>

                </div>
            </div>
        </div>
    </div>
</div>