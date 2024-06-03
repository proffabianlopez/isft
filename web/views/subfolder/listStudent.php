<?php $dataStudent=StudentController::getAllStudent();?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover custom-table-container" style="width: 80%; margin: 0 auto;">
                <thead class="bg-yellow text-white"> 
                    <tr class="text-center">            
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php foreach ($dataStudent as $student): ?>
                        <tr>
                            <td class="text-center"><?php echo $student['name_student']; ?></td>
                            <td class="text-center"><?php echo $student['last_name_student']; ?></td>
                            <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageStudent')): ?>
                            <td class="text-center">
                                <a href="#viewUserModal<?php echo $student['id_student']; ?>" class="btn btn-success view-user" data-toggle="modal" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="#confirmDeleteModal<?php echo $student['id_student']; ?>" class="btn btn-danger delete-user" data-toggle="modal" title="eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a href="#editUserModal<?php echo $student['id_student']; ?>" class="btn btn-primary edit-user" data-toggle="modal" title="editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="index.php?pages=manageStudent&action=activar_cuenta&id_user=<?php echo $user['id_user']?>" class="btn btn-info" title="Generar Cuenta Usuario">
                                    <i class="fas fa-user-plus"></i>
                                </a>
                                
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>


<?php foreach ($dataStudent as $student): ?>
 
    <!-- Modal eliminar usuario -->
<div class="modal fade" id="confirmDeleteModal<?php echo $student['id_student']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h5 class="modal-title" id="confirmDeleteModalLabel"><strong>Confirmar eliminación</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 18px;">¿Estás seguro de que deseas eliminar este Alumno?</p>
                <p style="font-size: 16px;"><strong>Nombre:</strong> <?php echo $student['name_student']; ?></p>
                <p style="font-size: 16px;"><strong>Apellido:</strong> <?php echo $student['last_name_student']; ?></p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form method="POST">
                    <input type="hidden" name="id_student" value="<?php echo $student['id_student']; ?>">
                    <button type="submit" name="del_student" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal de edición de usuario -->
<div class="modal fade" id="editUserModal<?php echo $student['id_student']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-warning">
                <h5 class="modal-title" id="editUserModalLabel"><strong>Editar usuario</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                   
                    <input type="hidden" name="id_student" value="<?php echo $student['id_student']; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nam" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="name_student" required value="<?php echo $student['name_student']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="last_name_student" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="last_name_student" value="<?php echo $student['last_name_student']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email_student" required value="<?php echo $student['email_student']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="roles">Carreraw</label>
                        <select class="form-control" id="carrer" name="carrer" required>
                            <?php (new CarrerController())->carrerSelect();?>
                        </select>
                    </div>
                    <button type="submit" name="savechange" class="btn btn-warning">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de vista de usuario -->
<div class="modal fade" id="viewUserModal<?php echo $student['id_student']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-success">
                <h5 class="modal-title" id="viewUserModalLabel"><strong>Detalles del estudiante</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> <?php echo $student['name_student']; ?></p>
                <p><strong>Apellido:</strong> <?php echo $student['last_name_student']; ?></p>
                <p><strong>Email:</strong> <?php echo $student['email_student']; ?></p>
                <p><strong>DNI:</strong> <?php echo $student['dni']; ?></p>
                <p><strong>Carrera:</strong> <?php echo $student['carrer_name']; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<?php endforeach; ?>

<?php
if (isset($_POST['del_student'])) {
    $controller= new StudentController();
    $controller->eliminatedStudent();
}
?>

<?php  
if (isset($_POST['savechange'])) {
    $controller= new StudentController();
    $controller->editStudent();
    
}
?>