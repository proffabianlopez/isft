<?php

class FinalController
{

    static public function getAllSubjectFinal($id){
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
        if (strtotime($second_date) <= strtotime($first_date)) {
            $response["status"] = "error";
            $response["message"] = "La 2da fecha no puede ser inferior o igual a la 1ra fecha.";
            return $response;
        }

        $verificTeacher = FinalModel::subjectverificTeacher($id_subject);

        $verificTeacherFinal = FinalModel::getAllTeachersIsFinal($id_teacher_vocal, $verificTeacher, $first_date, $second_date);

        if (!empty($verificTeacherFinal)) {
            $response["status"] = "error";
            $response["message"] = ""; // Inicializar para concatenar mensajes

            // Variables para evitar mensajes duplicados
            $asignamentTeacherMessageAdded = false;
            $asignamentTeacherMessageAdded1 = false;
            $firstDateMessageAdded = false;
            $secondDateMessageAdded = false;
            $is_igual = false;
            $is_open = false;

            foreach ($verificTeacherFinal as $teacher) {
                if (!$is_open && $teacher['is_open'] == 1) {
                    $response["message"] .= "Ya existe una mesa abierta con esa  materia. ";
                    return $response;
                }else if (!$is_igual && $teacher['is_equal'] == 1) {
                    $response["message"] .= "El/la profesor/a " . $teacher['Vocal'] . " ya es Titular de materia. ";
                    return $response;
                } else  {
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

}
