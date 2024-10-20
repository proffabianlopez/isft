<?php
// Verificar si se ha seleccionado una carrera y su nombre está presente en la URL
if (isset($_GET['name_career']) && isset($_GET['id_career']) && isset($_GET['state'])) {

    $allTeachers = TeacherController::getAllTeachers();
    $allSubjects = FinalController::getAllSubjectFinal($_GET['id_career']);
    ?>
    <script>
        console.log(<?= json_encode($allTeachers) ?>);
    </script>
    <br>

    <div class="container pt-4 pb-3">
        <div class="row justify-content-center">
        <div class="col-xl-7">
                <div class="card">
                    <div class="card-header bg-custom text-black text-center">
                        <h4 class="my-1 font-weight-bold">Nuevas fechas de final</h4>
                    </div>
                    <div class="card-body">
                        <form id="newfinal">
                            <div class="row px-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pt-1" for="subject">Materia<span class="text-danger">*</span></label>
                                        <select class="form-control select2 reset" id="id_subject" name="id_subject" required  style="width: 100%;">
                                        <option value="" selected disabled>Seleccione una materia</option>
                                            <?php
                                            foreach ($allSubjects as $key => $subject) {
                                                echo '<option value="' . $subject['id_subject'] . '">' . $subject['name_subject']. ' (' . $subject['year_detail'] . ')-'.$subject['teacher'].' </option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pt-1" for="accomp_prof">Profesor acompañante</label>
                                        <select class="form-control select2 reset" id="id_teacher_vocal" name="id_teacher_vocal" required>
                                        <option value="" selected disabled>Seleccione un profesor</option>
                                            <option value="" >Ninguno</option>
                                            <?php
                                            foreach ($allTeachers as $key => $teacher) {
                                                echo '<option value="' . $teacher['id_teacher'] . '">' .$teacher['last_name_teacher'].' '. $teacher['name_teacher'] . '</option>';
                                            }
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
                                        <input class="form-control mb-3 date-today reset" type="date" name="first_date" id="first_date" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pt-1" for="second_date">2da Fecha</label>
                                        <input class="form-control mb-3 date-today reset" type="date" name="second_date" id="second_date">
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