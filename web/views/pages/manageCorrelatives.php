<?php if ((isset($_GET['id_career'])) && (isset($_GET['name_career'])) && (isset($_GET['state']))) : ?>
    <section class="container-fluid py-3">
        <h2 class="text-center mt-1 mb-3 py-2 lead">Gestión de Correlativas: <?php echo $_GET['name_career'] ?></h2>
        <ul class="nav nav-pills nav-justified mb-2">
            <?php if ($_GET['state'] == 0) : ?>
                <?php if ((isset($_GET['subfolder'])) && ($_GET['subfolder'] == 'newCorrelative')) : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?pages=manageCorrelatives&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=newCorrelative">Crear nueva correlativa</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?pages=manageCorrelatives&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=newCorrelative">Crear nueva correlativa</a>
                    </li>
                <?php endif ?>
            <?php endif ?>
            <?php if ((isset($_GET['subfolder'])) && ($_GET['subfolder'] == 'listCorrelative')) : ?>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?pages=manageCorrelatives&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=listCorrelative">Ver listado de correlativas</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pages=manageCorrelatives&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=listCorrelative">Ver listado de correlativas</a>
                </li>
            <?php endif ?>
            <li class="nav-item">
                <a href="index.php?pages=toolsCareer&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>" class="nav-link">Volver a herramientas<i class="fas fa-arrow-circle-left ml-2"></i></a>
            </li>
        </ul>
        <?php
        if (isset($_GET['subfolder'])) {
            # links administracion de materias
            if (($_GET['subfolder'] == "listCorrelative") ||
                ($_GET['subfolder'] == "newCorrelative")
            ) {
                include "views/subfolder/" . $_GET['subfolder'] . ".php";
            }
        } else {
            include "views/subfolder/listCorrelative.php";
        }
        ?>
    </section>
<?php endif ?>