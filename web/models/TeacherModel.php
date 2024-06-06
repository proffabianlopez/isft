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

    static public function getAllTeachers(){
        $sql="SELECT
        users.id_user As id_teacher,
        users.name AS name_teacher,
        users.last_name AS last_name_teacher,
        users.email AS email_teacher,
        users.dni AS dni,
        users.fk_rol_id AS fk_rol_id
        FROM users
        WHERE 
        users.fk_rol_id = 4
        AND users.state IN (1, 2)";

            $stmt = model_sql::connectToDatabase()->prepare($sql);

                if($stmt->execute()) {

                     return $stmt->fetchAll(PDO::FETCH_ASSOC);

                } else {

                    print_r($stmt -> errorInfo());

                    }		

                $stmt = null;

    }

    static public function updateTeacherData($name, $last_name, $email, $id_teacher){
        $sql = "UPDATE users SET name = :name, last_name = :last_name, email = :email WHERE id_user = :id_teacher";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT);
    
        if($stmt->execute()) {		 
            // Devolver true si la actualización se realiza correctamente
            return true;
        } else { 
            // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
            print_r($stmt->errorInfo());
            return false; // Devolver false en caso de error
        }		
        $stmt = null;
    }

}
?>