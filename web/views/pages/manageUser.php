<section class="container-fluid py-3 text-center">
    <ul class="nav nav-pills">
        <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'newUser')): ?>		
            <li class="nav-item">
                <a class="nav-link active" href="index.php?pages=newUser">Crear Nuevo Usuario</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=newUser">Crear Nuevo Usuario</a>
            </li>
        <?php endif; ?>
        
        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'listUser')): ?>		
            <li class="nav-item">
                <a class="nav-link active bg-primary text-white" href="index.php?pages=manageUser&subfolder=listUser">Ver Listado de Usuarios</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=manageUser&subfolder=listUser">Ver Listado de Usuarios</a>
            </li>
        <?php endif; ?>		
    </ul>
</section>

<?php 
	if (isset($_GET['subfolder'])) {
	# links administracion de materias
		if (($_GET['subfolder'] == "listUser") || 
      		($_GET['subfolder'] == "eliminatedUser")
      		) {
			include "views/subfolder/".$_GET['subfolder'].".php";
		}
	} else {
		include "views/subfolder/listUser.php";
	}
    ?>
