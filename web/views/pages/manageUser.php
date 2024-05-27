<section class="container py-3">
    <h2 class="text-center mt-1 mb-3 py-2 lead">Gestionar Usuarios del Instituto</h2>
    <div class="row d-flex justify-content-center">
        <!-- Carta para Administrador -->
        <?php $rol_type=UserController::countUserType()?>
        <div class="col-md-8">
            <div class="small-box bg-primary text-white">
                <div class="inner">
                    <h3><?php echo $rol_type['countAdmin']?></h3> <!-- Cantidad simulada -->
                    <p>Administrador</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <a href="index.php?pages=manegeUser&submenu=viewsListAdmin" class="small-box-footer text-white">
                    <b>Gestionar</b> <i class="fas fa-tools ml-2"></i>
                </a>
            </div>
        </div>
        <!-- Carta para Preceptor -->
        <div class="col-md-8">
            <div class="small-box bg-success text-white">
                <div class="inner">
                    <h3><?php echo $rol_type['countPreceptory']?></h3> <!-- Cantidad simulada -->
                    <p>Preceptor</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <a href="index.php?pages=manegeUser&submenu=viewsListPreceptory" class="small-box-footer text-white">
                    <b>Gestionar</b> <i class="fas fa-tools ml-2"></i>
                </a>
            </div>
        </div>
        <!-- Carta para Alumno -->
        <div class="col-md-8">
            <div class="small-box bg-danger text-white">
                <div class="inner">
                    <h3><?php echo $rol_type['countStudent']?></h3> <!-- Cantidad simulada -->
                    <p>Alumno</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="index.php?pages=manegeUser&submenu=viewsListStudents" class="small-box-footer text-white">
                    <b>Gestionar</b> <i class="fas fa-tools ml-2"></i>
                </a>
            </div>
        </div>
    </div>    
    <?php 
    if (isset($_GET['submenu'])) {
        # links administracion de correlatividades
            if (($_GET['submenu'] == "viewsListAdmin") || 
                ($_GET['submenu'] == "viewsListPreceptory") || 
                  ($_GET['submenu'] == "viewsListStudents") 
                  
                  ) {
                    include "views/pages/".$_GET['submenu'].".php";;
            }
    }
    
    ?>
</section>
