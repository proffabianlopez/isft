<?php if (isset($_GET['id_career']) && isset($_GET['name_career']) && isset($_GET['state'])): ?>
    <?php
    $data = SubjectController::getAllSubject($_GET['id_career']);
    ?>
    <section class="container-fluid py-3">
        <h1 class="text-center mt-1 mb-3 py-2"><?php echo $_GET['name_career'] ?></h1>
        <div class="row">
            <div class="col-10"></div>
            <div class="col text-center">
                <a href="index.php?pages=toolsCareer&id_career=<?php echo $_GET['id_career']; ?>&name_career=<?php echo $_GET['name_career']; ?>&state=<?php echo $_GET['state']; ?>" class="btn btn-info mb-3" title="Volver a Herramientas de la Carrera">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <div class="row py-4">
            <?php foreach ($data as $key => $value): ?>
                <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                    <a href="index.php?pages=manageCourse&id_career=<?php echo $value['id_career'] ?>&name_career=<?php echo $value['career_name'] ?>&state=<?php echo $value['state'] ?>&id_subject=<?php echo $value['id_subject']; ?>&name_subject=<?php echo $value['name_subject']; ?>" title="<?php echo $value['name_subject'] ?>">
                        <div class="small-box bg-secondary h-100 d-flex flex-column justify-content-between">
                            <div class="inner flex-grow-1">
                                <h4 class="m-1 text-truncate" style="max-width: 100%;"><?php echo $value['name_subject'] ?></h4>
                            </div>
                            <div class="icon text-center my-2">
                                <i class="fas fa-book-open" style="font-size: 48px;"></i>
                            </div>
                            <div class="small-box-footer">
                                <p class="text-center text-bold m-1"><?php echo $value['year_subject'] . " " . $value['year_detail'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>