<?php 
if( (isset($_GET['name_career'])) && (isset($_GET['id_career'])) && (isset($_GET['state'])) ) {  
    $subjects = SubjectController::getAllSubject($_GET['id_career']);
?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="width: 80%; margin: 0 auto;" id="example3">
                <thead> 
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
                            <td><?php echo $subject['year_subject']." ".$subject['year_detail'] ?></td>
                            <td>
                                <!-- Botón para abrir el modal -->
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_<?php echo $subject['id_subject'] ?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>  
                </tbody>                
            </table>
        </div>
    </div>
</div>

<?php }?>
<!-- Modales -->
<?php foreach ($subjects as $subject): ?>
    <div class="modal fade" id="modal_<?php echo $subject['id_subject'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles de la Materia: <?php echo $subject['name_subject'] ?></h5>
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
                                        <img class="img-fluid" src="public/img/isft177_logo_chico.png" alt="User profile picture">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h5><strong>Nombre:</strong></h5>
                                                    <p><?php echo htmlspecialchars($subject['name_subject']); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <h5><strong>Carrera:</strong></h5>
                                                    <p><?php echo htmlspecialchars($subject['career_name']); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h5><strong>Curso:</strong></h5>
                                                    <p><?php echo htmlspecialchars($subject['year_subject']) . " " . htmlspecialchars($subject['year_detail']); ?></p>
                                                </div>
                                                <div class="mb-3">
                                                    <h5><strong>Carga Horaria:</strong></h5>
                                                    <p><?php echo htmlspecialchars($subject['details']); ?></p>
                                                </div>
                                            </div>
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
