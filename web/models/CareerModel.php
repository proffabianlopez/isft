<?php

class CareerModel
{

    //muestra todas las carreras existentes
	static public function showCareer()
	{
		$sql = " SELECT careers.id_career AS id_career,
		careers.career_name AS career_name,
		careers.description AS description,
		careers.abbreviation AS abbreviation,
		careers.state AS state
		FROM careers
        WHERE state=1;
		";
		$stmt = model_sql::connectToDatabase()->prepare($sql);

		if ($stmt->execute()) {

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {

			print_r($stmt->errorInfo());
		}

		$stmt = null;
	}

    //muestra la carreras ligadas al preceptor
    static public function showCareerPreceptor($id)
	{
		$sql = " SELECT careers.id_career AS id_career, 
       careers.career_name AS career_name,
       careers.state as state
        FROM career_person
        JOIN careers ON career_person.fk_career_id = careers.id_career
        JOIN users ON career_person.fk_user_id = users.id_user
        WHERE users.id_user = ? and careers.state=1";
		$stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {

			print_r($stmt->errorInfo());
		}

		$stmt = null;
	}
 
	static public function newCareer($value1, $value2, $value3)
	{
		$sql = "INSERT INTO careers (career_name, description, abbreviation, state)
									VALUES (:careerName, :description, :abbreviation, 1)";
		$stmt = model_sql::connectToDatabase()->prepare($sql);
		$stmt->bindParam(':careerName', $value1, PDO::PARAM_STR);
		$stmt->bindParam(':description', $value2, PDO::PARAM_STR);
		$stmt->bindParam(':abbreviation', $value3, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return $stmt;
		} else {
			print_r($stmt->errorInfo());
		}
	}

	//modelo para traer los datos de la carrera seleccionada
	static public function nameCareer($id)
	{
		$sql = " SELECT careers.id_career AS id_career,
		careers.career_name AS name_career,
		careers.description AS description,
		careers.abbreviation AS abbreviation,
		careers.state AS state
		FROM careers
		where id_career=?
		";
		$stmt = model_sql::connectToDatabase()->prepare($sql);
		$stmt->bindParam(1, $id, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} else {

			print_r($stmt->errorInfo());
		}

		$stmt = null;
	}


    static public function editCareer($new_name_career, $new_description, $new_abbreviation, $id_career)
    {
        $sql = "UPDATE careers
                SET career_name = :new_career_name,
                    description = :new_description,
                    abbreviation = :new_abbreviation 
                WHERE id_career = :id_career";
        
        try {
            $stmt = model_sql::connectToDatabase()->prepare($sql);
            $stmt->bindParam(':new_career_name', $new_name_career, PDO::PARAM_STR);
            $stmt->bindParam(':new_description', $new_description, PDO::PARAM_STR);
            $stmt->bindParam(':new_abbreviation', $new_abbreviation, PDO::PARAM_STR);
            $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return true; // Devuelve true si la actualización fue exitosa
            } else {
                return false; // Devuelve false si hubo algún error
            }
        } catch (PDOException $e) {
            // Manejar cualquier excepción de PDO (por ejemplo, imprimir el mensaje de error)
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    //trae info de la carrera catidad de materias y carga horaria en total
	static public function careerInfo($id)
{
    $sql = "SELECT 
                careers.id_career,
                careers.career_name AS name_career,
                careers.description AS title,
                careers.abbreviation AS abbreviation,
                COUNT(subjects.id_subject) AS total_subject,
                SUM(subjects.details) AS total_hours
            FROM 
                subjects
                JOIN careers ON subjects.fk_career_id = careers.id_career
            WHERE 
                careers.id_career = ?
            GROUP BY 
                careers.id_career, careers.career_name, careers.description, careers.abbreviation";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        print_r($stmt->errorInfo());
    }

    $stmt = null;
}

static public function carrerInfoPreceptor($id){
	$sql = "SELECT 
    careers.id_career,
    careers.career_name,
    GROUP_CONCAT(CONCAT(users.name, ' ', users.last_name) SEPARATOR ' - ') AS preceptores
FROM 
    careers
LEFT JOIN 
    career_person ON careers.id_career = career_person.fk_career_id
LEFT JOIN 
    users ON career_person.fk_user_id = users.id_user
WHERE 
    careers.id_career = ? 
    AND users.fk_rol_id = 2
GROUP BY 
    careers.id_career, careers.career_name;
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

//cuenta los estudiantes inscriptos  a una carrera
static public function careerCountStudent($id)
{
    $sql = " SELECT SUM(users.fk_rol_id=3) AS total_student
FROM career_person
JOIN users ON career_person.fk_user_id=users.id_user
WHERE career_person.fk_career_id=? ";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        print_r($stmt->errorInfo());
    }

    $stmt = null;
}

    static public function disableStateCareer($id_career) {
        $sql = "UPDATE careers
                SET state = 0
                WHERE id_career = :id_career";
        
        try {
            $stmt = model_sql::connectToDatabase()->prepare($sql);
            $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    //trae los datos del preceptor y las carreras que administra
    static public function careerPreceptor($id)
    {
        $sql = "SELECT 
            careers.id_career AS id_career,
            careers.career_name AS career_name,
            careers.state AS state
            FROM career_person
            JOIN careers ON career_person.fk_career_id = careers.id_career
            JOIN users ON career_person.fk_user_id = users.id_user
            WHERE users.id_user = ? AND careers.state = 1";
    
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Usamos fetchAll para obtener todas las filas
        } else {
            print_r($stmt->errorInfo());
            return false; // Devolvemos false en caso de error
        }
    
        $stmt = null;
    }
    
    // Preceptores asignados a la carrera
    static public function careerPreceptorAssigned($id)
    {
        $sql = "SELECT 
	careers.career_name AS career_name,
    careers.state AS state,
    users.name AS name,
    users.last_name AS last_name,
    users.dni AS dni,
    users.id_user AS id_preceptor
    FROM career_person
    JOIN careers ON career_person.fk_career_id=careers.id_career
    JOIN users ON career_person.fk_user_id=users.id_user
    WHERE careers.state=1 AND careers.id_career=? AND users.fk_rol_id=2";
    
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Usamos fetchAll para obtener todas las filas
        } else {
            print_r($stmt->errorInfo());
            return false; // Devolvemos false en caso de error
        }
    
        $stmt = null;
    }


}



