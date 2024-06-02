<?php if ($_SESSION['fk_rol_id'] == 1) : ?>
    <section class="container text-center">
        <h3 class="display-4 py-3">Panel de Administración Académica ISFT 177</h3>
        <img src="public/img/isft177_H.png" class="img-fluid mb-3">
        <p class="lead">Bienvenido a la sección de administración. Aquí puede gestionar todos los aspectos relacionados con carreras, materias y usuarios. Las siguientes funcionalidades estáran disponibles:</p>
        <div class="text-left">
            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-graduation-cap"></i> Gestión de Carreras</h4>
                <ul>
                    <li>Crear nuevas carreras</li>
                    <li>Editar detalles de las carreras</li>
                    <li>Crear o Acceder a la lista de materias</li>
                    <li>Asignar materias a las carreras</li>
                    <li>Asignar materias a los alumnos</li>
                    <li>Actualizar información de las carreras</li>
                </ul>
            </div>

            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-book"></i> Gestión de Materias</h4>
                <p>Mostrar todas las materias disponibles en las carreras.</p>
            </div>

            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-users"></i> Gestión de Usuarios</h4>
                <ul>
                    <li>Registrar nuevos alumnos o personal administrativo</li>
                    <li>Asignar alumnos a las carreras</li>
                    <li>Ver y gestionar todos los usuarios existentes</li>

                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($_SESSION['fk_rol_id'] == 2) : ?>
    <section class="container text-center">
        <h3 class="display-4 py-3">Panel de Administración Académica isft177</h3>
        <img src="public/img/isft177_H.png" class="img-fluid mb-3">
        <p class="lead">Bienvenido a la sección de Preceptores. Aquí puede gestionar todos los aspectos relacionados con los Alumnos</p>

        <div class="text-left">
            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-graduation-cap"></i> Gestión de Carreras</h4>
                <ul>
                    <li>Podras ver la carrera o carreras en las cuales este a cargo</li>
                    <li>Podras ver sus materias</li>
                    <li>Ver los Profesores</li>
                    <li>Asignar alumnos a la carrera que manejes</li>
                    <li>Darle legajos a los alumnos</li>

                </ul>
            </div>

            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-users"></i> Gestiónar alumnos</h4>
                <ul>
                    <li>Podras ver a todos los alumnos de la carrera que manejes</li>
                    <li>Podras habilitarle un usuario para que entren a la plataforma</li>
                    <li>Pasarle notas y asistencias</li>

                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>