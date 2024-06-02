<?php 
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql

class CarrerModel {

	static public function showCarrer() {
		$sql = ' 
		SELECT carrers.id_carrer AS "id_carrer"
			,carrers.carrer_name AS "carrer_name"
            ,carrers.description AS "description"
            ,carrers.abbreviation AS "abbreviation"
		FROM carrers;
		';
		$stmt = model_sql::connectToDatabase()->prepare($sql);

		if($stmt->execute()) {
	
			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		} else {

			print_r($stmt -> errorInfo());

		}		
		
		$stmt = null;
	
	}

}