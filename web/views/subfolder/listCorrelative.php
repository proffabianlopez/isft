<?php
if ((isset($_GET['name_career'])) && (isset($_GET['id_career'])) && (isset($_GET['state']))) {
    $correlatives = CorrelativeController::listMultipleCorrelatives($_GET["id_career"]);
?>
    <br><br>
    <div class="d-flex justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <table class="table table-bordered table-striped table-responsive-sm" id="example1">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <form method="post">
                                    <button type="submit" name="correlative_pdf" class="btn btn-danger">Descargar Correlativas en PDF <i class="far fa-file-pdf ml-2"></i></button>
                                </form>
                            </th>
                        </tr>
                        <tr>
                            <th class="bg-custom">Para rendir...</th>
                            <th class="bg-custom">Debe aprobar...</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($correlatives as $correlative) : ?>
                            <tr>
                                <td><?php echo $correlative['name_subject'] ?></td>
                                <td><?php echo $correlative['correlatives'] ?></td>
                            </tr>

            </div>


        <?php endforeach ?>
        </tbody>
        </table>
        </div>
    </div>

<?php
}
if (isset($_POST['correlative_pdf'])) {
    // (new PdfController())->PdfCorrelatives($data, $_GET['name_career']);
}
?>