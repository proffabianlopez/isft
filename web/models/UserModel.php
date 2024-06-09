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
                 users.change_password  AS change_password, 
                 users.fk_gender_id AS id_gender,
                 users.state AS state,
                 genders.details AS gender_detail,
                 users.fk_carrer_id AS id_carrer,
                 IFNULL(careers.career_name, 'CARRERA NO ASIGNADA') AS career_name,
                 users.fk_rol_id AS id_rol,
                 roles.name AS name_rol
             FROM 
                 users
             JOIN 
                 genders ON users.fk_gender_id = genders.id_gender
             LEFT JOIN 
                 careers ON users.fk_carrer_id = careers.id_career
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

    static public function updateData($newName, $newLastName, $newEmail, $newDni, $id)
    {

        $sql = "UPDATE users SET name = ?,last_name=?,email=?,dni=? WHERE id_user = ?";

        $stmt = model_sql::connectToDatabase()->prepare($sql);



        $stmt->bindParam(1, $newName, PDO::PARAM_STR);
        $stmt->bindParam(2, $newLastName, PDO::PARAM_STR);
        $stmt->bindParam(3, $newEmail, PDO::PARAM_STR);
        $stmt->bindParam(4, $newDni, PDO::PARAM_STR);
        $stmt->bindParam(5, $id, PDO::PARAM_INT);

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


    static public function newUser($value1, $value2, $value3, $value4, $value5, $value6, $value7)
    {
        $sql = "INSERT INTO users (name, last_name, email, dni, startingYear, file, password, 
                                fk_gender_id, fk_carrer_id, fk_rol_id, state)
                                VALUES (:name, :lastName, :email, :dni, NULL, NULL, :password, :gender, null, :fk_rol_id, 1)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $value2, PDO::PARAM_STR);
        $stmt->bindParam(':email', $value3, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $value4, PDO::PARAM_STR);
        $stmt->bindParam(':password', $value5, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $value6, PDO::PARAM_INT);
        $stmt->bindParam(':fk_rol_id', $value7, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }
    }



    static  public function checkForDuplicates($value1, $value2)
    {
        try {
            // Verificar si ya existe un registro con el mismo DNI o correo electrónico
            $checkQuery = "SELECT COUNT(*) FROM users WHERE dni = ? OR email = ? ";
            $checkStatement = model_sql::connectToDatabase()->prepare($checkQuery);
            $checkStatement->bindParam(1, $value1, PDO::PARAM_STR);
            $checkStatement->bindParam(2, $value2, PDO::PARAM_STR);
            $checkStatement->execute();

            $count = $checkStatement->fetchColumn();

            if ($count > 0) {


                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo "Error en la validación de duplicados: " . $e->getMessage();
            return false;
        }
    }

    static  public function checkForDuplicatesEmail($id, $email)
    {
        try {
            // Verificar si ya existe un registro con el mismo DNI o correo electrónico
            $checkQuery = "SELECT COUNT(*) FROM users WHERE email = ? AND id_user <> ?";
            $checkStatement = model_sql::connectToDatabase()->prepare($checkQuery);
            $checkStatement->bindParam(1, $email, PDO::PARAM_STR);
            $checkStatement->bindParam(2, $id, PDO::PARAM_INT);
            $checkStatement->execute();

            $count = $checkStatement->fetchColumn();

            if ($count > 0) {


                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo "Error en la validación de duplicados: " . $e->getMessage();
            return false;
        }
    }

    static public function getFirstValidCredential()
    {
        $sql = "SELECT email,token FROM credential_email";
        $stmt = model_sql::connectToDatabase()->prepare($sql);

        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }
    }

    static public function getAllUser()
    {
        $sql = "SELECT
        users.id_user AS id_user,
        users.name AS name,
        users.last_name AS last_name,
        users.email AS email,
        users.fk_rol_id AS fk_rol_id,
        roles.name AS name_rol,
        users.state AS state
    FROM
        users
    JOIN
        roles ON users.fk_rol_id = roles.id_rol
    WHERE
        (users.state = 1 OR (users.state = 2 AND users.fk_rol_id <> 3 AND users.fk_rol_id <> 4))";

        $stmt = model_sql::connectToDatabase()->prepare($sql);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }
    static public function updateUserState($id)
    {
        $sql = "UPDATE users SET state = 0 WHERE id_user = ?";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // Devolver true si la actualización se realiza correctamente
            return true;
        } else {
            // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
            print_r($stmt->errorInfo());
            return false; // Devolver false en caso de error
        }
        $stmt = null;
    }

    static public function disableUser($id)
    {
        $sql = "UPDATE users SET state = 2 WHERE id_user = ?";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // Devolver true si la actualización se realiza correctamente
            return true;
        } else {
            // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
            print_r($stmt->errorInfo());
            return false; // Devolver false en caso de error
        }
        $stmt = null;
    }

    static public function activateUser($id)
    {
        $sql = "UPDATE users SET state = 1 WHERE id_user = ?";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // Devolver true si la actualización se realiza correctamente
            return true;
        } else {
            // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
            print_r($stmt->errorInfo());
            return false; // Devolver false en caso de error
        }
        $stmt = null;
    }

    static public function updateUserData($name, $last_name, $email, $fk_rol_id, $id_user)
    {
        $sql = "UPDATE users SET name  = :name,last_name=:last_name,email=:email,fk_rol_id=:fk_id WHERE id_user = :id_user";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':fk_id', $fk_rol_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Devolver true si la actualización se realiza correctamente
            return true;
        } else {
            // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
            print_r($stmt->errorInfo());
            return false; // Devolver false en caso de error
        }
        $stmt = null;
    }

    static public function updateChangedPassword($id)
    {
        $sql = "UPDATE users SET change_password = 0 WHERE id_user = ?";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // Devolver true si la actualización se realiza correctamente
            return true;
        } else {
            // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
            print_r($stmt->errorInfo());
            return false; // Devolver false en caso de error
        }
        $stmt = null;
    }

    static public function updateNewPassword($password, $id)
    {
        $sql = "UPDATE users SET password = ? WHERE id_user = ?";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $password, PDO::PARAM_STR);
        $stmt->bindParam(2, $id, PDO::PARAM_INT); // Enlaza el segundo parámetro correctamente
        if ($stmt->execute()) {
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
