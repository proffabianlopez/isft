<?php
include_once '../config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql
class UserModel
{
    static public function login($email, $password)
    {
        $query = "SELECT id_user, email, dni, password, /*changepassword,*/ fk_rol_id, state 
                  FROM users WHERE email = :email"; // Corregí el error en la consulta SQL

        $statement = model_sql::connectToDatabase()->prepare($query); // Obtener la conexión a la base de datos
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            if ($password == $row['password']) {
                return $row;
            }
        }

        return false;
    }
}
