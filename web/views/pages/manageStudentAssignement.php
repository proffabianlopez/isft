<section class="container-fluid py-3 text-center">
    <h2 class="text-center mt-1 mb-3 py-2 lead">Gestión de Alumnos en: <?php echo $_GET['name_subject'] ?></h2>
    <ul class="nav nav-pills nav-fill mb-2">
        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'listAssignStudent')) : ?>
            <li class="nav-item">
                <a class="nav-link active" href="index.php?pages=manageStudentAssignement&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&id_subject=<?php echo $_GET['id_subject'] ?>&name_subject=<?php echo $_GET['name_subject'] ?>&subfolder=listAssignStudent">Asignar alumnos</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=manageStudentAssignement&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&id_subject=<?php echo $_GET['id_subject'] ?>&name_subject=<?php echo $_GET['name_subject'] ?>&subfolder=listAssignStudent">Asignar alumnos</a>
            </li>
            
        <?php endif; ?>
        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'listSubjectStudent')) : ?>
            <li class="nav-item">
                <a class="nav-link active" href="index.php?pages=manageStudentAssignement&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&id_subject=<?php echo $_GET['id_subject'] ?>&name_subject=<?php echo $_GET['name_subject'] ?>&subfolder=listSubjectStudent">Alumnos asignados</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=manageStudentAssignement&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&id_subject=<?php echo $_GET['id_subject'] ?>&name_subject=<?php echo $_GET['name_subject'] ?>&subfolder=listSubjectStudent">Alumnos asignados</a>
            </li>
            
        <?php endif; ?>
        <li class="nav-item">
            <a href="index.php?pages=manageSubject&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>" class="nav-link">Volver a gestión de materias <i class="fas fa-arrow-circle-left ml-2"></i></a>
        </li>
    </ul>
</section>

<?php 
	if (isset($_GET['subfolder'])) {
		if (($_GET['subfolder'] == "listSubjectStudent") || 
      		($_GET['subfolder'] == "listAssignStudent")     		
      		
      		) {
			include "views/subfolder/".$_GET['subfolder'].".php";
		}
	} else {
		include "views/subfolder/listSubjectStudent.php";
	}
?>


