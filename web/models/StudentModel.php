<?php
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql
//crea un nuevo estudiante
class StudentModel extends UserModel
{

    static public function newStudent($value1, $value2, $value3, $value4, $value5, $value6)
{
    $sql = "INSERT INTO users (name, last_name, email, dni, startingYear, file, password, 
                            fk_gender_id, fk_rol_id, state)
                            VALUES (:name, :lastName, :email, :dni, :dateYear, null, null, :gender, 3, 2)";

    $pdo = model_sql::connectToDatabase(); // Obtener la conexión PDO
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
    $stmt->bindParam(':lastName', $value2, PDO::PARAM_STR);
    $stmt->bindParam(':email', $value3, PDO::PARAM_STR);
    $stmt->bindParam(':dni', $value4, PDO::PARAM_STR);
    $stmt->bindParam(':dateYear', $value5, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $value6, PDO::PARAM_INT);

    $success = $stmt->execute(); // Ejecutar la consulta de inserción

    if ($success) {
        $lastInsertedId = $pdo->lastInsertId();
        return $lastInsertedId; // Devolver el ID generado
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}
    // trae los datos de los estudiantes de la tabla career person
    static public function getAllStudent()
    {
        $sql = "SELECT
        users.id_user As id_student,
        users.name AS name_student,
        users.last_name AS last_name_student,
        users.email AS email_student,
        users.dni AS dni,
        users.file AS legajo,
        users.startingYear AS startingYear,
        users.fk_rol_id AS fk_rol_id,
		careers.career_name AS career_name,
        careers.id_career AS  id_career,
        career_person.id_career_person AS id_career_person
        FROM career_person
		JOIN careers ON career_person.fk_career_id=careers.id_career
        JOIN users ON career_person.fk_user_id= users.id_user
        WHERE 
        users.fk_rol_id = 3
        AND users.state IN (1, 2)";

        $stmt = model_sql::connectToDatabase()->prepare($sql);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    //trae solo los datos de los alumnos que administra el preceptor
    static public function getAllStudentCareerPreceptor($id)
    {
        $sql = "SELECT
                    users.id_user As id_student,
                    users.name AS name_student,
                    users.last_name AS last_name_student,
                    users.email AS email_student,
                    users.dni AS dni,
                    users.file AS legajo,
                    users.fk_rol_id AS fk_rol_id,
                    users.startingYear AS startingYear,
                    careers.career_name AS career_name,
                    careers.id_career AS  id_career,
                                        career_person.id_career_person AS id_career_person
                    FROM career_person
                            JOIN careers ON career_person.fk_career_id=careers.id_career
                            JOIN users ON career_person.fk_user_id= users.id_user
                            WHERE 
                            users.fk_rol_id = 3 and careers.id_career=?
                            AND users.state IN (1, 2)
                    ";

                    $stmt = model_sql::connectToDatabase()->prepare($sql);
                    $stmt->bindParam(1, $id, PDO::PARAM_INT);


                    if ($stmt->execute()) {

                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {

                        print_r($stmt->errorInfo());
                    }

                    $stmt = null;
    }

    //era como para borrar al estudiante
    static public function updateStudentState($id)
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

    //actualiza la informacion del estudiante
    static public function updateStudentData($name, $last_name, $id_student)
    {
        $sql = "UPDATE users SET name = :name, last_name = :last_name WHERE id_user = :id_student";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT);

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

    //es para que el estudiante tenga estado 1 y pueda entrar como usuario
    static public function changeStateStudent($id)
    {
        $sql = "UPDATE users SET state = 1 WHERE id_user = ?";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {

            return true;
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
        $stmt = null;
    }



    //es para actualizar o asignar legajo al alumno
    static public function updateLegajo($file,$id)
    {
        $sql = "UPDATE users SET file = :legajo WHERE id_user = :id_student";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':legajo', $file, PDO::PARAM_STR);
        $stmt->bindParam(':id_student', $id, PDO::PARAM_INT);

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
