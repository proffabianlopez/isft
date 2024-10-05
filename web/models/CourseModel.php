<?php
class CourseModel{

    //nos traera el fk de id_assignamente student para meterlo en cursadas
//     static public function id_assignamentStudent($id_subject, $id_student)
// {
//     $sql = "SELECT 
//                 asignament_students.id AS id,
//                 asignament_students.fk_user_id,
//                 asignament_students.fk_subject_id
//             FROM 
//                 asignament_students
//             WHERE 
//                 asignament_students.fk_user_id = :fk_student_id
//                 AND asignament_students.fk_subject_id = :fk_subject_id";
    
//     $stmt = model_sql::connectToDatabase()->prepare($sql);
//     $stmt->bindParam(':fk_student_id', $id_student, PDO::PARAM_INT);
//     $stmt->bindParam(':fk_subject_id', $id_subject, PDO::PARAM_INT);

//     if ($stmt->execute()) {
//         return $stmt->fetch(PDO::FETCH_ASSOC); 
//     } else {
//         print_r($stmt->errorInfo());
//         return null; 
//     }
// }


    //inserta en automatico cuando se agregue la asignacion del alumno y materia
static public function insertCourseStudent($id,$cycle_year)
{
    $sql = "INSERT INTO cursada(id_asignementStudent,cycle_year,state) VALUES (:id , :cycle_year, 1)";
    $stmt = model_sql::connectToDatabase()->prepare($sql);

    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":cycle_year", $cycle_year, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
    $stmt = null; // Liberar el statement
}


}
?>