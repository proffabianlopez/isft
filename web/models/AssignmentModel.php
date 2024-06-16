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
	// Esta funcion trae toda la info de la materia
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

    // Esta consulta va a inserta en la tabla de person_career, para insertar a los estudiantes una carrera.

	static public function insertCareerPerson($careerId, $userId)
{
    $sql = "INSERT INTO career_person(fk_career_id, fk_user_id) VALUES (:fk_career_id, :fk_user_id)";
    $stmt = model_sql::connectToDatabase()->prepare($sql);

    $stmt->bindParam(":fk_career_id", $careerId, PDO::PARAM_INT);
    $stmt->bindParam(":fk_user_id", $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
    $stmt = null; // Liberar el statement
}
	static public function updateCareerStudent($id_career,$id_career_person){

		$sql = "UPDATE career_person SET fk_career_id = :fk_career_id WHERE id_career_person = :id_career_person";
		$stmt = model_sql::connectToDatabase()->prepare($sql);
		$stmt->bindParam(':fk_career_id', $id_career, PDO::PARAM_STR);
		$stmt->bindParam(':id_career_person', $id_career_person, PDO::PARAM_STR); // Aquí se corrigió $last_name por $details
		
	
		if ($stmt->execute()) {
			// Devolver true si la actualización se realiza correctamente
			return true;
		} else {
			// Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
			print_r($stmt->errorInfo());
			return false; // Devolver false en caso de error
		}
		$stmt = null;
		
	}
	// PARA SABER SI ALGUN  PRECEPTOR NO ESTA ASIGNADO
	static public function preceptorNoAssig($id)
{
    $sql = "SELECT users.id_user, users.name, users.last_name, career_person.fk_career_id AS id_career
            FROM users
            LEFT JOIN career_person ON users.id_user = career_person.fk_user_id
            WHERE users.id_user = :id_user AND users.fk_rol_id = 2 AND career_person.fk_career_id IS NULL";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_user', $id, PDO::PARAM_INT); // Assuming id_user is an integer, use PARAM_INT
    
    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row since we expect only one result
    } else {
        print_r($stmt->errorInfo());
        return null; // Return null or handle error as needed
    }

    $stmt = null;
}

static public function preceptorAssig($id_career, $id_user)
{
    $sql = "SELECT users.id_user, users.name, users.last_name
            FROM users 
            INNER JOIN career_person ON users.id_user = career_person.fk_user_id
            WHERE users.id_user = :id_user AND users.fk_rol_id = 2 AND career_person.fk_career_id = :id_career";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row since we expect only one result
    } else {
        print_r($stmt->errorInfo());
        return null; // Return null or handle error as needed
    }

    $stmt = null;
}




}


?>