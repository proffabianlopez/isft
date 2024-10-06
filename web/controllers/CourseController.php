<?php
class CourseController
{
    public static function getCourseDataStudentSubject($id_subject)
    {
        $data = CourseModel::getAllCoursesSubjectStudent($id_subject);
        return $data;
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