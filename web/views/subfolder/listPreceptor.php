<?php 
if (isset($_GET['name_career']) && isset($_GET['id_career']) && isset($_GET['state'])) {  
    $datasPreceptor = UserController::showPreceptor();
?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" style="width: 50%; margin: 0 auto;" id="example3">
                <thead> 
                    <tr class="bg-warning">
                        <th class="align-middle">Nombre y Apellido</th>
                        <th class="align-middle">Acciones</th>
                    </tr>
                </thead>
                <tbody>                   
                    <?php foreach ($datasPreceptor as $data): ?>
                        <tr>
                            <td class="align-middle"><?php echo $data['full_name'] ?></td>
                            <td class="align-middle">
                                <!-- Botón para abrir el modal de Ver preceptores -->
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_<?php echo $data['id_preceptor'] ?>" title="Ver información">
                                    <i class="fas fa-eye"></i>
                                </button>
                                
                                <?php 
                                    $info = AssignmentModel::preceptorNoAssig($data['id_preceptor']);
                                    // Verificar si el preceptor actual no tiene asignada ninguna carrera
                                    if (!empty($info)) {
                                        echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_' . $data['id_preceptor'] . '" title="Asignar preceptores a la carrera">
                                                <i class="fas fa-user-plus"></i>
                                              </button>';
                                    } else {
                                        $info_career = AssignmentModel::preceptorAssig($_GET['id_career'], $data['id_preceptor']);
                                        if (!empty($info_career)) {
                                            echo '<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal_' . $data['id_preceptor'] . '">
                                                    <i class="fas fa-user-alt-slash"></i> 
                                                  </button>';
                                        }elseif ($_GET['id_career']!= $info_career['id_career']){
                                            echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_' . $data['id_preceptor'] . '" title="Asignar preceptores a la carrera">
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
<?php foreach ($datasPreceptor as $data): ?>
    <div class="modal fade" id="modal_<?php echo $data['id_preceptor'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles del Preceptor: <?php echo htmlspecialchars($data['full_name']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img class="img-fluid" src="public/img/isft177_logo_chico.png" alt="Foto de perfil del preceptor">
                            </div>
                            <div class="col-md-8">
                                <h5><strong>Nombre:</strong> <?php echo htmlspecialchars($data['full_name']); ?></h5>
                                <h5><strong>Carreras a cargo:</strong></h5>
                                <?php
                                    $careers = AssignmentController::show_career_preceptor($data['id_preceptor']); 
                                    if (!empty($careers)): ?>
                                        <ul class="list-unstyled">
                                        <?php foreach ($careers as $career): ?>
                                            <li><?php echo htmlspecialchars($career['career']); ?></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p>No tiene carreras asignadas.</p>
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

<?php foreach ($datasPreceptor as $data): ?>
    <div class="modal fade" id="modal_edit_<?php echo $data['id_preceptor'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal_edit_<?php echo $data['id_preceptor'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Asignar Preceptor</h5>
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
                                    <label for="preceptor" class="font-weight-bold">Preceptor:</label>
                                    <p class="form-control-static"><?php echo htmlspecialchars($data['full_name']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <input type="hidden" name="id_career_post" value="<?php echo $_GET['id_career'] ?>">
                        <input type="hidden" name="id_preceptor" value="<?php echo $data['id_preceptor'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" name="assignCareer">Asignar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal de confirmación para eliminar preceptor -->
<?php foreach ($datasPreceptor as $data): ?>
    <div class="modal fade" id="confirmDeleteModal_<?php echo $data['id_preceptor'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Quitar Preceptor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Estás seguro de que deseas quitar al preceptor <strong><?php echo $data['full_name']; ?></strong> de la carrera <?php echo $_GET['name_career']; ?>?</p>
                    <p class="text-center">Esta acción no se puede deshacer.</p>
                    <form method="post">
                        <?php 
                        // Obtener la información de la asignación
                        $inf = AssignmentModel::captureId_Career_Person($data['id_preceptor'],$_GET['id_career']);
                        
                       ?>
                        <input type="hidden" name="id_preceptor" value="<?php echo $inf['career_person']; ?>">
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" name="deletePreceptor">Eliminar</button>
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



if (isset($_POST['assignCareer'])) {
        
    $controller= new AssignmentController();
    $controller->assignPreceptor($id_career_get,$career_name_get,$state_get);
   
}

// Lógica para eliminar preceptor
if (isset($_POST['deletePreceptor'])) {
    
    $controller= new AssignmentController();
    $controller->quitPreceptor($id_career_get,$career_name_get,$state_get);

}
?>
