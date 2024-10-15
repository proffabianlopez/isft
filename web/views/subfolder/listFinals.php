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
            'second_final_date' => '13/10/2024'
        ]
    ]
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