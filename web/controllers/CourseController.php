<?php
class CourseController
{

    public static function asinngNotesCoursesSubjectStudent($id_subject, $id_student, $note1, $note2, $recuperatory1, $recuperatory2) {
        // Asignar null si el valor está vacío
        $note1 = empty($note1) ? null : $note1;
        $note2 = empty($note2) ? null : $note2;
        $recuperatory1 = empty($recuperatory1) ? null : $recuperatory1;
        $recuperatory2 = empty($recuperatory2) ? null : $recuperatory2;
        
        // Cambiar recuperatorios a null si las notas son >= 4
        if ($note1 !== null && $note1 >= 4) {
            $recuperatory1 = null; // Cambiar recuperatorio 1 a null
        }

        if ($note2 !== null && $note2 >= 4) {
            $recuperatory2 = null; // Cambiar recuperatorio 2 a null
        }
        // Validar cada nota solo si no es null
        if ($note1 !== null) {
            self::validateGrade($note1, 'Parcial 1');
        }
        
        if ($note2 !== null) {
            self::validateGrade($note2, 'Parcial 2');
        }
    
        if ($recuperatory1 !== null) {
            self::validateGrade($recuperatory1, 'Recuperatorio 1');
        }
        
        if ($recuperatory2 !== null) {
            self::validateGrade($recuperatory2, 'Recuperatorio 2');
        }
    
        // Llamada al modelo para guardar las notas
        $execute = CourseModel::asinngNotesCoursesSubjectStudent($id_subject, $id_student, $note1, $note2, $recuperatory1, $recuperatory2);
    
        // Responder según el resultado de la ejecución
        if ($execute) {
            $response['title'] = "¡Actualizado!";
            $response["status"] = "successLoad";
            $response["message"] = "Se guardaron los datos correctamente";
            return $response;
        } else {
            $response["status"] = "error";
            $response["message"] = "Hubo un problema al asignar las notas";
            return $response;
        }
    }
    
    
    private static function validateGrade($grade, $fieldName) {
        if (!empty($grade)) {
            if (!is_numeric($grade)) {
                $response["status"] = "error";
                $response["message"] = "El valor de {$fieldName} debe ser numérico.";
                return $response;
            }
            if ($grade < 0 || $grade > 10) {
                $response["status"] = "error";
                $response["message"] = "El valor de {$fieldName} debe estar entre 0 y 10.";
                return $response;
            }
        }
    }
    
        public static function numeroATexto($numero) {
        $numerosEnTexto = [
            1 => 'Uno',
            2 => 'Dos',
            3 => 'Tres',
            4 => 'Cuatro',
            5 => 'Cinco',
            6 => 'Seis',
            7 => 'Siete',
            8 => 'Ocho',
            9 => 'Nueve',
            10 => 'Diez'
        ];

        return isset($numerosEnTexto[$numero]) ? $numerosEnTexto[$numero] : $numero;
    }

}