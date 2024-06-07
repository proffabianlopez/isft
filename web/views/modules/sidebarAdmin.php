 <?php $data = UserController::sessionDataUser($_SESSION['id_user']) ?>
 <?php if ($data['change_password'] != 0) : ?>

     <li class="nav-item mb-1">
         <a href="index.php?pages=manageUser" class="nav-link">
             <i class="fas fa-users-cog nav-icon"></i>
             <p>Gestión de Usuarios</p>
         </a>
     </li>

     <li class="nav-item mb-1">
         <a href="#" class="nav-link">
             <i class="fas fa-graduation-cap nav-icon"></i>
             <p>Carreras
                 <i class="right fas fa-angle-left"></i>
             </p>
         </a>
         <ul class="nav nav-treeview">
             <li class="nav-item mb-1">
                 <a href="index.php?pages=newCareer" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Nueva Carrera</p>
                 </a>
             </li>
             <li class="nav-item mb-1">
                 <a href="index.php?pages=allCareers" class="nav-link">
                     <i class="far fa-circle nav-icon"></i>
                     <p>Todas las Carreras</p>
                 </a>
             </li>
         </ul>
     </li>
     <li class="nav-item mb-1">
         <a href="index.php?pages=manageStudent" class="nav-link">
             <i class="fas fa-user-graduate nav-icon"></i>
             <p>Alumnos</p>
         </a>
     </li>

     <li class="nav-item mb-1">
         <a href="index.php?pages=manageTeacher" class="nav-link">
             <i class="fas fa-user-tie nav-icon"></i>
             <p>Profesores</p>
         </a>
     </li>
     </li>



 <?php endif; ?>