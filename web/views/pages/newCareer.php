<div class="container pt-4 pb-3">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header bg-custom text-black text-center">
                    <h4 class="my-1 font-weight-bold">Nueva carrera</h4>
                </div>
                <div class="card-body">
                    <form method='POST'>
                        <div class="form-group px-2">
                            <label class="pt-1" for="careerName">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="careerName" placeholder="Ingrese el nombre de la carrera" required value="<?php echo isset($_POST['careerName']) ? htmlspecialchars($_POST['careerName']) : ''; ?>">
                        </div>
                        <div class="form-group px-2">
                            <label class="pt-1" for="description">Descripción <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="description" placeholder="Ingrese descripción" required value="<?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?>">
                        </div>
                        <div class="form-group px-2">
                            <label class="pt-1" for="abbreviation">Abreviación <span class="text-danger">*</span></label>
                            <input type="text" maxlength="2" class="form-control" name="abbreviation" placeholder="Ingrese abreviación de la carrera" required value="<?php echo isset($_POST['abbreviation']) ? htmlspecialchars($_POST['abbreviation']) : ''; ?>">
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" name='loadCareer' class="btn bg-custom btn-block w-50 btn-warning">Crear carrera</button>
                        </div>

                        <?php
                        if (isset($_POST['loadCareer'])) {
                            $controller = new CareerController();
                            $controller->newCareer();
                        }
                        ?>
                    </form>
                    <br>
                    <?php $message = new MessageController();
                    $message->showMessageVerify('message', "Se creó correctamente la carrera") ?>
                </div>
            </div>
        </div>
    </div>
</div>