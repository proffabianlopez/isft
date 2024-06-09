<?php
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql

class CareerModel
{

	static public function showCareer()
	{
		$sql = " SELECT careers.id_career AS id_career,
		careers.career_name AS career_name,
		careers.description AS description,
		careers.abbreviation AS abbreviation,
		careers.state AS state
		FROM careers;
		";
		$stmt = model_sql::connectToDatabase()->prepare($sql);

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
									VALUES (:careerName, :description, :abbreviation, 0)";
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
}
