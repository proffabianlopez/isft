<?php $dataUser=UserController::getAllUser();?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover">
                <thead class="bg-yellow text-white"> 
                    <tr>            
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php foreach ($dataUser as $user): ?>
                        <tr class="<?php echo ($user['state'] == 1) ? 'bg-white' : 'bg-light'; ?>">
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['last_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['name_rol']; ?></td>
                            <td><?php echo $user['state'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                            <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageUser')): ?>
                            <td>
                                <a href="#confirmDeleteModal<?php echo $user['id_user']; ?>" class="btn btn-danger delete-user" data-toggle="modal">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a href="#editUserModal<?php echo $user['id_user']; ?>" class="btn btn-primary edit-user" data-toggle="modal">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <?php if ($user['state'] == 1): ?>
                                    <a href="index.php?pages=manageUser&action=deshabilitar_cuenta&id_user=<?php echo $user['id_user']?>" class="btn btn-success" title="Deshabilitar cuenta"><i class="fas fa-toggle-on"></i></a>
                                <?php else: ?>
                                    <a href="index.php?pages=manageUser&action=habilitar_cuenta&id_user=<?php echo $user['id_user']?>" class="btn btn-danger" title="Habilitar cuenta"><i class="fas fa-toggle-off"></i></a>
                                <?php endif; ?>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>
<?php if(isset($_GET['action'])){
    if($_GET['action']=="deshabilitar_cuenta"){
      $controller=new UserController();
      $controller->disableAccountUser();
    }else{
        $controller=new UserController();
        $controller->enableAccountUser();
    }
}?>
<?php foreach ($dataUser as $user): ?>
 
    <!-- Modal eliminar usuario -->
<div class="modal fade" id="confirmDeleteModal<?php echo $user['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h5 class="modal-title" id="confirmDeleteModalLabel"><strong>Confirmar eliminación</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-size: 18px;">¿Estás seguro de que deseas eliminar este usuario?</p>
                <p style="font-size: 16px;"><strong>Nombre:</strong> <?php echo $user['name']; ?></p>
                <p style="font-size: 16px;"><strong>Apellido:</strong> <?php echo $user['last_name']; ?></p>
                
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