<?php if ($_SESSION['fk_rol_id'] == 1): ?>
    <?php
    $data = CareerController::getCareersData();
    ?>
    <section class="container-fluid py-3">
        <h1 class="text-center mt-1 mb-3 py-2">Carreras del Instituto</h1>
        <div class="row py-4">
            <?php foreach ($data as $key => $value): ?>
                <div class="col-lg-6">
                    <a
                        href="index.php?pages=toolsCareer&id_career=<?php echo $value['id_career'] ?>&name_career=<?php echo $value['career_name'] ?>&state=<?php echo $value['state'] ?>">
                        <div class="small-box bg-secondary">
                            <?php if ($value['state'] == 'inactive'): ?>
                                <div class="ribbon-wrapper ribbon-xl">
                                    <div class="ribbon bg-danger">
                                        Deshabilitado
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="inner">
                                <h3>Gestionar</h3>
                                <h5 class="mb-4"><?php echo $value['career_name'] ?></h5>
                            </div>
                            <div class="icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="small-box-footer">
                                <b>Herramientas</b><i class="fas fa-tools ml-2"></i>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </section>

    <!-- Floating Button -->
    <button type="button" class="btn btn-primary btn-floating" data-toggle="modal" data-target="#createCareerModal"
        title="crear carrera">
        <i class="fas fa-plus-circle"></i>
    </button>
    <div class="modal fade cierreModal" id="createCareerModal" tabindex="-1" role="dialog"
        aria-labelledby="createCareerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="createCareerModalLabel">Crear nueva carrera</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="form-group px-2 py-2">Los campos con (<span class="text-danger">*</span>) son obligatorios.
                    </p>
                    <form id="createCareerForm">
                        <div class="form-group">
                            <label for="careerName">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="careerName" name="careerName"
                                placeholder="Ingrese el nombre de la carrera" required>
                        </div>
                        <div class="form-group">
                            <label for="careerTitle">Título <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="careerTitle" name="description"
                                placeholder="Ingrese el título de la carrera" required>
                        </div>
                        <div class="form-group">
                            <label for="careerAbbreviation">Abreviación <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="careerAbbreviation" name="abbreviation"
                                pattern="[A-Za-z]{2}" title="Solo se permiten letras y máximo 2 caracteres"
                                placeholder="Abreviatura para el legajo" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" form="createCareerForm" class="btn btn-warning"
                                name="loadCareer">Guardar</button>
                        </div>
                        <div class="response-message text-center"></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<!-- Vista de Preceptor por Carrera -->
<?php if ($_SESSION['fk_rol_id'] == 2): ?>
    <?php
    $data = CareerController::careerPreceptorController($_SESSION['id_user']);
    ?>
    <section class="container-fluid py-3">
        <h1 class="text-center mt-1 mb-3 py-2">Carreras del Instituto</h1>
        <div class="row py-4">
            <?php foreach ($data as $key => $value): ?>
                <div class="col-lg-6">
                    <a
                        href="index.php?pages=toolsCareer&id_career=<?php echo $value['id_career'] ?>&name_career=<?php echo $value['career_name'] ?>&state=<?php echo $value['state'] ?>">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>Gestionar</h3>
                                <h5 class="mb-4"><?php echo $value['career_name'] ?></h5>
                            </div>
                            <div class="icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="small-box-footer">
                                <b>Herramientas</b><i class="fas fa-tools ml-2"></i>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </section>
<?php endif ?>