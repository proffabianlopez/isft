<?php
//esta clase va a servir para manejar  todas las asignacion preceptores/profesores/alumnos
class AssignmentController {
    // Trae datos de la materia
    static public function infoDataSubject($id)
    {
        return AssignmentModel::infoGetSubjectData($id);
    }
    // agrega un preceptor a la carrera en curso
    static public function assignPreceptor($career, $name, $state)
{
    $id_career = $career;
    $name_career = $name;
    $state_career = $state;

    if (!empty($_POST['id_career_post']) && !empty($_POST['id_preceptor'])) {
        $id_career_post = $_POST['id_career_post'];
        $id_preceptor = $_POST['id_preceptor'];

        // Verificar cantidad de carreras asignadas
        $assigned_count = AssignmentModel::preceptorAccountCareer($id_preceptor);
        $count_preceptors =  AssignmentModel::preceptorAllAccountCareer($id_career);
         

        if ($assigned_count >= 2) { // Verificar si es mayor o igual a 2
            echo ' <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">No se puede asignar al mismo preceptor mas de 2 carreras</div>
                    </div>
                </div>';
            return; // Salir de la función si ya tiene dos carreras asignadas
        }

        if ($count_preceptors  >=2) { 
            echo ' <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">No se puede asignar a mas de 2 Preceptores en una Carrera</div>
                    </div>
                </div>';
                   
            return; 
        }

        // Insertar asignación si no tiene dos carreras asignadas aún
        $insert = AssignmentModel::insertCareerPerson($id_career_post, $id_preceptor);

        if ($insert) {
            echo '<script>
            window.location.href = "index.php?pages=managePreceptor&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=listPreceptor&message=correcto";
            </script>';
        } else {
            echo "No se pudo asignar Preceptor.";
        }
    }
}
    static public function assignSubjectToTeacher($id_career, $name_career, $state, $id_subject, $name_subject){
        if (!empty($_POST['id_subject_post']) && !empty($_POST['id_teacher'])) {
        // Insertar asignación si no tiene dos carreras asignadas aún
        $insert = AssignmentModel::insertSubjectTeacher($_POST['id_subject_post'], $_POST['id_teacher']);

        if ($insert) {
            echo '<script>
            window.location.href = "index.php?pages=manageTeacherAssignement&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state .'&id_subject='. $id_subject .'&name_subject='.$name_subject.'&subfolder=listAssignTeacher&message=correcto";
            </script>';
        } else {
            echo "No se pudo asignar Profesor.";
        }
    }
    }

