<?php
if ((isset($_GET['name_career'])) && (isset($_GET['id_career'])) && (isset($_GET['state']))) {
    $correlatives = CorrelativeController::listCorrelative($_GET["id_career"]);
?>
    <div class="d-flex justify-content-center align-items-center p-5">

        <div class="card card-primary mt-2 mb-2 w-50">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="para_rendir">Para rendir...(Materia)</label>
                        <select class="custom-select" name="toRender">
                            <option>Seleccione una materia</option>
                            <?php
                            (new CorrelativeController())->correlativeSelect($_GET["id_career"]);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="debe_aprobar">Debe aprobar...(Correlativa)</label>
                        <select class="custom-select" name="subjectApproved">
                            <option>Seleccione correlativa</option>
                            <?php
                            (new CorrelativeController())->correlativeSelect($_GET["id_career"]);
                            ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-block btn-warning bg-custom w-25" name="loadCorrelative">Crear</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <table class="table table-bordered table-striped table-responsive-sm" id="example2">
                    <thead>
                        <tr>
                            <th>Para rendir...</th>
                            <th>Debe aprobar...</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($correlatives as $correlative) : ?>
                            <tr>
                                <td hidden><?php echo $correlative["id_subject"]; ?></td>
                                <td><?php echo htmlspecialchars($correlative['name_subject']) ?></td>
                                <td>
                                    <?php
                                    $info = CorrelativeController::listMultipleCorrelatives($correlative['id_subject']);
                                    if (!empty($info)) {
                                        $correlativesList = [];
                                        foreach ($info as $correlation) {
                                            $correlativesList[] = htmlspecialchars($correlation['correlatives']);
                                        }
                                        echo implode(' - ', $correlativesList);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="index.php?pagina=carrerasCorrelatividadMenu&correlatividad=<?php echo base64_encode($correlative['id_correlative']) ?>&carrera=<?php echo $_GET['id_career'] ?>&name=<?php echo $_GET['name_career'] ?>&para=<?php echo base64_encode($correlative['id_subject']) ?>&paraid=<?php echo base64_encode($correlative['id_correlative_subject']) ?>&debe=<?php echo base64_encode($correlative['id_subject']) ?>&debeid=<?php echo base64_encode($correlative['id_correlative_subject']) ?>&submenu=correlatividadEditar&estate=<?php echo $_GET['state'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="index.php?pagina=carrerasCorrelatividadMenu&correlatividad=<?php echo base64_encode($correlative['id_correlative']) ?>&carrera=<?php echo $_GET['id_career'] ?>&name=<?php echo $_GET['name_career'] ?>&para=<?php echo base64_encode($correlative['id_subject']) ?>&debe=<?php echo base64_encode($correlative['id_subject']) ?>&submenu=correlatividadEliminar&estate=<?php echo $_GET['state'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <?php if (isset($_POST["loadCorrelative"])) {
        $controller = new CorrelativeController();
        $controller->newCorrelative($_GET["id_career"], $_GET["name_career"], $_GET["state"]);
    } ?>
<?php
} // cierre
