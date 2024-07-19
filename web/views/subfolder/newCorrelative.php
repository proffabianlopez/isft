<?php
if ((isset($_GET['name_career'])) && (isset($_GET['id_career'])) && (isset($_GET['state']))) {
    $correlatives = CorrelativeController::listCorrelative($_GET["id_career"]);
?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card card-primary">
                    <div class="card-body">
                        <form id="newcorrelative">
                            <div class="form-group">
                                <label for="para_rendir">Para rendir... (Materia)</label>
                                <select class="custom-select" name="toRender">
                                    <option selected>Seleccione una materia</option>
                                    <?php (new CorrelativeController())->correlativeSelect($_GET["id_career"]); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="debe_aprobar">Debe aprobar... (Correlativa)</label>
                                <select class="custom-select" name="subjectApproved">
                                    <option selected>Seleccione correlativa</option>
                                    <?php (new CorrelativeController())->correlativeSelect($_GET["id_career"]); ?>
                                </select>
                            </div>
                            <hr>
                            <div class="form-group d-flex justify-content-center">
                                <button type="submit" class="btn btn-warning btn-block w-50" name="loadCorrelative">Crear</button>
                            </div>
                        </form>
                        <div class="response-message text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <table id="example3" class="table table-bordered table-striped table-responsive-sm">
                    <thead class="bg-custom">
                        <tr>
                            <th>Para rendir...</th>
                            <th>Debe aprobar...</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($correlatives as $correlative) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($correlative['name_subject']) ?></td>
                                <td><?php echo htmlspecialchars($correlative['name_correlative_subject']) ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_<?php echo $correlative['id_correlative'] ?>" title="editar materia">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal_<?php echo $correlative['id_correlative'] ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>
<?php foreach ($correlatives as $correlative) : ?>
    <div class="modal fade" id="modal_edit_<?php echo $correlative['id_correlative'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Correlativa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editcorrelative" >
                        <input type="hidden" name="id_correlativeEdit" value="<?php echo $correlative['id_correlative'] ?>">
                        <div class="form-group">
                            <label for="para_rendir">Para rendir...(Materia)</label>
                            <select class="custom-select" name="toRenderEdit">
                                <option value="<?php echo $correlative['id_subject'] ?>"><?php echo $correlative["name_subject"] ?></option>
                                <?php
                                (new CorrelativeController())->correlativeSelect($_GET["id_career"]);
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="debe_aprobar">Debe aprobar...(Correlativa)</label>
                            <select class="custom-select" name="subjectApprovedEdit">
                                <option value="<?php echo $correlative['id_subject'] ?>"><?php echo $correlative["name_correlative_subject"] ?></option>
                                <?php
                                (new CorrelativeController())->correlativeSelect($_GET["id_career"]);
                                ?>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning" name="savechange">Guardar Cambios</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                    <div class="response-message2 text-center"></div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?php foreach ($correlatives as $correlative) : ?>
    <div class="modal fade" id="confirmDeleteModal_<?php echo $correlative['id_correlative'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Estás seguro de que deseas eliminar la siguiente correlativa?</p>
                    <h5 class="text-center mt-4 mb-4"><?php echo $correlative['name_subject'] . " -> " . $correlative["name_correlative_subject"] ?></h5>
                    <p class="text-center">Esta acción no se puede deshacer.</p>
                    <form method="post">
                        <input type="hidden" name="id_correlative" value="<?php echo $correlative['id_correlative'] ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" name="deleteButton">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?php 
if (isset($_POST["deleteButton"])) {
    $controller = new CorrelativeController();
    $controller->deleteCorrelative($_GET["id_career"], $_GET["name_career"], $_GET["state"]);
}
?>