<?php include_once 'config/MysqlDb.php';

class CorrelativeModel
{
    //Esta es para mostrar las materias en forma de select
    static public function showSubjectCorrelative($id)
    {
        $sql = " SELECT subjects.id_subject  AS id_subject,
       subjects.name_subject AS name_subject
        FROM subjects
        JOIN careers ON subjects.fk_career_id = careers.id_career
        WHERE careers.id_career = ?  AND subjects.state=1";

        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    //Inserta los ID de materia y correlativa en la tabla correlatives
    //También verifica si ya se registró la correlativa y sino la inserta
    static public function addSubjectCorrelative($subject_id_1, $subject_id_2)
    {
        // Conexión a la base de datos
        $pdo = model_sql::connectToDatabase();

        try {
            // Verificar si la relación inversa ya existe
            $query = "
            SELECT COUNT(*) AS count
            FROM correlatives
            WHERE (fk_subject_id = :subject_id_1 AND fk_correlative_id = :subject_id_2)
               OR (fk_subject_id = :subject_id_2 AND fk_correlative_id = :subject_id_1)
        ";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':subject_id_1', $subject_id_1, PDO::PARAM_INT);
            $stmt->bindParam(':subject_id_2', $subject_id_2, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count == 0) {
                // Si no existe la relación inversa, insertar la nueva relación
                $insert_query = "
                INSERT INTO correlatives (fk_subject_id, fk_correlative_id, state)
                VALUES (:subject_id_1, :subject_id_2, 'active')
            ";
                $insert_stmt = $pdo->prepare($insert_query);
                $insert_stmt->bindParam(':subject_id_1', $subject_id_1, PDO::PARAM_INT);
                $insert_stmt->bindParam(':subject_id_2', $subject_id_2, PDO::PARAM_INT);

                if ($insert_stmt->execute()) {
                    return "La relación se ha insertado correctamente.";
                } else {
                    return "Error al insertar la relación.";
                }
            } else {
                return "La relación inversa ya existe. No se puede insertar.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return "Error en la base de datos.";
        } finally {
            $stmt = null;
            $insert_stmt = null;
        }
    }


    //Esta sólo muestra los datos uno abajo del otro y asi poder editar
    // las correlativas más adelante.
    static public function showDataCorrelative($id)
    {
        $sql = "SELECT 
                correlatives.id_correlative AS id_correlative,
                c1.id_subject AS id_correlative_subject,
                c1.name_subject AS name_correlative_subject,
                c2.id_subject AS id_subject,
                c2.name_subject AS name_subject
            FROM 
                correlatives
            JOIN 
                subjects AS c1 ON correlatives.fk_correlative_id = c1.id_subject
            JOIN 
                subjects AS c2 ON correlatives.fk_subject_id = c2.id_subject
            JOIN 
                careers ON c1.fk_career_id = careers.id_career
            WHERE 
                careers.id_career = ?";

        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null; // Cierra la declaración

            return $result;
        } else {
            print_r($stmt->errorInfo());
            $stmt = null; // Asegúrate de cerrar la declaración en caso de error

            return false;
        }
    }

    //Esta función muestra todas las correlativas de la materia una al lado de la otra
    // separada por guión y concatenadas.
    static public function showMultipleCorrelatives($id)
    {
        $sql = "SELECT 
    c1.id_subject AS id_subject,
    c1.name_subject AS name_subject,
    GROUP_CONCAT(c2.name_subject ORDER BY c2.name_subject SEPARATOR ' - ') AS correlatives
FROM 
    correlatives
JOIN 
    subjects AS c1 ON correlatives.fk_subject_id = c1.id_subject
JOIN 
    subjects AS c2 ON correlatives.fk_correlative_id = c2.id_subject
JOIN 
    careers ON c1.fk_career_id = careers.id_career
WHERE 
    c1.fk_career_id = ?
GROUP BY
    c1.id_subject
"; // Corregir aquí el alias de la tabla subjects

        $pdo = model_sql::connectToDatabase();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null; // Cierra la declaración

            return $result;
        } else {
            print_r($stmt->errorInfo());
            $stmt = null; // Asegúrate de cerrar la declaración en caso de error

            return false;
        }
    }

    //Esta es para editar los ID de la tabla correlativas
    static public function editCorrelative($id_subject, $id_correlative, $id)
    {
        $sql = "UPDATE correlatives
            SET fk_subject_id = :new_fk_subject_id,
                fk_correlative_id = :new_fk_correlative_id
            WHERE id_correlative = :id_correlative_pivot";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':new_fk_subject_id', $id_subject, PDO::PARAM_INT);
        $stmt->bindParam(':new_fk_correlative_id', $id_correlative, PDO::PARAM_INT); // corregido
        $stmt->bindParam(':id_correlative_pivot', $id, PDO::PARAM_INT); // corregido

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

    //Elimina el campo de la tabla correlativas
    static public function deleteCorrelative($id_correlative)
    {
        $sql = "DELETE FROM correlatives WHERE id_correlative = :id_correlative";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':id_correlative', $id_correlative, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true; // Devolver true si la eliminación se realiza correctamente
        } else {
            // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
            print_r($stmt->errorInfo());
            return false; // Devolver false en caso de error
        }
        $stmt = null;
    }
}
