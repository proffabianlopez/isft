<?php
class CourseModel
{
    static public function asinngNotesCoursesSubjectStudent($id_subject, $id_student, $note1, $note2, $recuperatory1, $recuperatory2)
    {
        $sql = "UPDATE cursada AS c
                JOIN asignament_students AS ass ON ass.id = c.id_asignementStudent
                SET c.note1 = :note1, 
                    c.note2 = :note2, 
                    c.recuperatory1 = :recuperatory1, 
                    c.recuperatory2 = :recuperatory2
                WHERE ass.fk_user_id = :id_student AND ass.fk_subject_id= :fk_subject_id AND c.state = 1";

        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT);
        $stmt->bindParam(':fk_subject_id', $id_subject, PDO::PARAM_INT);
        $stmt->bindParam(':note1', $note1, PDO::PARAM_INT);
        $stmt->bindParam(':note2', $note2, PDO::PARAM_INT);
        $stmt->bindParam(':recuperatory1', $recuperatory1, PDO::PARAM_INT);
        $stmt->bindParam(':recuperatory2', $recuperatory2, PDO::PARAM_INT);
        if ($stmt->execute()) {
			// Devolver true si la actualización se realiza correctamente
			return true;
		} else {
			// Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
			print_r($stmt->errorInfo());
			return false; // Devolver false en caso de error
		}
    }

    static public function getAllCoursesSubjectStudent($id_subject)
    {
        $currentYear = date('Y'); 
        $sql = "SELECT
            users.id_user AS id_student,
            users.name AS name_student,
            users.last_name AS last_name_student,
            c.note1 as nota1,
            c.note2 as nota2,
            c.recuperatory1 as recuperatorio1,
            c.recuperatory2 as recuperatorio2,
            c.cycle_year as ciclo_lectivo,
            c.state as estado_cursada,
            users.fk_rol_id AS fk_rol_id,
             users.file as file_number
            FROM users
            JOIN asignament_students as ass ON ass.fk_user_id = users.id_user
            JOIN cursada as c ON c.id_asignementStudent = ass.id
            WHERE 
            users.fk_rol_id = 3
            AND users.state IN (1, 2) 
            AND c.state = 1 
            AND c.cycle_year = :currentYear 
            AND ass.fk_subject_id = :fk_subject_id";
    
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':fk_subject_id', $id_subject, PDO::PARAM_INT);
        $stmt->bindParam(':currentYear', $currentYear, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }
    
        $stmt = null;
    }

    static public function getHistoryCoursesSubjectStudent($id_subject)
    {
        
    
        $sql = "SELECT users.id_user AS id_student, users.name AS name_student, 
                users.last_name AS last_name_student, 
                cursada.note1 AS nota1, 
                cursada.note2 AS nota2, 
                cursada.recuperatory1 AS recuperatorio1, 
                cursada.recuperatory2 AS recuperatorio2, 
                cursada.cycle_year AS ciclo_lectivo, 
                cursada.state AS estado_cursada, 
                users.fk_rol_id AS fk_rol_id,
                users.file as file_number
                FROM cursada 
                JOIN asignament_students AS ass ON cursada.id_asignementStudent = ass.id 
                JOIN users ON ass.fk_user_id = users.id_user 
                WHERE users.fk_rol_id = 3 AND ass.fk_subject_id =:fk_subject_id";
    
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':fk_subject_id', $id_subject, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }
    
        $stmt = null;
    }
    


    //nos traera el fk de id_assignamente student para meterlo en cursadas
//     static public function id_assignamentStudent($id_subject, $id_student)
// {
//     $sql = "SELECT 
//                 asignament_students.id AS id,
//                 asignament_students.fk_user_id,
//                 asignament_students.fk_subject_id
//             FROM 
//                 asignament_students
//             WHERE 
//                 asignament_students.fk_user_id = :fk_student_id
//                 AND asignament_students.fk_subject_id = :fk_subject_id";

    //     $stmt = model_sql::connectToDatabase()->prepare($sql);
//     $stmt->bindParam(':fk_student_id', $id_student, PDO::PARAM_INT);
//     $stmt->bindParam(':fk_subject_id', $id_subject, PDO::PARAM_INT);

    //     if ($stmt->execute()) {
//         return $stmt->fetch(PDO::FETCH_ASSOC); 
//     } else {
//         print_r($stmt->errorInfo());
//         return null; 
//     }
// }


    //inserta en automatico cuando se agregue la asignacion del alumno y materia
    static public function insertCourseStudent($id, $cycle_year)
    {
        $sql = "INSERT INTO cursada(id_asignementStudent,cycle_year,state) VALUES (:id , :cycle_year, 1)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":cycle_year", $cycle_year, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
        $stmt = null; // Liberar el statement
    }


}
?>