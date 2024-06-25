<section class="container-fluid py-3 text-center">
    <h2 class="text-center mt-1 mb-3 py-2 lead">Gestión de Preceptores: <?php echo $_GET['name_career'] ?></h2>
    <ul class="nav nav-pills nav-fill mb-2">
        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'listPreceptor')) : ?>
            <li class="nav-item">
                <a class="nav-link active" href="index.php?pages=managePreceptor&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=listPreceptor">Asignar Preceptores</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=managePreceptor&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=listPreceptor">Asignar Preceptores</a>
            </li>
            
        <?php endif; ?>
        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'listCareerPreceptor')) : ?>
            <li class="nav-item">
                <a class="nav-link active" href="index.php?pages=managePreceptor&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=listCareerPreceptor">Preceptores Asignados</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=managePreceptor&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=listCareerPreceptor">Preceptores Asignados</a>
            </li>
            
        <?php endif; ?>
        <li class="nav-item">
            <a href="index.php?pages=toolsCareer&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>" class="nav-link">Volver a herramientas <i class="fas fa-arrow-circle-left ml-2"></i></a>
        </li>
    </ul>
</section>

<?php 
	if (isset($_GET['subfolder'])) {
	# links administracion de materias
		if (($_GET['subfolder'] == "listCareerPreceptor") || 
      		($_GET['subfolder'] == "listPreceptor")     		
      		
      		) {
			include "views/subfolder/".$_GET['subfolder'].".php";
		}
	} else {
		include "views/subfolder/listCareerPreceptor.php";
	}
    ?>


