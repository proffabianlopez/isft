<?php 
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql

class StudentModel extends UserModel {

	static public function newStudent($value1, $value2, $value3, $value4, $value5, $value6,$value7)
    {
        $sql = "INSERT INTO users (name, last_name, email, dni, startingYear, file, password, 
                                fk_gender_id, fk_carrer_id, fk_rol_id, state)
                                VALUES (:name, :lastName, :email, :dni, :dateYear, null, null, :gender, :carrer, 3, 2)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $value2, PDO::PARAM_STR);
        $stmt->bindParam(':email', $value3, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $value4, PDO::PARAM_STR);
        $stmt->bindParam(':dateYear', $value5, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $value6, PDO::PARAM_INT);
        $stmt->bindParam(':carrer', $value7, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }
    }

    static public function getAllStudent(){
        $sql="SELECT
        users.id_user As id_user,
        users.name AS name_student,
        users.last_name AS last_name_student,
        users.email AS email_student,
        users.dni AS dni,
        users.fk_rol_id AS fk_rol_id,
        carrers.carrer_name AS carrers,
        carrers.carrer_name AS carrer_name
        FROM users
        JOIN carrers ON users.fk_carrer_id=carrers.id_carrer
        WHERE users.fk_rol_id=3;";

            $stmt = model_sql::connectToDatabase()->prepare($sql);

                if($stmt->execute()) {

                     return $stmt->fetchAll(PDO::FETCH_ASSOC);

                } else {

                    print_r($stmt -> errorInfo());

                    }		

                $stmt = null;

    }

}

