<?php 
if (isset($_GET['id_teacher']) && isset($_GET['name_teacher'])) {
    $careers = CareerModel::showCareer(); // Asumiendo que esto devuelve un array de carreras

    // Abre la sección HTML
    ?>
    <section class="container-fluid py-3">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Asignar Carrera al Profesor: <?php echo $_GET['name_teacher']; ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped" style="width: 80%; margin: 0 auto;">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>Carrera</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($careers as $career): ?>
                                        <tr>
                                            <td><?php echo $career['career_name']; ?></td>
                                            <?php 
                                            $info = AssignmentModel::teacherNoAssig($_GET['id_teacher'], $career['id_career']);
                                            if (!empty($info)): ?>
                                                <td>
                                                    <span class="badge badge-danger">No asignado</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_asignar_<?php echo $career['id_career']; ?>" title="Asignar a la carrera">
                                                        <i class="fas fa-user-plus"></i>
                                                    </button>
                                                </td>
                                            <?php else:
                                                $info_career = AssignmentModel::teacherAssig($_GET['id_teacher'], $career['id_career']);
                                                if (!empty($info_career)): ?>
                                                    <td>
                                                        <span class="badge badge-success">Asignado</span>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_edit_quitar_<?php echo $career['id_career']; ?>" title="Quitar de la carrera">
                                                            <i class="fas fa-user-alt-slash"></i>
                                                        </button>
                                                    </td>
                                                <?php else: ?>
                                                    <td>
                                                        <span class="badge badge-danger">No asignado</span>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_asignar_<?php echo $career['id_career']; ?>" title="Agregar a la carrera">
                                                            <i class="fas fa-user-plus"></i>
                                                        </button>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php 
}
?>

<?php foreach($careers as $career): ?>
    <!-- Modal para Asignar a la Carrera -->
    <div class="modal fade" id="modal_edit_asignar_<?php echo $career['id_career']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal_edit_asignar_<?php echo $career['id_career']; ?>_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Asignar a Carrera: <?php echo $career['career_name']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <p>¿Está seguro que desea asignar al profesor a esta carrera?</p>
                        <input type="hidden" name="career_id" value="<?php echo $career['id_career']; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="confirm">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Quitar de la Carrera -->
    <div class="modal fade" id="modal_edit_quitar_<?php echo $career['id_career']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal_edit_quitar_<?php echo $career['id_career']; ?>_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Quitar Profesor de Carrera: <?php echo $career['career_name']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <?php 
                    // Obtener la información de la asignación
                    $inf = AssignmentModel::captureId_Career_Person($_GET['id_teacher'],$career['id_career']);
                    ?>

                    <div class="modal-body">
                        <p style="color: red;">¿Está seguro que desea eliminar al profesor de esta carrera? Esta acción no se puede deshacer.</p>
                        <input type="hidden" name="id_career_teacher" value="<?php echo $inf['career_person']; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" name="delete_teacher">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php 
// Lógica para manejar la asignación o eliminación del profesor
if(isset($_POST['confirm'])){
    $controller = new AssignmentController();
    $controller->assignTeacher($_GET['id_teacher'], $_GET['name_teacher']);
}

if(isset($_POST['delete_teacher'])){
    $controller = new AssignmentController();
    $controller->quitProfesor($_GET['id_teacher'], $_GET['name_teacher']);
}
?>
