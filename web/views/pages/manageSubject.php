<?php if ( (isset($_GET['id_career'])) && (isset($_GET['name_career'])) && (isset($_GET['state'])) ): ?>
<section class="container-fluid py-3">
	<h2 class="text-center mt-1 mb-3 py-2 lead">Gestión de Materias: <?php echo $_GET['name_career'] ?></h2><ul class="nav nav-pills nav-justified mb-2">
		<?php if ($_GET['state'] == 0): ?>
		<?php if ( (isset($_GET['subfolder'])) && ($_GET['subfolder'] == 'newSubject')): ?>		
		<li class="nav-item">
			<a class="nav-link active" href="index.php?pages=manageSubject&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=newSubject">Crear Nueva Materia</a>
		</li>
		<?php else: ?>
		<li class="nav-item">
			<a class="nav-link" href="index.php?pages=manageSubject&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=newSubject">Crear Nueva Materia</a>
		</li>
		<?php endif ?>
		<?php endif ?>
		<?php if ( (isset($_GET['subfolder'])) && ($_GET['subfolder'] == 'listSubject') ): ?>		
		<li class="nav-item">
			<a class="nav-link active" href="index.php?pages=manageSubject&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=listSubject">Ver Listado de Materias</a>
		</li>
		<?php else: ?>
		<li class="nav-item">
			<a class="nav-link" href="index.php?pages=manageSubject&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=listSubject">Ver Listado de Materias</a>
		</li>
		<?php endif ?>		
		<li class="nav-item">
			<a href="index.php?pages=toolsCareer&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>" class="nav-link">volver a herramientas<i class="fas fa-arrow-circle-left ml-2"></i></a>
		</li>
	</ul>
	<?php 
	if (isset($_GET['subfolder'])) {
	# links administracion de materias
		if (($_GET['subfolder'] == "listSubject") || 
      		($_GET['subfolder'] == "newSubject") ||
			  ($_GET['subfolder'] == "subjectTeacher") || 
      		($_GET['subfolder'] == "assigmentTeacher") || 
      		($_GET['subfolder'] == "assigmentTeacherQuit")       		
      		
      		) {
			include "views/subfolder/".$_GET['subfolder'].".php";
		}
	} else {
		include "views/subfolder/listSubject.php";
	}
    ?>
</section>
<?php endif ?>