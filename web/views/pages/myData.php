<?php
$user_data = UserController::sessionDataUser($_SESSION['id_user']);
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card mt-5">
                <div class="card-header bg-custom text-white">
                    <h2 class="text-center mb-0">Información personal</h2>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <img class="img-fluid" src="public/img/isft177_logo_chico.png" alt="User profile picture">
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
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Número telefónico:
                                    <span><?php if($user_data['phone_contact']){echo $user_data['phone_contact'];}else{echo "No registrado";} ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header bg-custom text-white">
                    <h2 class="text-center mb-0">Actualizar datos</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="newName">Nombre:</label>
                            <input type="text" class="form-control" id="newName" name="name" required value="<?php echo $user_data['name_user'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="newLastName">Apellido:</label>
                            <input type="text" class="form-control" id="newLastName" name="last_name" required value="<?php echo $user_data['last_name_user'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="tel">Teléfono</label>
                            <input type="text" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="tel" value="<?php echo $user_data['phone_contact'] ?>" required>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btn-warning btn-block w-25 text-center" name="Enviar">Guardar</button>
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