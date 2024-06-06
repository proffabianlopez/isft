<?php
$user_data = UserController::sessionDataUser($_SESSION['id_user']);
?>
<div class="container">
    <h2 class="text-center mt-1 mb-3 py-2 display-4">Mis datos</h2>
    <div class="text-center">
        <img class="img-fluid py-4" src="public/img/isft177_H.png" alt="User profile picture">
    </div>
    <div class="row justify-content-center pt-5">
        <div class="col align-self-center">
            <div style="border-color: #f2ca52;" class="card card-primary card-outline h-100 mb-0">
                <div class="card-body box-profile">
                    <ul class="list-group list-group-unbordered mb-0">

                        <? if ($_SESSION['fk_rol_id'] == 2 || $_SESSION['fk_rol_id'] == 3) : ?>
                            <li class="list-group-item">
                                <b>Carrera:</b><a class="float-right"><?php echo $user_data['carrer_name'] ?></a>
                            </li>
                        <?php endif; ?>
                        <li class="list-group-item">
                            <b>Nombre y Apellido:</b><a class="float-right"><?php echo $user_data['name_user'] . " " . $user_data['last_name_user'] ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Email:</b><a class="float-right"><?php echo $user_data['email'] ?></a>
                        </li>

                        <li class="list-group-item">
                            <b>DNI:</b><a class="float-right"><?php echo $user_data['dni'] ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Rol:</b><a class="float-right"><?php echo $user_data['name_rol'] ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col align-self-center">
            <div class="card h-100 mb-0">
                <div class="card-header bg-custom">
                    <h3 class="card-title py-1">Datos de Contacto</h3>
                </div>
                
                <div class="card-body">
                    <form method="POST">
                    <div class="form-group">
                            <label for="newEmail">Nuevo Nombre</label>
                            <input type="text" class="form-control" id="newEmail" name="name" required value="<?php echo $user_data['name_user'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="newEmail">Nuevo Apellido</label>
                            <input type="text" class="form-control" id="newEmail" name="last_name" required value="<?php echo $user_data['last_name_user'] ?>">
                        </div>    
                        <div class="form-group">
                            <label for="newEmail">Nuevo Correo Electrónico:</label>
                            <input type="email" class="form-control" id="newEmail" name="email" required value="<?php echo $user_data['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="newEmail">Nuevo Dni</label>
                            <input type="text" class="form-control" id="newEmail" name="dni" required value="<?php echo $user_data['dni'] ?>">
                        </div> 
                        <div class="d-flex justify-content-center align-items-center pt-4">
                            <button type="submit" class="btn bg-custom btn-warning btn-block w-50" name="Enviar">Actualizar Datos</button>
                        </div>
                        <?php
                        if (isset($_POST['Enviar'])) {
                            $controller = new UserController();
                            $controller->updateData();
                        }
                        ?>
                    </form>
                </div>

            </div>
        </div>



    </div>
</div>
</div>