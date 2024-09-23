<?php
// Verificar si se ha seleccionado una carrera y su nombre está presente en la URL
if (isset($_GET['name_career']) && isset($_GET['id_career']) && isset($_GET['state'])) {
    ?>
    <br>

    <div class="container pt-4 pb-3">
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header bg-custom text-black text-center">
                        <h4 class="my-1 font-weight-bold">Nueva materia</h4>
                    </div>
                    <div class="card-body">
                        <form id="newsubject">
                            <div class="row px-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pt-1" for="name">Nombre de la materia <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control reset" name="name_subject"
                                            placeholder="Ingrese el nombre" maxlength="100" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pt-1" for="lastName">Carga horaria<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control reset" name="details"
                                            placeholder="Carga horaria anual" min="1" maxlength="3"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group px-2">
                                <label class="pt-1" for="id_year">Año de la materia <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="id_year" name="id_year" required>
                                    <?php
                                    (new SubjectController())->yearSelect();
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" name='confirmNewSubject'
                                    class="btn bg-custom btn-block w-50 btn-warning ladda-button">Crear</button>
                            </div>
                        </form>
                        <br>
                        <div class="response-message text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-info text-center">
                    <p class="my-1"><b>NOTA: </b>Para crear la materia, la carga horaria debe ser superior a 0 con un máximo
                        de 260.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        <?php if (isset($_GET['id_career'])): ?>
            let idCareer = "<?php echo htmlspecialchars($_GET['id_career']); ?>";
        <?php endif; ?>
    </script>
    <?php
}
?>
