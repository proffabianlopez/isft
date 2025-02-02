<?php if ($_SESSION['fk_rol_id'] == 1): ?>
    <?php $dataStudent = StudentController::getAllStudent(); ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive overflow-hidden">
                <form id="studentForm" method="POST">
                    <input type="hidden" name="student_ids" id="student_ids" value="">
                    <table id="example3" class="table table-bordered table-striped table-hover table-sm custom-table-container" style="width: 90%;">
                        <thead class="bg-yellow text-white">
                            <tr class="text-center">
                                <th></th>
                                <th>Apellido</th>
                                <th>Nombre</th>
                                <th>Dni</th>
                                <th>Cohorte</th>
                                <th>Legajo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataStudent as $student) : ?>
                                <tr>
                                <?php if ($student['startingYear'] == date('Y')): ?>
                                    <td class="text-center">
                                        <input type="checkbox" name="student_id[]" value="<?php echo $student['id_student']; ?>">
                                    </td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
                                    <td class="text-center"><?php echo $student['last_name_student']; ?></td>
                                    <td class="text-center"><?php echo $student['name_student']; ?></td>
                                    <td class="text-center"><?php echo $student['dni']; ?></td>
                                    <td class="text-center"><?php echo $student['startingYear']; ?></td>

                                    <td class="text-center">
                                        <?php if ($student['legajo'] == null) : ?>
                                            <a href="#assignFileModal<?php echo $student['id_student']; ?>" class="btn btn-secondary assign-file" data-toggle="modal" title="Asignar legajo">
                                                <i class="fas fa-file-medical"></i>
                                            </a>
                                        <?php else : ?>
                                            <?php echo $student['legajo']; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageStudent')) : ?>
                                            <a href="#viewUserModal<?php echo $student['id_student']; ?>" class="btn btn-success view-user" data-toggle="modal" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#editUserModal<?php echo $student['id_student']; ?>" class="btn btn-primary edit-user" data-toggle="modal" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-info" onclick="generateUser(<?php echo $student['id_student'] ?>)" title="Generar nuevo usuario">
                                                <i class="fas fa-user-plus"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php $message = new MessageController();
                            $message->show_messages_error('legajo', "No se permiten Legajos Duplicados"); ?>
                            <?php $message->showMessageVerify('message', "se asignaron correctamente las materias"); ?> 
                            <?php $message-> show_messages_error('no',"Error a cargar las materias.uno o mas alumnos ya las tienen cargada"); ?> 
                            <?php $message->show_messages_error('id', "no se seleccionaron estudiantes para cargar materia"); ?>  
                        </tbody>
                    </table>
                    <button id="send-btn" name="send_btn" class="btn btn-primary">Cargar materias primer año</button>
                </form>
            </div>
        </div>
    </div>


    <?php foreach ($dataStudent as $student) : ?>

        <div id="assignFileModal<?php echo $student['id_student']; ?>" class="modal fade cierreModal" tabindex="-1" role="dialog" aria-labelledby="assignFileModalLabel<?php echo $student['id_student']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-custom text-black ">
                        <h5 class="modal-title" id="assignFileModalLabel<?php echo $student['id_student']; ?>">Asignar Legajo a <?php echo $student['name_student']; ?></h5>
                        <button type="button" class="close text-black" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="assignlegajo">
                            <input type="hidden" name="student_id" value="<?php echo $student['id_student']; ?>">
                            <input type="hidden" name="career_id" value="<?php echo $student['id_career']; ?>">
                            <div class="form-group">
                                <label for="fileInput<?php echo $student['id_student']; ?>">Ingrese el número de legajo del estudiante</label>
                                <input type="number" class="form-control" name="file" maxlength="4" max="9999" min="0" required placeholder="ingrese numero de legajo">
                                <small class="form-text text-muted">El número de legajo debe ser un número de 4 dígitos.</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-warning ladda-button" name="save">Guardar</button>
                            </div>
                            <div class="response-message text-center"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <!-- Modal de edición de usuario -->
        <div class="modal fade cierreModal" id="editUserModal<?php echo $student['id_student']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header alert alert-warning">
                        <h5 class="modal-title" id="editUserModalLabel"><strong>Editar alumno</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editstudent">
                            <input type="hidden" name="id_student" value="<?php echo $student['id_student']; ?>">
                            <input type="hidden" name="id_career_person" value="<?php echo $student['id_career_person']; ?>">
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" maxlength="50" class="form-control" id="last_name_student" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="last_name_student" value="<?php echo $student['last_name_student']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" maxlength="50" class="form-control" id="nam" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="name_student" required value="<?php echo $student['name_student']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="text" maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="dni" value="<?php echo $student['dni']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tel">Teléfono (Opcional)</label>
                                <input type="text" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="tel" placeholder="Formato 11 12345678" value="<?php echo $student['phone_contact']; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="roles">Carrera</label>
                                <select class="form-control" id="carrer" name="carrer" required>
                                    <?php (new CareerController())->careerSelect($student['id_career']); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cohorte">Cohorte</label>
                                <input type="text" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="date" value="<?php echo $student['startingYear']; ?>" required>
                            </div>
                            <button type="submit" name="savechange" class="btn btn-warning ladda-button">Guardar cambios</button>
                            <div class="response-message text-center"></div>
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
                        <h5 class="modal-title" id="viewUserModalLabel"><strong>Detalles del alumno</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Apellido:</strong> <?php echo $student['last_name_student']; ?></p>
                        <p><strong>Nombre:</strong> <?php echo $student['name_student']; ?></p>
                        <p><strong>DNI:</strong> <?php echo $student['dni']; ?></p>
                        <p><strong>Teléfono:</strong> <?php echo $student['phone_contact']; ?></p>
                        <p><strong>Email:</strong> <?php echo $student['email_student']; ?></p>
                        <p><strong>Numero de legajo:</strong> <?php echo $student['legajo']; ?></p>
                        <p><strong>Carrera:</strong> <?php echo $student['career_name']; ?></p>
                        <p><strong>Cohorte:</strong> <?php echo $student['startingYear']; ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>



    <?php

    if (isset($_GET['action'])) {
        if ($_GET['action'] == "activar_cuenta") {
            $controller = new StudentController();
            $controller->generateAccountStudent();
        }
    }


    if (isset($_POST['send_btn'])) {
        
        $controller = new StudentController();
        $controller->subjectFirstYearStudent();

}


    ?>
