
<?php
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql

class SubjectModel
{

	static public function showYearSubject()
	{
		$sql = " SELECT yearSubject.id_year_subject  AS id_year_subject ,
		yearSubject.year AS year,
        yearSubject.detail  AS detail 
		FROM yearSubject ;
		";
		$stmt = model_sql::connectToDatabase()->prepare($sql);

		if ($stmt->execute()) {

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {

			print_r($stmt->errorInfo());
		}

		$stmt = null;
	}

    static public function newSubject($value1, $value2, $value3,$value4)
	{
		$sql = "INSERT INTO subjects (name_subject, details, fk_year_subject,fk_career_id,create_data,state)
									VALUES (:name_subject, :details, :fk_year_subject,:fk_career_id,NOW(), 1)";
		$stmt = model_sql::connectToDatabase()->prepare($sql);
		$stmt->bindParam(':name_subject', $value1, PDO::PARAM_STR);
		$stmt->bindParam(':details', $value2, PDO::PARAM_STR);
		$stmt->bindParam(':fk_year_subject', $value3, PDO::PARAM_INT);
        $stmt->bindParam(':fk_career_id', $value4, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return $stmt;
		} else {
			print_r($stmt->errorInfo());
		}
	}


}