<div class="container pt-4 pb-3">
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header bg-custom text-black text-center">
                    <h4 class="my-1 font-weight-bold">Nuevo profesor</h4>
                </div>
                <div class="card-body">
                    <form id="newteacher">
                        <p class="form-group px-2 py-2">Los campos con (<span class="text-danger">*</span>) son
                            obligatorios.</p>
                        <div class="row px-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="lastName">Apellido <span
                                            class="text-danger reset">*</span></label>
                                    <input type="text" maxlength="128" class="form-control reset" name="lastName"
                                        placeholder="Ingrese el apellido"
                                        value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>"
                                        required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="name">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="128" class="form-control reset" name="name"
                                        placeholder="Ingrese el nombre"
                                        value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row px-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="dni">DNI <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="8"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        class="form-control reset" name="dni" placeholder="Ingrese el dni"
                                        value="<?php echo isset($_POST['dni']) ? htmlspecialchars($_POST['dni']) : ''; ?>"
                                        required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="gender">Género <span class="text-danger">*</span></label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <?php
                                        $selectedGender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
                                        (new GendersController())->gendersSelect($selectedGender);
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row px-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="mail">Correo electrónico <span
                                            class="text-danger">*</span></label>
                                    <input type="email" maxlength="255" class="form-control reset" name="mail"
                                        placeholder="Ingrese el correo electrónico"
                                        value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : ''; ?>"
                                        required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="tel">Teléfono (Opcional)</label>
                                    <input type="text" maxlength="10" minlength="10" class="form-control reset"
                                        name="tel" id="tel" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        placeholder="Formato 11 12345678"
                                        value="<?php echo isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : ''; ?>">

                                    <small id="telError" class="text-danger" style="display:none;">El teléfono debe
                                        tener 10 dígitos y ser numérico.</small>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" name='loadTeacher' id="submitBtn"
                                class="btn bg-custom btn-block w-50 btn-warning">Crear</button>
                        </div>
                    </form>


                    <br>
                    <div class="response-message text-center"></div>
                </div>
            </div>
        </div>
    </div>
</div>