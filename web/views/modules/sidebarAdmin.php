 <?php $data = UserController::sessionDataUser($_SESSION['id_user']) ?>
 <?php if ($data['change_password'] != 0) : ?>


     <li class="nav-item mb-1">
         <a href="#" class="nav-link">
             <i class="fas fa-cogs nav-icon"></i>
             <p>
                 Gestión
                 <i class="right fas fa-angle-left"></i>
             </p>
         </a>
         <ul class="nav nav-treeview">
             <li class="nav-item mb-1">
                 <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-users-cog"></i>
                     <p>
                         Gestión de Usuarios
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item mb-1">
                         <a href="index.php?pages=newUser" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Nuevo Usuario</p>
                         </a>
                     </li>
                     <li class="nav-item mb-1">
                         <a href="index.php?pages=manageUser" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Gestionar Usuarios</p>
                         </a>
                     </li>
                 </ul>
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
                         <a href="index.php?pages=newCarreer" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Nueva Carrera</p>
                         </a>
                     </li>
                     <li class="nav-item mb-1">
                         <a href="index.php?pages=allCarreer" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Todas las Carreras</p>
                         </a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item mb-1">
                 <a href="#" class="nav-link">
                     <i class="fas fa-user-graduate nav-icon"></i>
                     <p>Alumnos
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item mb-1">
                         <a href="index.php?pages=newStudent" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Nuevo Alumno</p>
                         </a>
                     </li>
                     <li class="nav-item mb-1">
                         <a href="index.php?pages=listStudent" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Todos los Alumnos</p>
                         </a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item mb-1">
                 <a href="#" class="nav-link">
                     <i class="fas fa-user-tie nav-icon"></i>
                     <p>
                         Profesores
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item mb-1">
                         <a href="index.php?pages=newTeacher" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Nuevo Profesor</p>
                         </a>
                     </li>
                     <li class="nav-item mb-1">
                         <a href="index.php?pages=listTeacher" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Todos los Profesores</p>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>
     </li>


 <?php endif; ?>