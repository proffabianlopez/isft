<?php 
if (isset($_GET['name_career']) && isset($_GET['id_career']) && isset($_GET['state'])) {  
    $datasPreceptor = UserController::showPreceptor();
?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="width: 80%; margin: 0 auto;" id="example3">
                <thead> 
                    <tr class="bg-warning">
                        <th>Nombre y Apellido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>                   
                    <?php foreach ($datasPreceptor as $data): ?>
                        <tr>
                            <td><?php echo $data['full_name'] ?></td>
                            <td>
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
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles del Preceptor: <?php echo $data['full_name'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del modal -->
                    <section class="container py-3">
                        <div class="card">
                            <div class="card-body">
                                <!-- Detalles específicos del preceptor -->
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <img class="img-fluid" src="public/img/isft177_logo_chico.png" alt="Foto de perfil del preceptor">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <h5><strong>Nombre:</strong></h5>
                                            <p><?php echo htmlspecialchars($data['full_name']); ?></p>
                                        </div>
                                        <!-- Otros detalles si es necesario -->
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

<!-- Modales de ASIGNAR -->

<?php foreach ($datasPreceptor as $data): ?>
    <div class="modal fade" id="modal_edit_<?php echo $data['id_preceptor'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Asignar Preceptor a Carrera</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario o contenido del modal para asignar preceptor a carrera -->
                    <form method="post">
                        <input type="hidden" name="id_preceptor" value="<?php echo $data['id_preceptor'] ?>">
                        <div class="form-group">
                            <label for="career_name"><?php echo $data['full_name']?></label>
                            
                        </div>
                        <div class="form-group">
                            <label for="career_name">Carrera:</label>
                            <input type="hidden" name="id_career" value="<?php echo $_GET['id_career']; ?>">
                            <input type="text" class="form-control" id="career_name" name="career_name" value="<?php echo htmlspecialchars($_GET['name_career']); ?>" readonly>    
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="assignCareer">Asignar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal de confirmación para eliminar preceptor -->
<?php foreach ($datasPreceptor as $data): ?>
    <div class="modal fade" id="confirmDeleteModal_<?php echo $data['id_preceptor'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Estás seguro de que deseas eliminar al preceptor <?php echo $data['full_name']; ?>?</p>
                    <p class="text-center">Esta acción no se puede deshacer.</p>
                    <form method="post">
                        <input type="hidden" name="id_preceptor" value="<?php echo $data['id_preceptor']; ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" name="deletePreceptor">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?php
// Lógica para guardar cambios al asignar carrera
if (isset($_POST['assignCareer'])) {
    $id_preceptor = $_POST['id_preceptor'];
    // Lógica para asignar el preceptor a la carrera
}

// Lógica para eliminar preceptor
if (isset($_POST['deletePreceptor'])) {
    $id_preceptor = $_POST['id_preceptor'];
    // Lógica para eliminar al preceptor
}
?>
