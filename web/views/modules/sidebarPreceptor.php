<?php $data = UserController::sessionDataUser($_SESSION['id_user']) ?>
<?php if ($data['change_password'] != 0) : ?>
    <li class="nav-item mb-1">
        <a href="index.php?pages=allCareers" class="nav-link">
            <i class="fas fa-graduation-cap nav-icon"></i>
            <p>Mis Carreras</p>
        </a>
    </li>

    <li class="nav-item mb-1">
        <a href="index.php?pages=manageStudent" class="nav-link">
            <i class="fas fa-user-graduate nav-icon"></i>
            <p>Alumnos</p>
        </a>
    </li>
<?php endif ?>


   
