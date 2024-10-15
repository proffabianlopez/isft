<?php
// Verificar si se ha seleccionado una carrera y su nombre está presente en la URL
if (isset($_GET['name_career']) && isset($_GET['id_career']) && isset($_GET['state'])) {
?>
    <br>

    <div class="container pt-4 pb-3">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header bg-custom text-black text-center">
                        <h4 class="my-1 font-weight-bold">Nuevas fechas de final</h4>
                    </div>
                    <div class="card-body">
                        <form id="newfinal">
                            <div class="row px-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pt-1" for="subject">Materia<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="id_subject" name="id_subject" required>
                                            <?php
                                            //(new FinalController())->subjectsSelect();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pt-1" for="accomp_prof">Profesor acompañante<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="id_teacher" name="id_teacher" required>
                                            <?php
                                            //(new FinalController())->teachersSelect();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row px-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pt-1" for="first_date">1er Fecha <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control mb-3" type="date" name="first_date" id="first_date">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pt-1" for="second_date">2da Fecha</label>
                                        <input class="form-control mb-3" type="date" name="second_date" id="second_date">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" name='confirmNewFinal'
                                    class="btn bg-custom btn-block w-50 btn-warning ladda-button">Cargar</button>
                            </div>
                        </form>
                        <br>
                        <div class="response-message text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>