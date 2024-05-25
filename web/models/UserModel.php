<?php
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql
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

    static public function dataUser($id){
        $sql = "SELECT
                 users.id_user AS id_user,
                 users.name AS name_user,
                 users.last_name AS last_name_user,
                 users.email AS email,
                 users.dni AS dni,
                 users.file AS file,
                 users.password AS password,
                 users.fk_gender_id AS id_gender,
                 genders.details AS gender_detail,
                 users.fk_carrer_id AS id_carrer,
                 carrers.carrer_name AS carrer_name,
                 users.fk_rol_id AS id_rol,
                 roles.name AS name_rol
             FROM 
                 users
             JOIN 
                 genders ON users.fk_gender_id = genders.id_gender
             JOIN 
                 carrers ON users.fk_carrer_id = carrers.id_carrer
             JOIN 
                 roles ON users.fk_rol_id = roles.id_rol
             WHERE 
                 users.id_user = ?";
        // Assuming you are using PDO for the prepared statement
        $stmt = model_sql::connectToDatabase()->prepare($sql);;
        $stmt->bindParam(1,$id, PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            print_r($stm->errorInfo());
        }

        $stmt=null;
    }
    
 
}
