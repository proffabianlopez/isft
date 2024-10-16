<?php
if ((isset($_GET['name_career'])) && (isset($_GET['id_career'])) && (isset($_GET['state']))) {
    $correlatives = CorrelativeController::listMultipleCorrelatives($_GET["id_career"]);
?>
    <br><br>
    <div class="d-flex justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <table class="table table-bordered table-striped table-responsive-sm" id="example3">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <form method="post" class="d-inline-block">
                                <button type="submit" name="correlative_pdf" class="btn btn-danger" title="Descargar PDF de correlativas">
                                     <i class="far fa-file-pdf mr-1"></i> Descargar PDF
                                </button>

                            </form>
                            <form method="post" class="d-inline-block">
                                <button type="submit" name="correlative_excel" class="btn btn-success" title="Descargar Excel de correlativas">
                                <i class="far fa-file-excel mr-1"></i> Descargar Excel
                                </button>

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
                                <td><?php echo $correlative['name_subject'] . " (" . $correlative['year'] . " " . $correlative['detail'] . ")"; ?></td>
                                <td><?php echo $correlative['correlatives']; ?></td>
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
    (new PdfController())->dataCareerPdfCorrelatives($_GET['name_career'],$_GET['id_career']);
}
if (isset($_POST['correlative_excel'])) {
    (new ExcelController())->excelDataCareerCorrelatives($_GET['name_career'],$_GET['id_career']);
}
?>