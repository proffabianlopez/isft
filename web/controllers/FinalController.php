<?php
class FinalController
{
    static public function getAllFinal($id_carrer)
    {
        return FinalModel::showFinal($id_carrer);
    }

    static public function getAllSubjectFinal($id)
    {
        return FinalModel::showSubjectFinal($id);

    }

    static public function newFinal($id_teacher_vocal, $id_subject, $first_date, $second_date)
    {
        $id_teacher_vocal = empty($id_teacher_vocal) ? NULL : trim($id_teacher_vocal);
        $second_date = empty($second_date) ? NULL : trim($second_date);


        if (empty($id_subject) || empty($first_date)) {
            $response["status"] = "error";
            $response["message"] = "Debes completar los campos";
            return $response;
        }
        if (strtotime($second_date) <= strtotime($first_date)  && !empty($second_date)) {
            $response["status"] = "error";
            $response["message"] = "La 2da fecha no puede ser inferior o igual a la 1ra fecha.";
            return $response;
        }

        $verificTeacher = FinalModel::subjectverificTeacher($id_subject);

        $is_open_final = FinalModel::isOpenFinal($verificTeacher);
        if ($is_open_final['is_open'] == 1) {
            $response["status"] = "error";
            $response["message"] = "Ya existe una Mesa de Final abierta con esa Materia ";
            return $response;
        }
        $duplicateTeacher = FinalModel::isDuplicateTeacher($verificTeacher);
        if ($duplicateTeacher['id_teacher'] == $id_teacher_vocal) {
            $response["status"] = "error";
            $response["message"] = "El profesor es titular de la materia ";
            return $response;
        }

        $verificTeacherFinal = FinalModel::verificDate($id_teacher_vocal, $verificTeacher, $first_date, $second_date);

        if (!empty($verificTeacherFinal)) {
            $response["status"] = "error";
            $response["message"] = ""; // Inicializar para concatenar mensajes

            // Variables para evitar mensajes duplicados
            $asignamentTeacherMessageAdded = false;
            $asignamentTeacherMessageAdded1 = false;
            $firstDateMessageAdded = false;
            $secondDateMessageAdded = false;
            foreach ($verificTeacherFinal as $teacher) {
                if (!$asignamentTeacherMessageAdded && $teacher['vocal_id'] == $id_teacher_vocal) {
                    $response["message"] .= "El/la profesor/a " . $teacher['Vocal'] . " ya es Acompañante en la materia " . $teacher['name_subject'] . ". ";
                    $asignamentTeacherMessageAdded = true; // Marcar que el mensaje ya se agregó
                    if (!$firstDateMessageAdded && $teacher['date_final1'] == $first_date) {
                        $response["message"] .= "En la fecha: " . $first_date . ". ";
                    }

                    if (!$secondDateMessageAdded && $teacher['date_final2'] == $second_date) {
                        $response["message"] .= "En la fecha: " . $second_date . ".<br> ";

                    }
                }
                if (!$asignamentTeacherMessageAdded1 && $teacher['asignado_id'] == $id_teacher_vocal) {
                    $response["message"] .= "El/la profesor/a " . $teacher['Asignado'] . " ya fue asignado a la materia " . $teacher['name_subject'] . ". ";
                    $asignamentTeacherMessageAdded1 = true; // Marcar que el mensaje ya se agregó
                    if (!$firstDateMessageAdded && $teacher['date_final1'] == $first_date) {
                        $response["message"] .= "En la fecha: " . $first_date . ". ";
                    }

                    if (!$secondDateMessageAdded && $teacher['date_final2'] == $second_date) {
                        $response["message"] .= "En la fecha: " . $second_date . ".<br> ";

                    }
                }

            }
            return $response;
        }

        if (!empty($verificTeacherFinal)) {
            $response["status"] = "error";
            $response["message"] = "Ya hay un examen cargado";
            return $response;
        }

        $final = FinalModel::setNewFinal($id_teacher_vocal, $verificTeacher, $first_date, $second_date);

        if ($final) {
            $response["status"] = "successReset";
            $response["title"] = "Exito";
            $response["message"] = "Se cargó exitosamente la mesa de examen";
            return $response;
        } else {
            $response["status"] = "error";
            $response["message"] = "Carga fallida";
            return $response;
        }
    }

    static public function closeExamTable($id_exam_table){

        $verifyIsClose = FinalModel::verifyIsOpenOrClose($id_exam_table);

        if ($verifyIsClose['is_open'] == 0) {
            $response["status"] = "error";
            $response["message"] = "La mesa de examen ya se encuentra cerrada";
            return $response;
        }

        $execute = FinalModel::CloseExam($id_exam_table);
        if ($execute) {
            $response["status"] = "successLoad";
            $response["title"] = "Exito";
            $response["message"] = "Se cerró exitosamente la mesa de examen";
            return $response;
        } else {
            $response["status"] = "error";
            $response["message"] = "Carga fallida";
            return $response;
        }

    }

}
