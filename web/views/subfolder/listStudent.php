<?php $dataStudent=StudentController::getAllStudent();?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover">
                <thead class="bg-yellow text-white"> 
                    <tr>            
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php foreach ($dataStudent as $student): ?>
                        <tr>
                            <td><?php echo $student['name_student']; ?></td>
                            <td><?php echo $student['last_name_student']; ?></td>
                            <td><?php echo $student['email_student']; ?></td>
                            <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageStudent')): ?>
                            <td>
                                <a href="#confirmDeleteModal<?php echo $student['id_student']; ?>" class="btn btn-danger delete-user" data-toggle="modal">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a href="#editUserModal<?php echo $student['id_student']; ?>" class="btn btn-primary edit-user" data-toggle="modal">
                                    <i class="fas fa-edit"></i>
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
                    <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                    <button type="submit" name="del_user" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal de edición de usuario -->
<div class="modal fade" id="editUserModal<?php echo $user['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
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
                   
                    <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nam" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="name" required value="<?php echo $user['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="last_name" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="last_name" value="<?php echo $user['last_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?php echo $user['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="roles">Rol</label>
                        <select class="form-control" id="roles" name="roles" required>
                            <?php (new RolesController())->rolesSelect(); ?>
                        </select>
                    </div>
                    <button type="submit" name="savechange" class="btn btn-warning">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php endforeach; ?>

<?php
if (isset($_POST['del_user'])) {
    $controller= new UserController();
    $controller->eliminatedUser();
}
?>

<?php  if (isset($_POST['savechange'])) {
    $controller= new UserController();
    $controller->editarUser();
}
?>