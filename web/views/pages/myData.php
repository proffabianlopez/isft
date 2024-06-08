<?php
$user_data = UserController::sessionDataUser($_SESSION['id_user']);
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card mt-5">
                <div class="card-header bg-custom text-white">
                    <h2 class="text-center mb-0">Información Personal</h2>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <img class="img-fluid rounded-circle" src="public/img/isft177_logo_chico.png" alt="User profile picture">
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Nombre y Apellido:
                                    <span><?php echo $user_data['name_user'] . " " . $user_data['last_name_user'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Email:
                                    <span><?php echo $user_data['email'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    DNI:
                                    <span><?php echo $user_data['dni'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Rol:
                                    <span><?php echo $user_data['name_rol'] ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header bg-custom text-white">
                    <h2 class="text-center mb-0">Actualizar Datos</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="newName">Nuevo Nombre:</label>
                            <input type="text" class="form-control" id="newName" name="name" required value="<?php echo $user_data['name_user'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="newLastName">Nuevo Apellido:</label>
                            <input type="text" class="form-control" id="newLastName" name="last_name" required value="<?php echo $user_data['last_name_user'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="newEmail">Nuevo Correo Electrónico:</label>
                            <input type="email" class="form-control" id="newEmail" name="email" required value="<?php echo $user_data['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="newDni">Nuevo DNI:</label>
                            <input type="text" class="form-control" id="newDni" name="dni" required value="<?php echo $user_data['dni'] ?>">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning btn-block" name="Enviar">Actualizar Datos</button>
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
