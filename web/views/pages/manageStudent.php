<section class="container-fluid py-3 text-center">
    <ul class="nav nav-pills">
        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'newStudent')) : ?>
            <li class="nav-item">
                <a class="nav-link active" href="index.php?pages=manageStudent&subfolder=newStudent">Crear nuevo alumno</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=manageStudent&subfolder=newStudent">Crear nuevo alumno</a>
            </li>
        <?php endif; ?>

        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'listStudent')) : ?>
            <li class="nav-item">
                <a class="nav-link active bg-primary text-white" href="index.php?pages=manageStudent&subfolder=listStudent">Ver listado de alumnos</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=manageStudent&subfolder=listStudent">Ver listado de alumnos</a>
            </li>
        <?php endif; ?>
    </ul>
</section>

<?php
if (isset($_GET['subfolder'])) {
    if (($_GET['subfolder'] == "listStudent" || $_GET['subfolder'] == "newStudent")) {
        include "views/subfolder/" . $_GET['subfolder'] . ".php";
    }
} else {
    include "views/subfolder/listStudent.php";
}
?>