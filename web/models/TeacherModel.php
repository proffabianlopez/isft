<?php
include_once 'config/MysqlDb.php';
class TeacherModel extends UserModel {
    static public function newTeacher($value1, $value2, $value3, $value4, $value5)
    {
        $sql = "INSERT INTO users (name, last_name, email, dni, startingYear, file, password, 
                                fk_gender_id, fk_carrer_id, fk_rol_id, state)
                                VALUES (:name, :lastName, :email, :dni, null, null, null, :gender, null, 4, 2)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $value2, PDO::PARAM_STR);
        $stmt->bindParam(':email', $value3, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $value4, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $value5, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }
    }
}
?>