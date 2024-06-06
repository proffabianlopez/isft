<?php $dataTeacher=TeacherController::getAllTeachers();?>
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
                    <?php foreach ($dataTeacher as $teacher): ?>
                        <tr>
                            <td class="text-center"><?php echo $teacher['name_teacher']; ?></td>
                            <td class="text-center"><?php echo $teacher['last_name_teacher']; ?></td>
                            <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageTeacher')): ?>
                            <td class="text-center">
                                <a href="#viewUserModal<?php echo $teacher['id_teacher']; ?>" class="btn btn-success view-user" data-toggle="modal" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="#confirmDeleteModal<?php echo $teacher['id_teacher']; ?>" class="btn btn-danger delete-user" data-toggle="modal" title="Eliminar (cambiar contraseña)">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a href="#editUserModal<?php echo $teacher['id_teacher']; ?>" class="btn btn-primary edit-user" data-toggle="modal" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="index.php?pages=manageTeacher&action=activar_cuenta&id_user=<?php echo $user['id_user']?>" class="btn btn-info" title="Generar cuenta Usuario (en construcción)">
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


<?php foreach ($dataTeacher as $teacher): ?>
 
    <!-- Modal eliminar usuario, 
    falta cambiar por el de cambio contraseña  -->

<!-- <div class="modal fade" id="confirmDeleteModal<?php /*echo $student['id_student'];*/ ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
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
                <p style="font-size: 16px;"><strong>Nombre:</strong> <?php /*echo $student['name_student'];*/ ?></p>
                <p style="font-size: 16px;"><strong>Apellido:</strong> <?php /*echo $student['last_name_student']; */?></p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form method="POST">
                    <input type="hidden" name="id_student" value="<?php /*echo $student['id_student'];*/ ?>">
                    <button type="submit" name="del_student" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div> -->


<!-- Modal de edición de usuario -->
<div class="modal fade" id="editUserModal<?php echo $teacher['id_teacher']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-warning">
                <h5 class="modal-title" id="editUserModalLabel"><strong>Editar profesor</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                   
                    <input type="hidden" name="id_teacher" value="<?php echo $teacher['id_teacher']; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nam" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="name_teacher" required value="<?php echo $teacher['name_teacher']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="last_name_teacher" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="last_name_teacher" value="<?php echo $teacher['last_name_teacher']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email_teacher" required value="<?php echo $teacher['email_teacher']; ?>">
                    </div>
                    <button type="submit" name="savechange" class="btn btn-warning">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de vista de usuario -->
<div class="modal fade" id="viewUserModal<?php echo $teacher['id_teacher']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-success">
                <h5 class="modal-title" id="viewUserModalLabel"><strong>Detalles del profesor</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> <?php echo $teacher['name_teacher']; ?></p>
                <p><strong>Apellido:</strong> <?php echo $teacher['last_name_teacher']; ?></p>
                <p><strong>Email:</strong> <?php echo $teacher['email_teacher']; ?></p>
                <p><strong>DNI:</strong> <?php echo $teacher['dni']; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<?php endforeach; ?>

<?php
// if (isset($_POST['del_student'])) {
//     $controller= new StudentController();
//     $controller->eliminatedStudent();
// }
?>

<?php  
if (isset($_POST['savechange'])) {
    $controller= new TeacherController();
    $controller->editTeacher();
    
}
?>