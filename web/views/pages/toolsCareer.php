<?php if ( (isset($_GET['id_career'])) && (isset($_GET['name_career'])) && (isset($_GET['state'])) ):?>
<section class="container-fluid py-3">
    <h2 class="text-center mt-1 mb-3 py-2 lead">Herramientas de la Carrera:  <?php echo $_GET['name_career']  ?></h2>
    <div class="row">
    <div class="col-lg-6">
        <a href="index.php?pages=manageSubject&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>Materias</h3>
                    <p>Agregar o Editar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard"></i>
                </div>                
                <div class="small-box-footer">
                    Gestionar Materias<i class="fas fa-arrow-circle-right ml-2"></i>
                </div>                
            </div>
        </a>
    </div>

    <div class="col-lg-6">
        <a href="index.php?pages=manageCorrelatives&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>Correlativas</h3>
                    <p>Crear árbol de materias</p>
                </div>
                <div class="icon">
                    <i class="fas fa-network-wired"></i>
                </div>                
                <div class="small-box-footer">
                    Gestionar Correlativas<i class="fas fa-arrow-circle-right ml-2"></i>
                </div>
            </div>            
        </a>
    </div>

    <div class="col-lg-6">
        <a href="index.php?pages=managePreceptor&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
            <div class="small-box badge-warning">
                <div class="inner">
                    <h3>Asignar Preceptores</h3> 
                    <p>Gestionar Preceptores para la Carrera</p> 
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i> 
                </div>
                <div class="small-box-footer">
                    Gestionar Preceptores<i class="fas fa-arrow-circle-right ml-2"></i>
                </div>
            </div>
        </a>
    </div>

    <?php if($_GET['state'] == 0): ?>
        <div class="col-lg-6">
        <a href="#" id="enableStateButton" data-toggle="modal" data-target="#enableChangeStateModal">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="buttonLabel">Habilitar</h3>
                    <p>De esta forma, el preceptor podrá acceder a su carrera correspondiente</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="small-box-footer">
                    Finalizar<i class="fas fa-arrow-circle-right ml-2"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="enableChangeStateModal" tabindex="-1" role="dialog" aria-labelledby="enableChangeStateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="confirmChangeStateModalLabel">Confirmar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Estás seguro de que querés habilitar la carrera?</p>
                    <h5 class="text-center mt-4 mb-4"><?php echo $_GET['name_career']; ?></h5>
                    <form method="POST">
                        <input type="hidden" name="id_career_actual" value="<?php echo $_GET['id_career']; ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="enable" class="btn btn-success">Habilitar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php else: ?>
        <div class="col-lg-6">
        <a href="#" id="disableStateButton" data-toggle="modal" data-target="#disableChangeStateModal">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="buttonLabel">Deshabilitar</h3>
                    <p>De esta forma, el preceptor no visualizará su carrera y no podrás manejar la cursada</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="small-box-footer">
                    Finalizar<i class="fas fa-arrow-circle-right ml-2"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="disableChangeStateModal" tabindex="-1" role="dialog" aria-labelledby="disableChangeStateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="disableChangeStateModalLabel">Confirmar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Estás seguro de que querés deshabilitar la carrera?</p>
                    <h5 class="text-center mt-4 mb-4"><?php echo $_GET['name_career']; ?></h5>
                    <form method="POST">
                        <input type="hidden" name="id_career_actual" value="<?php echo $_GET['id_career']; ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="disable" class="btn btn-danger">Deshabilitar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php 
    if(isset($_POST['enable'])){
        $controller = new CareerController;
        $controller->enableStateCareer();
    }
    elseif(isset($_POST['disable'])){
        $controller = new CareerController;
        $controller->disableStateCareer();
    }
    ?>

    <div class="col-lg-6">
        <a href="index.php?pages=careerEdit&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
            <div class="small-box bg-light">                
                <div class="inner">
                    <h3>Editar</h3>
                    <p>Editar información de la carrera</p>
                </div>
                <div class="icon">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="small-box-footer">
                    ir a Edición<i class="fas fa-arrow-circle-right ml-2"></i>
                </div>                
            </div>
        </a>
    </div>

    <div class="col-lg-6">
        <a href="index.php?pages=careerInfo&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['career_name'] ?>&state=<?php echo $_GET['state'] ?>">
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>Info</h3>
                    <p>Ver información de la carrera</p>
                </div>
                <div class="icon">
                    <i class="fas fa-info"></i>
                </div>
                <div class="small-box-footer">
                    Ver Info<i class="fas fa-arrow-circle-right ml-2"></i>
                </div>                
            </div>
        </a>
    </div>

    <?php    if ($_GET['state'] == 1):?>
    <div class="col-lg-6">
        <a href="index.php?pages=manageSubjectStudent&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
            <div class="small-box bg-info">
                <div class="inner text-white">
                    <h3>Cursada</h3>
                    <p>Asignar Alumnos a la Materia</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>                
                <div class="small-box-footer text-white">
                    Asignar Alumnos<i class="fas fa-arrow-circle-right ml-2"></i>
                </div>
            </div>            
        </a>
    </div>
    <?php endif?>
        
</section>
<?php endif ?>
