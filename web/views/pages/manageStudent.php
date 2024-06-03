<section class="container-fluid py-3 text-center">
    <ul class="nav nav-pills">
        <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'newStudent')): ?>		
            <li class="nav-item">
                <a class="nav-link active" href="index.php?pages=newStudent">Crear Nuevo Alumno</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=newStudent">Crear Nuevo Alumno</a>
            </li>
        <?php endif; ?>
        
        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'listStudent')): ?>		
            <li class="nav-item">
                <a class="nav-link active bg-primary text-white" href="index.php?pages=manageStudent&subfolder=listStudent">Ver Listado de Alumnos</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=manageStudent&subfolder=listStudent">Ver Listado de Alumnos</a>
            </li>
        <?php endif; ?>		
    </ul>
</section>

<?php 
	if (isset($_GET['subfolder'])) {
		if (($_GET['subfolder'] == "listStudent") 
      		) {
			include "views/subfolder/".$_GET['subfolder'].".php";
		}
	} else {
		include "views/subfolder/listStudent.php";
	}
    ?>
