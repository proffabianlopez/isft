<?php $dataUser = UserController::getAllUser(); ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover" style="width: 80%; margin: 0 auto;">
                <thead class="bg-yellow text-white">
                    <tr>
                        <th class="text-center">Apellido</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Rol</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataUser as $user) : ?>
                        <?php if ($_SESSION['id_user'] != $user['id_user']) : ?>
                            <tr class="<?php echo ($user['state'] == 1) ? 'bg-white' : 'bg-light'; ?>">
                                <td class="text-center"><?php echo $user['last_name']; ?></td>
                                <td class="text-center"><?php echo $user['name']; ?></td>
                                <td class="text-center"><?php echo $user['email']; ?></td>
                                <td class="text-center"><?php echo $user['name_rol']; ?></td>
                                <td class="text-center"><?php echo $user['state'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                                <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageUser')) : ?>
                                    <td class="text-center">
                                        <a href="#editUserModal<?php echo $user['id_user']; ?>" class="btn btn-primary edit-user" data-toggle="modal">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if ($user['state'] == 1) : ?>
                                            <a href="index.php?pages=manageUser&action=deshabilitar_cuenta&id_user=<?php echo $user['id_user'] ?>" class="btn btn-success" title="Deshabilitar cuenta"><i class="fas fa-toggle-on"></i></a>
                                        <?php else : ?>
                                            <a href="index.php?pages=manageUser&action=habilitar_cuenta&id_user=<?php echo $user['id_user'] ?>" class="btn btn-danger" title="Habilitar cuenta"><i class="fas fa-toggle-off"></i></a>
                                        <?php endif; ?>
                                        <a href="#" class="btn btn-warning" onclick="generatePassword(<?php echo $user['id_user'] ?>)" title="Generar nueva contraseña"><i class="fas fa-key"></i></a>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php if (isset($_GET['action'])) {
    if ($_GET['action'] == "deshabilitar_cuenta") {
        $controller = new UserController();
        $controller->disableAccountUser();
    }

    if ($_GET['action'] == "habilitar_cuenta") {
        $controller = new UserController();
        $controller->enableAccountUser();
    }

    if ($_GET['action'] == "generar_password") {
        $controller = new UserController();
        $controller->sendNewAleatoryPasswordEmail();
    }
} ?>
<?php foreach ($dataUser as $user) : ?>

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
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="last_name" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="last_name" value="<?php echo $user['last_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nam" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="name" required value="<?php echo $user['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="roles">Rol</label>
                            <select class="form-control" id="roles" name="roles" required>
                                <option value="<?php echo $user['fk_rol_id'] ?>"><?php echo $user["name_rol"] ?></option>
                                <?php (new RolesController())->allRolesSelect(); ?>
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
    $controller = new UserController();
    $controller->eliminatedUser();
}
?>

<?php if (isset($_POST['savechange'])) {
    $controller = new UserController();
    $controller->editarUser();
}
?>