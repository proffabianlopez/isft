<?php include_once 'config/MysqlDb.php';

class CorrelativeModel
{
    static public function showSubjectCorrelative($id)
    {
        $sql = " SELECT subjects.id_subject  AS id_subject,
       subjects.name_subject AS name_subject
        FROM subjects
        JOIN careers ON subjects.fk_career_id = careers.id_career
        WHERE careers.id_career = ? ";

        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static public function newCorrelative($value1, $value2)
    {
        $sql = "INSERT INTO correlatives (fk_correlative_id, fk_subject_id, state)
            VALUES (:id_correlative, :id_subject, 1)";
        $pdo = model_sql::connectToDatabase(); // Obtener la conexión PDO
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_correlative', $value1, PDO::PARAM_INT);
        $stmt->bindParam(':id_subject', $value2, PDO::PARAM_INT);

        $success = $stmt->execute(); // Ejecutar la consulta de inserción

        if ($success) {
            // Obtener el ID generado después de la inserción
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
    }

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
    c1.id_subject = ?
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
}
