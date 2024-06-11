
<?php
$data = CareerController::getCareersData();
?>
<section class="container-fluid py-3">
    <h1 class="text-center mt-1 mb-3 py-2">Gestionar Carreras del Instituto</h1>
    <div class="row py-4">
        <?php foreach ($data as $key => $value) : ?>
            <div class="col-lg-6">
                <a href="index.php?pages=toolsCareer&id_career=<?php echo $value['id_career']?>&name_career=<?php echo $value['career_name'] ?>&state=<?php echo $value['state'] ?>"> 
                    <div class="small-box bg-secondary">
                        <?php if ($value['state'] == 'inactive') : ?>
                            <div class="ribbon-wrapper ribbon-xl">
                                <div class="ribbon bg-danger">
                                    Inactivo
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="inner">
                            <h3>Gestionar Carrera</h3>
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
<button type="button" class="btn btn-primary btn-floating" data-toggle="modal" data-target="#createCareerModal" title="crear carrera">
    <i class="fas fa-plus-circle"></i>
</button>
<div class="modal fade" id="createCareerModal" tabindex="-1" role="dialog" aria-labelledby="createCareerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="createCareerModalLabel">Crear Nueva Carrera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createCareerForm" method="post">
                    <div class="form-group">
                        <label for="careerName">Nombre de la Carrera</label>
                        <input type="text" class="form-control" id="careerName" name="careerName" placeholder="Ingrese el nombre de la carrera" required>
                    </div>
                    <div class="form-group">
                        <label for="careerTitle">Título</label>
                        <input type="text" class="form-control" id="careerTitle" name="description" placeholder="Ingrese el título de la carrera" required>
                    </div>
                    <div class="form-group">
                        <label for="careerAbbreviation">Abreviación</label>
                        <input type="text" class="form-control" id="careerAbbreviation" name="abbreviation" placeholder="Abreviatura para legajo" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" form="createCareerForm" class="btn btn-warning" name="loadCareer">Guardar</button>
            </div>
            <?php
                        if (isset($_POST['loadCareer'])) {
                            $controller = new CareerController();
                            $controller->newCareer();
                        }
                        ?>
        </div>
    </div>
</div>
