<?php
$data = AssignmentController::infoDataSubject($_GET['id_subject']);

// Usar error_log para depurar el contenido de $data
error_log('Contenido de $data: ' . print_r($data, true));
?>

<section class="container-fluid py-3 text-center">
    <h2 class="text-center mt-1 mb-3 py-2 lead">Materia: <?php echo $_GET['name_subject'] ?></h2>
    <h5 class="text-center mt-1 mb-4 py-2 lead">Profesor/es:
        <?php
        $totalTeachers = count($data);
        $counter = 0;

        foreach ($data as $teachers) :
            if (!empty($teachers['name_teacher'])) {
                $counter++;
                echo $teachers['name_teacher'];

                if ($counter < $totalTeachers) {
                    echo ', ';
                }
            }
        endforeach;
        ?>
    </h5>
    <ul class="nav nav-pills nav-fill mb-2">
            <li class="nav-item">
                <a class="nav-link active" href="index.php?pages=manageCourse&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&id_subject=<?php echo $_GET['id_subject'] ?>&name_subject=<?php echo $_GET['name_subject'] ?>&subfolder=listCourse">Lista de la cursada</a>
            </li>
        <li class="nav-item">
            <a href="index.php?pages=previewCourse&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>" class="nav-link">Volver a herramientas <i class="fas fa-arrow-circle-left ml-2"></i></a>
        </li>
    </ul>
</section>

<?php
if (isset($_GET['subfolder'])) {
    # links administracion de materias
    if (($_GET['subfolder'] == "listCourse")) {
        include "views/subfolder/" . $_GET['subfolder'] . ".php";
    }
} else {
    include "views/subfolder/listCourse.php";
}
?>