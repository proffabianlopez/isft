<?php
class FinalModel
{
    
    static public function isOpenFinal($id)
    {
        $id = $id['id_assigment_teacher'];
        $sql = "SELECT et.is_open
            FROM exam_table as et
                WHERE et.fk_asignament_teacher = :id";

        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }
        $stmt = null;
    } 
    static public function isDuplicateTeacher($id )
    {
        $id = $id['id_assigment_teacher'];
        $sql = "SELECT ast.fk_user_id as id_teacher
                FROM asignament_teachers as ast
                WHERE ast.id = :id";

        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }
        $stmt = null;
    }
    static public function showSubjectFinal($id)
    {
        $sql = "SELECT
                    subjects.id_subject AS id_subject,
                    subjects.name_subject,
                    subjects.details AS details,
                    subjects.fk_year_subject AS id_year,
                    yearSubject.year AS year_subject,
                    yearSubject.detail AS year_detail,
                    careers.id_career AS id_career,
                    careers.state AS state,
                    careers.career_name AS career_name,
                    CONCAT(u.last_name, ' ', u.name) AS teacher
                    FROM subjects
                    JOIN yearSubject ON subjects.fk_year_subject=yearSubject.id_year_subject
                    JOIN careers ON subjects.fk_career_id=careers.id_career
                    JOIN asignament_teachers AS ast ON subjects.id_subject = ast.fk_subject_id
                    JOIN users as u ON ast.fk_user_id = u.id_user
                    WHERE 
                    careers.id_career = ? AND subjects.state=1";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }
        $stmt = null;
    }

    public static function verificDate($id_teacher_vocal, $id_teacher, $first_date, $second_date)
    {
        $id_teacher = $id_teacher['id_assigment_teacher'];
        $id_teacher = empty($id_teacher) ? NULL : trim($id_teacher);
            $query = "SELECT 
                            s.name_subject,
                            CONCAT(u_vocal.name, ' ', u_vocal.last_name) AS Vocal,
                            CONCAT(u_asignado.name, ' ', u_asignado.last_name) AS Asignado,
                            u_vocal.id_user AS vocal_id,
                            u_asignado.id_user AS asignado_id,
                            et.date_final1,
                            et.date_final2
                      FROM exam_table AS et
                      JOIN asignament_teachers AS ast ON et.fk_asignament_teacher = ast.id
                      JOIN users AS u_vocal ON et.fk_teacher_vocal_id = u_vocal.id_user
                      JOIN users AS u_asignado ON ast.fk_user_id = u_asignado.id_user
                      JOIN subjects AS s ON ast.fk_subject_id = s.id_subject
                      WHERE (et.fk_teacher_vocal_id = :id_teacher_vocal)
                      AND (et.date_final1 = :first_date OR et.date_final2 = :second_date)
                      AND ast.id = :id_teacher";
    
            $stmt = model_sql::connectToDatabase()->prepare($query);
    
            // Enlace de parámetros, asegurando que se use un nombre diferente si el valor se repite
            $stmt->bindParam(':id_teacher_vocal', $id_teacher_vocal, PDO::PARAM_INT);
            $stmt->bindParam(':first_date', $first_date, PDO::PARAM_STR);
            $stmt->bindParam(':second_date', $second_date, PDO::PARAM_STR);
            $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT);
        

        if (!$stmt->execute()) {
            error_log("Error al ejecutar la consulta: " . print_r($stmt->errorInfo(), true));
            return false;
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devolver los resultados
    }



    public static function setnewFinal($teacher_vocal, $id_teacher, $first_date, $second_date)
    {
        $sql = "INSERT INTO exam_table (fk_asignament_teacher, fk_teacher_vocal_id, date_final1, date_final2)
                VALUES (:id_teacher, :teacher_vocal, :first_date, :second_date)";

        $stmt = model_sql::connectToDatabase()->prepare($sql);

        // Recorrer la lista de id_teacher y ejecutar el INSERT para cada uno


        $id_teacher = $id_teacher['id_assigment_teacher'];

        $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT);
        $stmt->bindParam(':teacher_vocal', $teacher_vocal, PDO::PARAM_INT);
        $stmt->bindParam(':first_date', $first_date, PDO::PARAM_STR);
        $stmt->bindParam(':second_date', $second_date, PDO::PARAM_STR);

        // Ejecutar la consulta y comprobar si falla
        if (!$stmt->execute()) {
            error_log("Error al insertar: " . print_r($stmt->errorInfo(), true));
            return false; // Podrías lanzar una excepción aquí
        }


        return true;
    }


    public static function subjectverificTeacher($id_subject)
    {
        $sql = "SELECT id as id_assigment_teacher
                FROM asignament_teachers as ate
                WHERE ate.fk_subject_id = :id_subject && ate.state = 1 LIMIT 1";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':id_subject', $id_subject, PDO::PARAM_INT);
        if ($stmt->execute()) {

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } else {

            print_r($stmt->errorInfo());

        }

        $stmt = null;

    }

}