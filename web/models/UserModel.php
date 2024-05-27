<?php
include_once 'config/MysqlDb.php';
class UserModel
{
    static public function login($email, $password)
    {
        $query = "SELECT id_user, email, dni, password, change_password, fk_rol_id, state 
              FROM users WHERE email = :email";

        $statement = model_sql::connectToDatabase()->prepare($query);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if (password_verify($password, $row['password'])) {
                return $row;
            }
        }

        return false;
    }

    static public function dataUser($id)
    {
        $sql = "SELECT
                 users.id_user AS id_user,
                 users.name AS name_user,
                 users.last_name AS last_name_user,
                 users.email AS email,
                 users.dni AS dni,
                 users.file AS file,
                 users.password AS password,
                 users.fk_gender_id AS id_gender,
                 users.state AS state,
                 genders.details AS gender_detail,
                 users.fk_carrer_id AS id_carrer,
                 IFNULL(carrers.carrer_name, 'CARRERA NO ASIGNADA') AS carrer_name,
                 users.fk_rol_id AS id_rol,
                 roles.name AS name_rol
             FROM 
                 users
             JOIN 
                 genders ON users.fk_gender_id = genders.id_gender
             LEFT JOIN 
                 carrers ON users.fk_carrer_id = carrers.id_carrer
             JOIN 
                 roles ON users.fk_rol_id = roles.id_rol
             WHERE 
                 users.id_user = ?";
        // Assuming you are using PDO for the prepared statement
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }


    static public function newStudent($value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8)
    {
        $sql = "INSERT INTO users (name, last_name, email, dni, startingYear, file, password, 
                                fk_gender_id, fk_carrer_id, fk_rol_id, state)
                                VALUES (:name, :lastName, :email, :dni, :dateYear, :fileNumber, :password, :gender, null, 3, 1)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $value2, PDO::PARAM_STR);
        $stmt->bindParam(':email', $value3, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $value4, PDO::PARAM_STR);
        $stmt->bindParam(':dateYear', $value5, PDO::PARAM_STR);
        $stmt->bindParam(':fileNumber', $value6, PDO::PARAM_STR);
        $stmt->bindParam(':password', $value7, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $value8, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }
    }




    static public function getPassword($id)
    {
        $sql = "Select users.password as password From users
              Where id_user=?";

        $stmt = model_sql::connectToDatabase()->prepare($sql);;
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static public function updatePassword($id, $newPassword)
    {

        $sql = "UPDATE users SET password = ? WHERE id_user = ?";

        // Preparar la sentencia
        $stmt = model_sql::connectToDatabase()->prepare($sql);


        $stmt->bindParam(1, $newPassword, PDO::PARAM_STR);
        $stmt->bindParam(2, $id, PDO::PARAM_INT);


        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static public function updateMail($id, $newMail)
    {

        $sql = "UPDATE users SET email = ? WHERE id_user = ?";

        $stmt = model_sql::connectToDatabase()->prepare($sql);


        $stmt->bindParam(1, $newMail, PDO::PARAM_STR);
        $stmt->bindParam(2, $id, PDO::PARAM_INT);


        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static public function changePasswordStart($id, $newPassword)
    {
        $sql = "UPDATE users SET password = ?, change_password = 1 WHERE id_user = ?";

        $stmt = model_sql::connectToDatabase()->prepare($sql);


        $stmt->bindParam(1, $newPassword, PDO::PARAM_STR);
        $stmt->bindParam(2, $id, PDO::PARAM_INT);


        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static public function newAdmin($value1, $value2, $value3, $value4, $value5, $value6)
    {
        $sql = "INSERT INTO users (name, last_name, email, dni, startingYear, file, password, 
                                fk_gender_id, fk_carrer_id, fk_rol_id, state)
                                VALUES (:name, :lastName, :email, :dni, NULL, NULL, :password, :gender, null, 3, 1)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $value2, PDO::PARAM_STR);
        $stmt->bindParam(':email', $value3, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $value4, PDO::PARAM_STR);
        $stmt->bindParam(':password', $value5, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $value6, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }
    }
}
