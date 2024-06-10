<?php 
if ((isset($_GET['name_career'])) && (isset($_GET['id_career']))) {  
?>
<br>
<h2 class="text-center mt-1 mb-3 py-2 lead">Crear Materias</h2>
<div class="container pt-4 pb-3">
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header bg-custom text-black text-center">
                    <h4 class="my-1 font-weight-bold">Nueva materia</h4>
                </div>
                <div class="card-body">
                    <form method='POST'>
                        <div class="row px-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="name">Nombre de la materia <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name_subject" placeholder="Ingrese el nombre de la Materia" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="pt-1" for="lastName">Detalle<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="details" placeholder="Observaciones" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group px-2">
                            <label class="pt-1" for="id_year">Año de la materia <span class="text-danger">*</span></label>
                            <select class="form-control" id="id_year" name="id_year" required>
                                <?php
                                (new SubjectController())->yearSelect();
                                ?>
                            </select>
                        </div>
                        
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" name='confirmNewSubject' class="btn bg-custom btn-block w-50 btn-warning">Crear nueva materia</button>
                        </div>
                    </form>
                  <?php
                    $messageController = new MessageController();
                    $messageController->showMessageVerify('message', 'La materia se creó correctamente.');?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<?php
if (isset($_POST['confirmNewSubject'])) {
    $controller = new SubjectController();
    $newcreate=$controller->newSubject($_GET['id_career'], $_GET['name_career']);
    if($newcreate){
      
            // Mostrar el mensaje de éxito y actualizar la URL
            echo '<script>
                if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);

                }
                window.location = "index.php?pages=manageSubject&id_career=' . $_GET['id_career'] . '&name_career=' . $_GET['name_career'] . '&state=' . $_GET['state'] . '&subfolder=newSubject&subject=correcto";
            </script>';
        
    }
}
?>
