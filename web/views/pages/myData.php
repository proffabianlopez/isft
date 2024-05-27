<?php
$user_data=UserController::sessionDataUser($_SESSION['id_user']);
?>
<div class="container-fluid">
    <h2 class="text-center mt-1 mb-3 py-2 display-4">Mis datos</h2>
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid" src="public/img/isft177_H.png" alt="User profile picture">
                    </div>                    
                    <h3 class="profile-username text-center"><?php  ?></h3>                
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Nombre y Apellido :</b><a class="float-right"><?php echo $user_data['name_user']." ". $user_data['last_name_user']?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Email:</b><a class="float-right"><?php echo $user_data['email']?></a>
                        </li>
                        
                        <li class="list-group-item">
                            <b>DNI:</b><a class="float-right"><?php echo $user_data['dni']?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Legajo:</b><a class="float-right"><?php echo is_null($user_data['file']) ? 'LEGAJO NO ASIGNADO' : $user_data['file']; ?></a>
                        </li>          
                        <li class="list-group-item">
                            <b>Estado:</b><a class="float-right"><?php echo ($user_data['state'] == 1) ? 'ACTIVO' : $user_data['state']; ?></a>
                        </li>

                        <li class="list-group-item">
                        <b>Carrera:</b><a class="float-right"><?php echo is_null($user_data['carrer_name']) ? 'CARRERA NO ASIGNADA' : $user_data['carrer_name']; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Rol:</b><a class="float-right"><?php echo $user_data['name_rol']?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos de Contacto</h3>
                </div>              
                <div class="card-body">
                <form  method="POST">
                <div class="form-group">
                    <label for="newEmail"><? ?>Nuevo Correo Electrónico:</label>
                    <input type="email" class="form-control" id="newEmail" name="email" required value="<?php echo $user_data['email']?>">
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="Enviar">Actualizar</button>
                <?php
                            if (isset($_POST['Enviar'])) {
                                $controller = new UserController();
                                $controller->newMail();
                            }
                            ?>
            </form>                  
                </div> 

            </div>         
</div>

            

        </div>
    </div>
</div>