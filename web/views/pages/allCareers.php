<?php
$data = CareerController::getCareersData();
?>
<section class="container-fluid py-3">
    <h1 class="text-center mt-1 mb-3 py-2">Gestionar Carreras del Instituto</h1>
    <div class="row py-4">
        <?php foreach ($data as $key => $value) : ?>
            <div class="col-lg-6">
                <a href="#">
                    <!-- <a href="index.php?pagina=carrerasHerramientas&carrera=<?php echo base64_encode($value['id_career']) ?>&name=<?php echo base64_encode($value['career_name']) ?>&state=<?php echo base64_encode($value['state']) ?>"> -->
                    <div class="small-box bg-secondary">
                        <?php if ($value['state'] == 'inactive') : ?>
                            <div class="ribbon-wrapper ribbon-xl">
                                <div class="ribbon bg-danger">
                                    Inactive
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="inner">
                            <h3>Gestionar Carrera</h3>
                            <h5 class="mb-4"><?php echo $value['career_name'] ?></h5>
                        </div>
                        <div class="icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="small-box-footer">
                            <b>Herramientas</b><i class="fas fa-tools ml-2"></i>
                        </div>
                    </div>
                    <!-- </a> -->
                </a>
            </div>
        <?php endforeach ?>
    </div>
    <div class="alert alert-info mt-4">
        <p><b>NOTA: </b>Con tu Rol de Preceptor serás el administrador de las carreras que des de alta en el sistema y de sus materias correspondientes.</p>
    </div>
</section>