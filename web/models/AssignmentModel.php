<?php
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql
//aqui iran todas las consultas relacionada a las asignaciones de profesores preceptores y docentes
class AssignmentModel {

	//inserta el id que viene de crear materia en la tabla de materia Profesores
	static public function assignSubjectToTeacher($subjectId) {
		$sql = "INSERT INTO asignament_teachers (fk_user_id, fk_subject_id, state) VALUES (null, :subject_id, 1)";
		$pdo=model_sql::connectToDatabase();
        $stmt =$pdo->prepare($sql);
		$stmt->bindParam(':subject_id', $subjectId, PDO::PARAM_INT);
		
		if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
        }

        $stmt = null;
	}
 
	static public function infoGetSubjectData($id)
		{
			$sql = "SELECT 
				asignament_teachers.id AS id_pivot,
				subjects.id_subject AS id_subject,
				subjects.name_subject AS name_subject,
				subjects.details AS details,
				yearSubject.year AS yearSubject,
				yearSubject.detail AS detail_year,
				users.id_user AS id_teacher,
				CONCAT(users.name, ' ', users.last_name) AS name_teacher,
				careers.career_name AS career_name,
				careers.id_career AS id_career  
			FROM 
				asignament_teachers
			JOIN 
				subjects ON asignament_teachers.fk_subject_id = subjects.id_subject 
			JOIN 
				yearSubject ON subjects.fk_year_subject = yearSubject.id_year_subject 
			JOIN 
				careers ON subjects.fk_career_id = careers.id_career 
			LEFT JOIN 
				users ON asignament_teachers.fk_user_id = users.id_user 
			WHERE 
				subjects.id_subject = ?
			";
			$stmt = model_sql::connectToDatabase()->prepare($sql);
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			if ($stmt->execute()) {
				return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
			} else {
				print_r($stmt->errorInfo());
			}
		
			$stmt = null;
		}

    
    }


?>