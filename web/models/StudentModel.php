<?php
class StudentModel extends UserModel
{

    static public function newStudent($value1, $value2, $value3, $value4, $value5, $value6, $value7)
    {
        $sql = "INSERT INTO users (name, last_name, email, dni, startingYear, file, password, 
                            fk_gender_id, fk_rol_id, state, phone_contact)
                            VALUES (:name, :lastName, :email, :dni, :dateYear, null, null, :gender, 3,2, :tel)";

        $pdo = model_sql::connectToDatabase(); // Obtener la conexión PDO
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $value2, PDO::PARAM_STR);
        $stmt->bindParam(':email', $value3, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $value4, PDO::PARAM_STR);
        $stmt->bindParam(':dateYear', $value5, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $value6, PDO::PARAM_INT);
        $stmt->bindParam(':tel', $value7, PDO::PARAM_STR);

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
        users.phone_contact AS phone_contact,
        users.fk_rol_id AS fk_rol_id,
		careers.career_name AS career_name,
        careers.id_career AS  id_career,
        career_person.id_career_person AS id_career_person
        FROM career_person
		JOIN careers ON career_person.fk_career_id=careers.id_career
        JOIN users ON career_person.fk_user_id= users.id_user
        WHERE 
        users.fk_rol_id = 3
        AND users.state IN (1,2)";

        $stmt = model_sql::connectToDatabase()->prepare($sql);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    //servira para extraer la carrera del estudiante y ponerlo de asunto en el correo
    static public function studentDataCarrer($id_user)
    {
        $sql = "SELECT careers.career_name AS name_c,
                       career_person.fk_user_id AS id_user
                FROM career_person
                JOIN careers ON career_person.fk_career_id = careers.id_career
                WHERE career_person.fk_user_id = ?";
    
       
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id_user, PDO::PARAM_INT); 
    
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
    static public function updateStudentData($name, $last_name, $id_student, $dni, $date, $telephone)
    {
        $sql = "UPDATE users SET name = :name, last_name = :last_name, dni = :dni, startingYear = :date, phone_contact = :tel WHERE id_user = :id_student";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT);
        $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $telephone, PDO::PARAM_STR);

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
    static public function updateLegajo($file, $id)
    {
        // Conectar a la base de datos
        $pdo = model_sql::connectToDatabase();

        // Consulta para verificar si el legajo ya existe
        $sql_check = 'SELECT COUNT(*) FROM users WHERE file = :legajo AND id_user != :id_student';
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->bindParam(':legajo', $file, PDO::PARAM_STR);
        $stmt_check->bindParam(':id_student', $id, PDO::PARAM_INT);
        $stmt_check->execute();
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            // El legajo ya existe para otro usuario
            return false;
        } else {
            // Consulta para actualizar el legajo del alumno
            $sql_update = "UPDATE users SET file = :legajo WHERE id_user = :id_student";
            $stmt_update = $pdo->prepare($sql_update);
            $stmt_update->bindParam(':legajo', $file, PDO::PARAM_STR);
            $stmt_update->bindParam(':id_student', $id, PDO::PARAM_INT);

            if ($stmt_update->execute()) {
                // Devolver true si la actualización se realiza correctamente
                return true;
            } else {
                // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
                print_r($stmt_update->errorInfo());
                return false; // Devolver false en caso de error
            }
        }
    }


    static public function careerStudent($ids_students)
    {
        if (empty($ids_students) || !is_array($ids_students)) {
            return []; 
        }
    
        $ids_students = array_map('intval', $ids_students); 
        $ids_list_student = implode(',', $ids_students);
    
        $sql = "
            SELECT careers.id_career AS career,
                   users.id_user AS id_student,  /* Cambié el alias a id_student */
                   users.name AS name,
                   users.startingYear AS yearActual
            FROM career_person
            INNER JOIN careers ON career_person.fk_career_id = careers.id_career
            INNER JOIN users ON career_person.fk_user_id = users.id_user
            WHERE career_person.fk_user_id IN ($ids_list_student)
        ";
    
        try {
            $pdo = model_sql::connectToDatabase();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $career = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // error_log("Carreras asociadas a los IDs de estudiantes: " . print_r($career, true));
    
            return $career; 
    
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return []; 
        }
    }
    

    static public function careerSubject($ids)
{
    if (empty($ids) || !is_array($ids)) {
        return []; 
    }

   
    $ids = array_map('intval', $ids); 
    $ids_list = implode(',', $ids);

   
    $sql = "SELECT careers.id_career AS career,
                   careers.career_name AS name,
                   subjects.name_subject AS subject,
                   subjects.fk_year_subject AS yearSubject,
                   subjects.id_subject AS id_subject
            FROM subjects
            INNER JOIN careers ON subjects.fk_career_id = careers.id_career
            WHERE careers.id_career IN ($ids_list)
            AND subjects.fk_year_subject = 1";

    try {
        $pdo = model_sql::connectToDatabase();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $subject = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        // echo "<pre>";
        // print_r($subject);
        // echo "</pre>";

        // error_log("Carreras asociadas a los IDs de estudiantes: " . print_r($subject, true));

        return $subject; 

    } catch (PDOException $e) {
        // error_log("Error en la consulta: " . $e->getMessage());
        return []; 
    }
}
static public function assignSubjectsToStudents($students, $subjectsByCareer)
{
    if (empty($students) || empty($subjectsByCareer)) {
        return false;
    }

    $pdo = model_sql::connectToDatabase();
    $anyAssigned = false; // Variable para rastrear si se realizó alguna asignación
    $insertedIds = []; // Array para almacenar los IDs insertados

    try {
        $pdo->beginTransaction();

        foreach ($students as $student) {
            $studentId = $student['id_student'];  
            $careerId = $student['career'];

            if (!isset($subjectsByCareer[$careerId])) {
                continue;
            }

            foreach ($subjectsByCareer[$careerId] as $subject) {
                $sqlCheck = "SELECT COUNT(*) FROM asignament_students 
                             WHERE fk_user_id = :studentId 
                             AND fk_subject_id = :subjectId";
                $stmtCheck = $pdo->prepare($sqlCheck);
                $stmtCheck->bindParam(':studentId', $studentId, PDO::PARAM_INT);
                $stmtCheck->bindParam(':subjectId', $subject['id_subject'], PDO::PARAM_INT);
                $stmtCheck->execute();
                $exists = $stmtCheck->fetchColumn();

                if ($exists == 0) {
                    $sqlInsert = "INSERT INTO asignament_students (fk_user_id, fk_subject_id, state) 
                                  VALUES (:studentId, :subjectId, 1)";
                    $stmtInsert = $pdo->prepare($sqlInsert);
                    $stmtInsert->bindParam(':studentId', $studentId, PDO::PARAM_INT);
                    $stmtInsert->bindParam(':subjectId', $subject['id_subject'], PDO::PARAM_INT);
                    $stmtInsert->execute();
                    
                    // Recuperar el ID insertado
                    $lastInsertId = $pdo->lastInsertId();
                    $insertedIds[] = $lastInsertId; // Almacenar el ID insertado

                    $anyAssigned = true; // Se realizó al menos una asignación
                }
            }
        }

        $pdo->commit();
        return ['anyAssigned' => $anyAssigned, 'insertedIds' => $insertedIds]; // Retornar los IDs insertados
    } catch (PDOException $e) {
        $pdo->rollBack();
        // error_log("Error al insertar materias: " . $e->getMessage());
        return false;
    }
}


}
