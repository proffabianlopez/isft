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
                users.file as file_number,
                cursada.state as state
                FROM cursada 
                JOIN asignament_students_history AS ass ON cursada.id_asignementStudent = ass.id 
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


    static public function deleteAllAssignStudents($id_career)
    {
        $sql = "DELETE ass
        FROM asignament_students AS ass
        JOIN subjects AS s ON ass.fk_subject_id = s.id_subject
        JOIN careers AS c ON s.fk_career_id = c.id_career
        WHERE c.id_career = :id_career";
    
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true; 
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
    
        $stmt = null;
    }
    

   


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
        $stmt = null;
    }

//verifica si hay alguna asignacion de alumnos en la cursada    
    static public function checkAssignedStudents($id_career, $cycle_year) {
        $sql = "SELECT COUNT(*) 
                FROM asignament_students AS ash 
                JOIN subjects AS s ON ash.fk_subject_id = s.id_subject 
                JOIN cursada AS c ON c.id_asignementStudent = ash.id 
                WHERE s.fk_career_id = :id_career AND c.cycle_year = :cycle_year";
        
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(":id_career", $id_career, PDO::PARAM_INT);
        $stmt->bindParam(":cycle_year", $cycle_year, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0;
    }
    
    
//cambia el estado de la cursada finalizado 0
    static public function changeCourseState($id_career, $cycle_year) {
        $sql = "
            UPDATE cursada
            INNER JOIN asignament_students_history AS ash ON cursada.id_asignementStudent = ash.id
            INNER JOIN subjects AS s ON ash.fk_subject_id = s.id_subject
            SET cursada.state = 0
            WHERE s.fk_career_id = :id_career AND cursada.cycle_year = :cycle_year
        ";
    
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(":id_career", $id_career, PDO::PARAM_INT);
        $stmt->bindParam(":cycle_year", $cycle_year, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    


}
?>