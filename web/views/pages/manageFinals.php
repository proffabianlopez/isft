<?php if ((isset($_GET['id_career'])) && (isset($_GET['name_career'])) && (isset($_GET['state']))) : ?>
	<section class="container-fluid py-3">
		<h2 class="text-center mt-1 mb-3 py-2 lead">Gestión de finales: <?php echo $_GET['name_career'] ?></h2>
		<ul class="nav nav-pills nav-justified mb-2">
				<?php if ((isset($_GET['subfolder'])) && ($_GET['subfolder'] == 'newFinal')) : ?>
					<li class="nav-item">
						<a class="nav-link active" href="index.php?pages=manageFinals&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=newFinal">Cargar fecha de final</a>
					</li>
				<?php else : ?>
					<li class="nav-item">
						<a class="nav-link" href="index.php?pages=manageFinals&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=newFinal">Cargar fecha de final</a>
					</li>
				<?php endif ?>

			<?php if ((isset($_GET['subfolder'])) && ($_GET['subfolder'] == 'listFinals')) : ?>
				<li class="nav-item">
					<a class="nav-link active" href="index.php?pages=manageFinals&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=listFinals">Ver listado de finales</a>
				</li>
			<?php else : ?>
				<li class="nav-item">
					<a class="nav-link" href="index.php?pages=manageFinals&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>&subfolder=listFinals">Ver listado de finales</a>
				</li>
			<?php endif ?>

			<li class="nav-item">
				<a href="index.php?pages=toolsCareer&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>" class="nav-link">Volver a herramientas<i class="fas fa-arrow-circle-left ml-2"></i></a>
			</li>
		</ul>
		<?php
		if (isset($_GET['subfolder'])) {
			# links administracion de materias
			if (($_GET['subfolder'] == "listFinals") ||
				($_GET['subfolder'] == "newFinal")
			) {
				include "views/subfolder/" . $_GET['subfolder'] . ".php";
			}
		} else {
			include "views/subfolder/listFinals.php";
		}
		?>
	</section>
<?php endif ?>