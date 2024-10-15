<?php
if ((isset($_GET['name_career'])) && (isset($_GET['id_career'])) && (isset($_GET['state']))) {
    $finals = [
        [
            'id_final' => 1,
            'name_subject' => 'Inglés',
            'name_teacher' => 'Gabriela Costela',
            'first_final_date' => '10/10/2024',
            'second_final_date' => '11/10/2024'
        ],
        [
            'id_final' => 2,
            'name_subject' => 'Matemática',
            'name_teacher' => 'Javier Pereyra',
            'first_final_date' => '12/10/2024',
            'second_final_date' => '1/11/2024'
        ]
    ];
?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 80%; margin: 0 auto;" id="example3">
                    <thead>
                        <tr class="bg-warning">
                            <th>Materia</th>
                            <th>Profesor/es</th>
                            <th>1er Fecha</th>
                            <th>2da Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($finals as $final): ?>
                            <tr>
                                <td><?php echo $final['name_subject'] ?></td>
                                <td><?php echo $final['name_teacher'] ?></td>
                                <td><?php echo $final['first_final_date'] ?></td>
                                <td><?php echo $final['second_final_date'] ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modal_edit_<?php echo $final['id_final'] ?>" title="Editar final">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>
<?php foreach ($finals as $final): ?>
    <div class="modal fade cierreModal" id="modal_edit_<?php echo $final['id_final'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Final</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editfinal">
                        <input type="hidden" name="id_final" value="<?php echo $final['id_final'] ?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="subject_name">Materia:</label>
                                    <select class="form-control mb-3" id="subject_name" name="subject_name">
                                        <option value="<?php echo $final['id_final'] ?>" selected><?php echo $final['name_subject']; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="teacher_name">Profesor:</label>
                                    <select class="form-control mb-3" id="teacher_name" name="teacher_name">
                                        <option value="<?php echo $final['id_final'] ?>" selected><?php echo $final['name_teacher']; ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date_first_final">1er Fecha:</label>
                                    <input class="form-control mb-3" type="date" name="date_first_final" id="date_first_final" value="<?php echo isset($final['first_final_date']) ? date('Y-m-d', strtotime($final['first_final_date'])) : ''; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="date_second_final">2da Fecha:</label>
                                    <input class="form-control mb-3" type="date" name="date_second_final" id="date_second_final" value="<?php echo isset($final['second_final_date']) ? date('Y-m-d', strtotime($final['second_final_date'])) : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning ladda-button" name="savechange">Guardar Cambios</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="response-message text-center"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>