    static public function assignSubjectToStudent($id_career, $name_career, $state, $id_subject, $name_subject) {
        if (!empty($_POST['id_subject_post']) && !empty($_POST['id_student'])) {
            


        $currentYear = date('Y');
        $currentMonth = date('m');
        if ($currentMonth >= 10) {  
            $cycle_year = $currentYear + 1;
        } else {
            $cycle_year = $currentYear;
        }
    
            // Insertar la asignación del estudiante a la materia
            $insert = AssignmentModel::insertSubjectStudent($_POST['id_subject_post'], $_POST['id_student']);
            
            if ($insert) {
                // Usar el ID de la asignación recién creada para insertar en la tabla 'cursada'
                $insertCourse = CourseModel::insertCourseStudent($insert, $cycle_year);
                
                if ($insertCourse) {
                    // Redireccionar usando header para evitar resubmissions
                    header('Location: index.php?pages=manageStudentAssignement&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state .'&id_subject='. $id_subject .'&name_subject=' . $name_subject . '&subfolder=listAssignStudent&message=correcto');
                    exit();
                } else {
                    echo "No se pudo registrar el curso del alumno.";
                }
            } else {
                echo "No se pudo asignar al alumno a la materia.";
            }
        }
    }
    

        // Borra un preceptor de la carrera en curso

        static public function quitPreceptor($career,$name,$state){


            $id_career= $career;
            $name_career=$name;
    
            if(!empty($_POST['id_preceptor'])){
    
                
                $id_preceptor=$_POST['id_preceptor'];
    
                $delete=AssignmentModel::deleteAssign($id_preceptor);
    
                if ($delete) {
                  
                    echo '<script>
                    window.location.href = "index.php?pages=managePreceptor&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=listPreceptor&message=correcto";
                    </script>';
                } else {
                    // Manejo de error si la inserción falla
                    echo "No se pudo quitar Preceptor.";
                }
    
            }


        }
        static public function quitTeacherSubject($id_career, $name_career, $state, $id_subject, $name_subject){

            error_log("quitTeacherSubject: ". $_POST['id_teacher']);
    
            if(!empty($_POST['id_teacher'])){
    
                
                $id_teacher=$_POST['id_teacher'];

                $delete=AssignmentModel::deleteTeacherSubject($id_teacher, $id_subject);
    
                if ($delete) {
                  
                    echo '<script>
                    window.location.href = "index.php?pages=manageTeacherAssignement&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state .'&id_subject='. $id_subject .'&name_subject='.$name_subject.'&subfolder=listAssignTeacher&message=correcto";
                    </script>';
                } else {
                    // Manejo de error si la inserción falla
                    echo "No se pudo quitar Preceptor.";
                }
    
            }


        }
//quita al estudiante de la materia
        static public function quitStudentSubject($id_career, $name_career, $state, $id_subject, $name_subject){

            error_log("quitTeacherSubject: ". $_POST['id_student']);
    
            if(!empty($_POST['id_student'])){
    
                
                $id_student=$_POST['id_student'];

                $delete=AssignmentModel::deleteStudentSubject($id_student, $id_subject);
                error_log("delete",$delete);
                if ($delete) {
                  
                    echo '<script>
                     window.location.href = "index.php?pages=manageStudentAssignement&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state .'&id_subject='. $id_subject .'&name_subject='.$name_subject.'&subfolder=listAssignStudent&message=correcto";
                    </script>';
                } else {
                    // Manejo de error si la inserción falla
                    echo "No se pudo quitar Preceptor.";
                }
    
            }


        }

        static public function show_career_preceptor($id){

            return AssignmentModel::preceptor_career($id);
        }  
          static public function show_career_teacherSubject($id_teacher, $id_career){

            return AssignmentModel::teacherSubject_career($id_teacher, $id_career);
        }

 //asigna a un profesor a una carrera
 static public function assignTeacher($id_teacher,$name_teacher)
 {
     if (!empty($_POST['career_id'])) {
         $id_career = $_POST['career_id'];
 
         // Insertar asignación si no tiene dos carreras asignadas aún
         $insert = AssignmentModel::insertCareerPerson($id_career, $id_teacher);
 
         if ($insert) {
             // Redirigir después de una asignación exitosa
             echo '<script>
             window.location.href = "index.php?pages=manageTeacher&id_teacher=' . $id_teacher . '&name_teacher=' . $name_teacher  . '&subfolder=teacherCareer&message=correcto";
             </script>';
         } else {
             echo "No se pudo asignar la carrera al profesor.";
         }
     }
 }
 

         static public function quitProfesor($id_teacher,$name_teacher){
    
            if(!empty($_POST['id_career_teacher'])){
    
                
                $id_career_teacher=$_POST['id_career_teacher'];
    
                $delete=AssignmentModel::deleteAssign($id_career_teacher);
    
                if ($delete) {
                  
                    echo '<script>
                    window.location.href = "index.php?pages=manageTeacher&id_teacher=' . $id_teacher . '&name_teacher=' . $name_teacher  . '&subfolder=teacherCareer&message=correcto";
                    </script>';
                } else {
                    // Manejo de error si la inserción falla
                    echo "No se pudo quitar Preceptor.";
                }
    
            }


        }

        static public function showTeacherSubejct($id_subject)
        {
            return AssignmentModel::model_showTeacherSubejct($id_subject);
        }    


        //para ver los alumnos asignados a la materia
        static public function showStudentSubejct($id_subject)
        {
            return AssignmentModel::model_showStudentSubejct($id_subject);
        }    


        
        static public function show_career_StudentsSubject($id_student, $id_career){

            return AssignmentModel::studentSubject_career($id_student, $id_career);
        }
        
    
    }

    
?>