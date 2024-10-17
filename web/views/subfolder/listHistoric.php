<?php
$dataStudent = CourseController::getCourseDataStudentSubject($_GET['id_subject']);
?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover custom-table-container" style="width: 80%; margin: 0 auto;">
                <thead class="bg-yellow text-white">
                    <tr class="text-center">
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataStudent as $student) : ?>
                        <tr>
                            <td class="text-center"><?php echo $student['last_name_student']; ?></td>
                            <td class="text-center"><?php echo $student['name_student']; ?></td>
                            <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageCourse')) : ?>
                                <td class="text-center">
                                    <a href="#viewStudentModal<?php echo $student['id_student']; ?>" class="btn btn-success view-student" data-toggle="modal" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
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

<?php foreach ($dataStudent as $student) : ?>
    <!-- Modal de vista de usuario -->
    <div class="modal fade" id="viewStudentModal<?php echo $student['id_student']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-success">
                    <h5 class="modal-title" id="viewStudentModalLabel"><strong>Notas del estudiante</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>
                        <strong>Este alumno curso esta materia en el año:</strong> <?php echo $student['ciclo_lectivo'] ?>
                    </h5>
                    <br>
                    <p><strong>Parcial 1:</strong>
                        <span class="<?php echo ($student['nota1'] === null) ? 'text-dark' : (($student['nota1'] < 4) ? 'text-danger' : (($student['nota1'] == 10) ? 'text-success' : '')); ?>">
                            <?php echo ($student['nota1'] === null) ? 'Nota no asignada' : $student['nota1'] . ' (' . CourseController::numeroATexto($student['nota1']) . ')'; ?>
                        </span>
                    </p>
                    <?php if ($student['nota1'] < 4 && $student['nota1'] !== null): ?>
                        <p><strong>Recuperatorio 1:</strong>
                            <span class="<?php echo ($student['recuperatorio1'] === null) ? 'text-dark' : (($student['recuperatorio1'] < 4) ? 'text-danger' : (($student['recuperatorio1'] == 10) ? 'text-success' : '')); ?>">
                                <?php echo ($student['recuperatorio1'] === null) ? 'Nota no asignada' : $student['recuperatorio1'] . ' (' . CourseController::numeroATexto($student['recuperatorio1']) . ')'; ?>
                            </span>
                        </p>
                    <?php endif; ?>

                    <p><strong>Parcial 2:</strong>
                        <span class="<?php echo ($student['nota2'] === null) ? 'text-dark' : (($student['nota2'] < 4) ? 'text-danger' : (($student['nota2'] == 10) ? 'text-success' : '')); ?>">
                            <?php echo ($student['nota2'] === null) ? 'Nota no asignada' : $student['nota2'] . ' (' . CourseController::numeroATexto($student['nota2']) . ')'; ?>
                        </span>
                    </p>
                    <?php if ($student['nota2'] < 4 && $student['nota2'] !== null): ?>
                        <p><strong>Recuperatorio 2:</strong>
                            <span class="<?php echo ($student['recuperatorio2'] === null) ? 'text-dark' : (($student['recuperatorio2'] < 4) ? 'text-danger' : (($student['recuperatorio2'] == 10) ? 'text-success' : '')); ?>">
                                <?php echo ($student['recuperatorio2'] === null) ? 'Nota no asignada' : $student['recuperatorio2'] . ' (' . CourseController::numeroATexto($student['recuperatorio2']) . ')'; ?>
                            </span>
                        </p>
                    <?php endif; ?>

                    <!-- Condición para mostrar mensaje "Deberá rendir integrador" -->
                    <?php
                    $debeIntegrador = false;
                    if (($student['recuperatorio1'] !== null && $student['recuperatorio1'] < 4) ||
                        ($student['recuperatorio2'] !== null && $student['recuperatorio2'] < 4)
                    ) {
                        $debeIntegrador = true;
                    }
                    ?>

                    <?php if ($debeIntegrador): ?>
                        <div class="alert alert-warning mt-3">
                            <strong>Deberá rendir integrador.</strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>