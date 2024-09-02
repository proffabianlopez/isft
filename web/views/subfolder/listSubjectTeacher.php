<?php 
if (isset($_GET['name_career']) && isset($_GET['id_career']) && isset($_GET['state'])) {  
    //$dataTeacher = CareerController::careerPreceptorControllerListAssigned($_GET['id_career']);
    //Cambiar esta variable para llamar a la función que trae la lista de profesores asignados.
    //El GET debería enviar el id_subject.
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
                    </tr>
                </thead>
                <tbody>                   
                    <?php foreach ($dataTeacher as $data): ?>
                        <tr>
                            <td class="align-middle"><?php echo $data['name'] ?></td>
                            <td class="align-middle"><?php echo $data['last_name'] ?></td>
                            <td class="align-middle"><?php echo $data['dni'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>