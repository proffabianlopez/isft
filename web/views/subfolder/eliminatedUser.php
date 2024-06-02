<?php

if(isset($_GET['id_user'])) {

    
    // Resto de tu código
    $info = UserController::sessionDataUser($_GET['id_user']);
    ?>
   <div class="row justify-content-center mt-4">
        <div class="card col-md-4"> <!-- Cambiado de col-md-6 a col-md-4 -->
            <div class="card-body">
                <h2 class="text-center lead badge-danger mb-4">¡ATENCIÓN! Se eliminará el Usuario</h2>
                <table class="table table-striped mb-4">
                    <thead>
                        <tr><th colspan="2">Datos del Usuario:</th></tr>  
                    </thead>
                    <tbody>
                        <tr><td><b>Nombre Completo</b></td><td><?php echo $info['name_user'].$info['last_name_user'] ?></td></tr>
                        <tr><td><b>Email</b></td><td><?php echo $info['email'] ?></td></tr>
                        <tr><td><b>Documento de Identidad</b></td><td><?php echo $info['dni'] ?></td></tr>

                    </tbody>
                </table>           
                <form method="post">                
                    <input type="hidden" name="id_user" value="<?php echo $_GET['id_user'] ?>">
                    <input type="submit" name="del_user" value="¡Confirmar!" class="btn btn-outline-success btn-block">
                </form>
            </div>
        </div>
    </div>
<?php 
  
}


if (isset($_POST['del_user'])) {
   $controller= new UserController();
   $controller->eliminatedUser();
   
}
?>
