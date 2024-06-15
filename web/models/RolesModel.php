<?php
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql

class RolesModel
{

	static public function roles()
	{
		$sql = ' 
		SELECT roles.id_rol AS "id_rol",
			roles.name AS "name"
		FROM roles 
		WHERE id_rol = 1 OR id_rol = 2;
		';
		$stmt = model_sql::connectToDatabase()->prepare($sql);

		if ($stmt->execute()) {
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			print_r($stmt->errorInfo());
		}

		$stmt = null;
	}

	static public function allRoles()
	{
		$sql = ' 
		SELECT roles.id_rol AS "id_rol",
			roles.name AS "name"
		FROM roles 
		';
		$stmt = model_sql::connectToDatabase()->prepare($sql);

		if ($stmt->execute()) {
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			print_r($stmt->errorInfo());
		}

		$stmt = null;
	}
}