<? endif ?>

<!--vista preceptor-->
<?php if ($_SESSION['fk_rol_id'] == 2): ?>
    <?php $dataStudent = StudentController::getStudentCareerPreceptor($_SESSION['id_user']); ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive overflow-hidden">
                <form id="studentForm" method="POST">
                    <input type="hidden" name="student_ids" id="student_ids" value="">
                    <table id="example3" class="table table-bordered table-striped table-hover table-sm custom-table-container" style="width: 90%;">
                        <thead class="bg-yellow text-white">
                            <tr class="text-center">
                                <th></th>
                                <th>Apellido</th>
                                <th>Nombre</th>
                                <th>Dni</th>
                                <th>Cohorte</th>
                                <th>Legajo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataStudent as $student) : ?>
                                <tr>
                                <?php if ($student['startingYear'] == date('Y')): ?>
                                    <td class="text-center">
                                        <input type="checkbox" name="student_id[]" value="<?php echo $student['id_student']; ?>">
                                    </td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
                                    <td class="text-center"><?php echo $student['last_name_student']; ?></td>
                                    <td class="text-center"><?php echo $student['name_student']; ?></td>
                                    <td class="text-center"><?php echo $student['dni']; ?></td>
                                    <td class="text-center"><?php echo $student['startingYear']; ?></td>

                                    <td class="text-center">
                                        <?php if ($student['legajo'] == null) : ?>
                                            <a href="#assignFileModal<?php echo $student['id_student']; ?>" class="btn btn-secondary assign-file" data-toggle="modal" title="Asignar legajo">
                                                <i class="fas fa-file-medical"></i>
                                            </a>
                                        <?php else : ?>
                                            <?php echo $student['legajo']; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageStudent')) : ?>
                                            <a href="#viewUserModal<?php echo $student['id_student']; ?>" class="btn btn-success view-user" data-toggle="modal" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#editUserModal<?php echo $student['id_student']; ?>" class="btn btn-primary edit-user" data-toggle="modal" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if (1 == null){?>

                                            <a href="#" class="btn btn-info" onclick="generateUser(<?php echo $student['id_student'] ?>)" title="Generar nuevo usuario">
                                            <i class="fas fa-user-plus"></i>
                                            </a>
                                            <?php }?>
                                         
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php $message = new MessageController();
                            $message->show_messages_error('legajo', "No se permiten Legajos Duplicados"); ?>
                            <?php $message->showMessageVerify('message', "se asignaron correctamente las materias"); ?> 
                            <?php $message-> show_messages_error('no',"Error a cargar las materias.uno o mas alumnos ya las tienen cargada"); ?> 
                            <?php $message->show_messages_error('id', "no se seleccionaron estudiantes para cargar materia"); ?>  
                        </tbody>
                    </table>
                    <button id="send-btn" name="send_btn" class="btn btn-primary ladda-button">Cargar materias primer año</button>
                </form>
            </div>
        </div>
    </div>



    <?php foreach ($dataStudent as $student) : ?>



        <!-- modal de asignar legajo -->
        <div id="assignFileModal<?php echo $student['id_student']; ?>" class="modal fade cierreModal" tabindex="-1" role="dialog" aria-labelledby="assignFileModalLabel<?php echo $student['id_student']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-custom text-black ">
                        <h5 class="modal-title" id="assignFileModalLabel<?php echo $student['id_student']; ?>">Asignar Legajo a <?php echo $student['name_student']; ?></h5>
                        <button type="button" class="close text-black" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="assignlegajo">
                            <input type="hidden" name="student_id" value="<?php echo $student['id_student']; ?>">
                            <input type="hidden" name="career_id" value="<?php echo $student['id_career']; ?>">
                            <div class="form-group">
                                <label for="fileInput<?php echo $student['id_student']; ?>">Ingrese el número de legajo del estudiante</label>
                                <input type="number" class="form-control" name="file" maxlength="4" max="9999" min="0" required placeholder="ingrese numero de legajo">
                                <small class="form-text text-muted">El número de legajo debe ser un número de 4 dígitos.</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary resetMessage" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-warning ladda-button" name="save">Guardar</button>
                            </div>
                            <div class="response-message text-center"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <!-- Modal de edición de usuario -->
        <div class="modal fade cierreModal" id="editUserModal<?php echo $student['id_student']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header alert alert-warning">
                        <h5 class="modal-title" id="editUserModalLabel"><strong>Editar alumno</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editstudent">
                            <input type="hidden" name="id_student" value="<?php echo $student['id_student']; ?>">
                            <input type="hidden" name="id_career_person" value="<?php echo $student['id_career_person']; ?>">
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="last_name_student" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="last_name_student" value="<?php echo $student['last_name_student']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nam" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="name_student" required value="<?php echo $student['name_student']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="text" maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="dni" value="<?php echo $student['dni']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tel">Teléfono (Opcional)</label>
                                <input type="text" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="tel" placeholder="Formato 11 12345678" value="<?php echo $student['phone_contact']; ?>" >
                            </div>
                            <!-- HAY QUE SEPARAR LA PRIMERA PARTE DEL LEGAJO (AC, AS, etc) Y TRAER SOLO LOS ÚLTIMOS 4 NÚMEROS PARA QUE
                    TE TOME EL VALUE, Y MODIFICAR LA CONSULTA DE LA BASE DE DATOS DE ACUERDO A ESE NÚMERO.
                    <div class="form-group">
                        <label for="fileNumber">Legajo</label>
                        <input type="number" class="form-control" name="file" maxlength="4" max="9999" min="0" value=" echo $student['legajo']; ?>" required>
                    </div> -->

                            <div class="form-group">
                                <label for="carrer">Carrera</label>
                                <select class="form-control" id="carrer" name="carrer" required>
                                    <?php
                                    $selectedCareer = isset($_POST['carrer']) ? htmlspecialchars($_POST['carrer']) : '';
                                    (new CareerController())->careerSelectPreceptor($_SESSION['id_user'], $selectedCareer);
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cohorte">Cohorte</label>
                                <input type="text" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="date" value="<?php echo $student['startingYear']; ?>" required>
                            </div>
                            <button type="submit" name="savechange" class="btn btn-warning ladda-button">Guardar cambios</button>
                            <div class="response-message text-center"></div>
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
                        <h5 class="modal-title" id="viewUserModalLabel"><strong>Detalles del alumno</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Apellido:</strong> <?php echo $student['last_name_student']; ?></p>
                        <p><strong>Nombre:</strong> <?php echo $student['name_student']; ?></p>
                        <p><strong>Email:</strong> <?php echo $student['email_student']; ?></p>
                        <p><strong>DNI:</strong> <?php echo $student['dni']; ?></p>
                        <p><strong>Telefono:</strong> <?php echo $student['phone_contact']; ?></p>
                        <p><strong>Numero de legajo:</strong> <?php echo $student['legajo']; ?></p>
                        <p><strong>Carrera:</strong> <?php echo $student['career_name']; ?></p>
                        <p><strong>Cohorte:</strong> <?php echo $student['startingYear']; ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>



    <?php



    if (isset($_GET['action'])) {
        if ($_GET['action'] == "activar_cuenta") {
            $controller = new StudentController();
            $controller->generateAccountStudent();
        }
    }

     if (isset($_POST['send_btn'])) {
        
                    $controller = new StudentController();
                    $controller->subjectFirstYearStudent();

          }


    ?>
<?php endif ?>