<section class="container-fluid py-3 text-center">
    <ul class="nav nav-pills">
        <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'newTeacher')) : ?>
            <li class="nav-item">
                <a class="nav-link active" href="index.php?pages=newTeacher">Crear nuevo profesor</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=newTeacher">Crear nuevo profesor</a>
            </li>
        <?php endif; ?>

        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'listTeacher')) : ?>
            <li class="nav-item">
                <a class="nav-link active bg-primary text-white" href="index.php?pages=manageTeacher&subfolder=listTeacher">Ver Listado de Profesores</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=manageTeacher&subfolder=listTeacher">Ver listado de profesores</a>
            </li>
        <?php endif; ?>
    </ul>
</section>

<?php
if (isset($_GET['subfolder'])) {
    if (($_GET['subfolder'] == "listTeacher")) {
        include "views/subfolder/" . $_GET['subfolder'] . ".php";
    }
} else {
    include "views/subfolder/listTeacher.php";
}
?>