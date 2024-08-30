<?php
if ((isset($_GET['name_career'])) && (isset($_GET['id_career'])) && (isset($_GET['state']))) {
    $subjects = SubjectController::getAllSubject($_GET['id_career']);
    ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 80%; margin: 0 auto;" id="example3">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <form method="post" class="d-inline-block">
                                    <input type="hidden" name="subject_pdf" value="1">
                                    <button type="submit" class="btn btn-danger" title="Descargar PDF de Materias">
                                        <i class="far fa-file-pdf mr-1"></i> Descargar PDF
                                    </button>
                                </form>
                                <form method="post" class="d-inline-block">
                                    <input type="hidden" name="subject_excel" value="1">
                                    <button type="submit" class="btn btn-success" title="Descargar Excel de Materias">
                                        <i class="far fa-file-pdf mr-1"></i> Descargar Excel
                                    </button>
                                </form>
                            </th>
                        </tr>

                        <tr class="bg-warning">
                            <th>Materias</th>
                            <th>Año</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subjects as $subject): ?>
                            <tr>
                                <td><?php echo $subject['name_subject'] ?></td>
                                <td><?php echo $subject['year_subject'] . " " . $subject['year_detail'] ?></td>
                                <td>
                                    <!-- Botón para abrir el modal -->
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#modal_<?php echo $subject['id_subject'] ?>" title="ver info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <?php if ($_SESSION['fk_rol_id'] == 1): ?>
                                        <!-- Botón para abrir el modal de editar -->
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal_edit_<?php echo $subject['id_subject'] ?>" title="editar materia">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#confirmDeleteModal_<?php echo $subject['id_subject'] ?>">
                                            <i class="fas fa-trash-alt"></i> <!-- Icono de eliminar -->
                                        </button>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if (isset($_POST['subject_pdf'])) {
        (new PdfController())->dataCareerPdfSubject($_GET['name_career'], $_GET['id_career']);
    }
    if (isset($_POST['subject_excel'])) {
        (new ExcelController())->excelDataCareerSubject($_GET['name_career'], $_GET['id_career']);
    }
    ?>
<?php } ?>
<!-- Modales -->
<?php foreach ($subjects as $subject): ?>
    <div class="modal fade" id="modal_<?php echo $subject['id_subject'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles de la Materia:
                        <?php echo $subject['name_subject'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="container py-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <img class="img-fluid" src="public/img/isft177_logo_chico.png"
                                            alt="User profile picture">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <h5><strong>Carrera:</strong></h5>
                                            <p><?php echo htmlspecialchars($subject['career_name']); ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <h5><strong>Curso:</strong></h5>
                                            <p><?php echo htmlspecialchars($subject['year_subject']) . " " . htmlspecialchars($subject['year_detail']); ?>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <h5><strong>Carga Horaria:</strong></h5>
                                            <p><?php echo htmlspecialchars($subject['details']); ?> hs</p>
                                        </div>
                                        <div class="mb-3">
                                            <h5><strong>Profesores:</strong></h5>
                                            <ul class="list-unstyled">
                                                <?php
                                                $info = AssignmentController::infoDataSubject($subject['id_subject']);
                                                if (!empty($info)) {
                                                    foreach ($info as $teacher) {
                                                        echo "<li>" . htmlspecialchars($teacher['name_teacher']) . "</li>";
                                                    }
                                                } else {
                                                    echo '<li>No asignado</li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="mb-3">
                                            <h5><strong>Correlativas:</strong></h5>
                                            <ul class="list-unstyled">
                                                <?php
                                                $infoCorrelatives = CorrelativeModel::showCorrelativeForSubject($subject['id_subject']);
                                                if (!empty($infoCorrelatives)) {
                                                    foreach ($infoCorrelatives as $correlative) {
                                                        echo "<li>" . htmlspecialchars($correlative['correlatives']) . "</li>";
                                                    }
                                                } else if ($subject['year_subject'] == "1º") {
                                                    echo '<li>Las materias de primero no pueden tener correlativas</li>';
                                                } else {
                                                    echo '<li>No se asignaron correlativas todavia</li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- Modales de editar -->
<?php if ($_SESSION['fk_rol_id'] == 1): ?>
    <?php foreach ($subjects as $subject): ?>
        <div class="modal fade cierreModal" id="modal_edit_<?php echo $subject['id_subject'] ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Materia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editsubject">
                            <input type="hidden" name="id_subject" value="<?php echo $subject['id_subject'] ?>">
                            <div class="form-group">
                                <label for="subject_name">Nombre de la Materia:</label>
                                <input type="text" class="form-control mb-3" id="subject_name" name="subject_name"
                                    value="<?php echo $subject['name_subject'] ?>" maxlength="100" required>
                                <div class="form-group">
                                    <label for="para_rendir">Año de la materia actual
                                        <?php echo $subject['year_subject'] ?></label>
                                    <select class="custom-select" name="id_year">
                                        <option value="<?php echo $subject['id_year']; ?>" selected>
                                            <?php echo $subject['year_subject']; ?></option>
                                        <?php (new SubjectController())->yearSelectSubject($subject['year_subject']); ?>
                                    </select>
                                </div>
                                <label for="detail">Carga Horaria:</label>
                                <input type="text" class="form-control" id="detail" name="detail"
                                    value="<?php echo $subject['details'] ?>" maxlength="3"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning" name="savechange">Guardar Cambios</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                            <div class="response-message text-center"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>
<!-- Modal de confirmación para eliminar materia -->
<?php if ($_SESSION['fk_rol_id'] == 1): ?>
    <?php foreach ($subjects as $subject): ?>
        <div class="modal fade cierreModal" id="confirmDeleteModal_<?php echo $subject['id_subject'] ?>" tabindex="-1"
            role="dialog" aria-labelledby="confirmDeleteModalLabel_<?php echo $subject['id_subject'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="confirmDeleteModalLabel_<?php echo $subject['id_subject'] ?>">Confirmar
                            Eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <p>¿Estás seguro de que deseas eliminar la siguiente materia?</p>
                        <h5 class="mt-4 mb-4 font-weight-bold"><?php echo $subject['name_subject'] ?></h5>
                        <p class="alert alert-danger">Esto también eliminará las correlativas asociadas a esta materia.</p>
                        <p>Esta acción no se puede deshacer.</p>
                    </div>
                    <div class="modal-footer">
                        <form method="post">
                            <input type="hidden" name="id_subject" value="<?php echo $subject['id_subject'] ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" name="deleteButton">Eliminar</button>
                        </form>
                        <div class="response-message text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>


<?php
$id_career = $_GET['id_career'];
$name_career = $_GET['name_career'];
$state = $_GET['state'];

if (isset($_POST['deleteButton'])) {
    $controller = new SubjectController();
    $controller->eliminatedSubject($id_career, $name_career, $state);
}
?>