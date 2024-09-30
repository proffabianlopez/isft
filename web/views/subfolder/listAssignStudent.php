<?php 
if (isset($_GET['name_career']) && isset($_GET['id_career']) && isset($_GET['state'])) {  
    $dataStudent = UserController::showStudentCareer($_GET['id_career']);
?>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered text-center" style="width: 50%; margin: 0 auto;" id="example3">
        <div class="table-responsive">
                <thead> 
                    <tr class="bg-warning">
                        <th class="align-middle">Nombre y Apellido</th>
                        <th class="align-middle">Acciones</th>
                    </tr>
                </thead>
                <tbody>                   
                    <?php foreach ($dataStudent as $data): ?>
                        <tr>
                            <td class="align-middle"><?php echo $data['full_name'] ?></td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_<?php echo $data['id_student'] ?>" title="Ver información">
                                    <i class="fas fa-eye"></i>
                                </button>
                                
                                <?php 
                                    $info = AssignmentModel::studentSubejectNoAssig($data['id_student'], $_GET['id_subject']);
                                    // Verificar si el alumno actual no tiene asignada ninguna materia con la función de arriba.
                                    if ($info) {
                                        echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_' . $data['id_student'] . '" title="Asignar alumnos a la materia">
                                                <i class="fas fa-user-plus"></i>
                                              </button>';
                                    } else {
                                        if (!$info) {
                                            echo '<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal_' . $data['id_student'] . '">
                                                    <i class="fas fa-user-alt-slash"></i> 
                                                  </button>';
                                        }elseif ($_GET['id_career']!= $info_career['id_career']){
                                            echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_' . $data['id_student'] . '" title="Asignar alumnos a la materia">
                                                <i class="fas fa-user-plus"></i>
                                              </button>';
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php } ?>

<!-- Modales -->
<?php foreach ($dataStudent as $data): ?>
    <div class="modal fade" id="modal_<?php echo $data['id_student'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles del alumno: <?php echo htmlspecialchars($data['full_name']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img class="img-fluid" src="public/img/isft177_logo_chico.png" alt="Foto de perfil del profesor">
                            </div>
                            <div class="col-md-8">
                                <h5><strong>Nombre:</strong> <?php echo htmlspecialchars($data['full_name']); ?></h5>
                                <h5><strong>Materias que cursa:</strong></h5>
                                <?php
                                    //$careers = AssignmentController::show_career_teacherSubject($data['id_student'], $_GET['id_career']); 
                                    if (!empty($careers)): ?>
                                        <ul class="list-unstyled">
                                        <?php foreach ($careers as $career): ?>
                                            <li><?php echo htmlspecialchars($career['materias']); ?></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p>No tiene materias asignadas.</p>
                                    <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>







<!-- Modales de ASIGNAR -->

<?php foreach ($dataStudent as $data): ?>
    <div class="modal fade" id="modal_edit_<?php echo $data['id_student'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal_edit_<?php echo $data['id_student'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Asignar alumno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="career" class="font-weight-bold">Carrera:</label>
                                    <p class="form-control-static"><?php echo htmlspecialchars($_GET['name_career']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="preceptor" class="font-weight-bold">Alumno:</label>
                                    <p class="form-control-static"><?php echo htmlspecialchars($data['full_name']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <input type="hidden" name="id_subject_post" value="<?php echo $_GET['id_subject'] ?>">
                        <input type="hidden" name="id_student" value="<?php echo $data['id_student'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary ladda-button" error_log("assignSubjectToTeacher: entre a assignar: " . $_POST['id_subject_post'].'-'.$_POST['id_student']); name="assignSubject">Asignar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal de confirmación para eliminar profesor -->
<?php foreach ($dataStudent as $data): ?>
    <div class="modal fade" id="confirmDeleteModal_<?php echo $data['id_student'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Quitar profesor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Estás seguro de que deseas quitar al profesor <strong><?php echo $data['full_name']; ?></strong> de la materia <?php //echo $_GET['name_subject']; ?>?</p>
                    <p class="text-center">Esta acción no se puede deshacer.</p>
                    <form method="post">
                        <input type="hidden" name="id_student" value="<?php echo $data['id_student'] ?>">
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" name="deleteStudent">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php
    $id_career_get=$_GET['id_career'];
    $career_name_get=$_GET['name_career'];
    $state_get=$_GET['state'];
    $id_subject = $_GET['id_subject'];
    $name_subject = $_GET['name_subject'];

if (isset($_POST['assignSubject'])) {
        
     $controller= new AssignmentController();
     $controller->assignSubjectToStudent($id_career_get, $career_name_get, $state_get, $id_subject, $name_subject);
   
}

if (isset($_POST['deleteStudent'])) {
    
     $controller= new AssignmentController();
     $controller->quitStudentSubject($id_career_get, $career_name_get, $state_get, $id_subject, $name_subject);

}
?>
