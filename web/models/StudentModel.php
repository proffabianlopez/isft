<?php 
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql

class StudentModel extends UserModel {

	static public function newStudent($value1, $value2, $value3, $value4, $value5, $value6)
    {
        $sql = "INSERT INTO users (name, last_name, email, dni, startingYear, file, password, 
                                fk_gender_id, fk_carrer_id, fk_rol_id, state)
                                VALUES (:name, :lastName, :email, :dni, :dateYear, null, null, :gender, null, 3, 0)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $value2, PDO::PARAM_STR);
        $stmt->bindParam(':email', $value3, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $value4, PDO::PARAM_STR);
        $stmt->bindParam(':dateYear', $value5, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $value6, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }
    }

}