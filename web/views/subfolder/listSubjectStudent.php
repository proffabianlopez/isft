<?php
if (isset($_GET['name_career']) && isset($_GET['id_career']) && isset($_GET['state'])) {
    $dataStudent = AssignmentController::showStudentSubejct($_GET['id_subject']);
    ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 50%; margin: 0 auto;" id="example3">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <form method="post" class="d-inline-block">
                                    <button type="submit" name="studentSubject_excel" class="btn btn-success"
                                        title="Descargar Excel de correlativas">
                                        <i class="far fa-file-excel mr-1"></i> Descargar Excel
                                    </button>

                                </form>
                            </th>
                        </tr>
                        <tr class="bg-warning">
                            <th class="align-middle">Nombre</th>
                            <th class="align-middle">Apellido</th>
                            <th class="align-middle">DNI</th>
                            <th class="align-middle">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataStudent as $data): ?>
                            <tr>
                                <td class="align-middle"><?php echo $data['name'] ?></td>
                                <td class="align-middle"><?php echo $data['last_name'] ?></td>
                                <td class="align-middle"><?php echo $data['dni'] ?></td>
                                <td class="align-middle"><?php echo $data['email'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } 
if (isset($_POST['studentSubject_excel'])) {
    (new ExcelController())->excelDataCareerSubjectStudent($_GET['id_subject'], $_GET['id_career']);
}

?>