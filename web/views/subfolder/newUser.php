<div class="container pt-4 pb-3">
    <div class="row justify-content-center">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header bg-custom text-black text-center">
                    <h4 class="my-1 font-weight-bold">Nuevo usuario</h4>
                </div>
                <div class="card-body pb-0">
                    <form id="newuser">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="form-group px-2 py-2">Los campos con (<span class="text-danger">*</span>) son
                                    obligatorios.</p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="pt-1" for="lastName">Apellido <span
                                            class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" class="form-control reset" name="lastName"
                                        value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="pt-1" for="name">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="50" class="form-control reset" name="name"
                                        value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                                        required>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pt-1" for="dni">DNI <span class="text-danger">*</span></label>
                                            <input type="text" maxlength="8"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                class="form-control reset" name="dni"
                                                value="<?php echo isset($_POST['dni']) ? htmlspecialchars($_POST['dni']) : ''; ?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pt-1" for="tel">Teléfono (Opcional)</label>
                                            <input type="text" maxlength="10"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                class="form-control reset" name="tel"
                                                 placeholder="Formato 11 12345678"
                                                value="<?php echo isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : ''; ?>"
                                                >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">


                                <div class="form-group px-2">
                                    <label class="pt-1" for="mail">Correo electrónico <span
                                            class="text-danger">*</span></label>
                                    <input type="email" maxlength="255" class="form-control reset" name="mail"
                                        value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : ''; ?>"
                                        required>
                                </div>
                                <div class="form-group px-2">
                                    <label class="pt-1" for="gender">Género <span class="text-danger">*</span></label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <?php
                                        $selectedGender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
                                        (new GendersController())->gendersSelect($selectedGender);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group px-2">
                                    <label class="pt-1" for="roles">Rol <span class="text-danger">*</span></label>
                                    <select class="form-control" id="roles" name="roles" required>
                                        <?php
                                        $selectedRole = isset($_POST['roles']) ? htmlspecialchars($_POST['roles']) : '';
                                        (new RolesController())->rolesSelect($selectedRole);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 pt-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" name="loadUser" class="ladda-button btn w-25 btn-warning"
                                        data-style="expand-right">Crear</button>
                                </div>
                            </div>

                        </div>
                    </form>
                    <br>
                    <div class="response-message text-center"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-info text-center">
                <p class="my-1"><b>NOTA: </b>Cuando se crea un nuevo usuario, se le enviarán todos los datos por correo
                    electrónico.</p>
            </div>
        </div>
    </div>
</div>