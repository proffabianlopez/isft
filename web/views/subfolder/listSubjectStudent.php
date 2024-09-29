<?php 
if (isset($_GET['name_career']) && isset($_GET['id_career']) && isset($_GET['state'])) {  
    //$dataStudent = AssignmentController::showStudentSubject($_GET['id_subject']);
?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" style="width: 50%; margin: 0 auto;" id="example3">
                <thead> 
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
<?php } ?>