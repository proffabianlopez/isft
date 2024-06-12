<?php
//esta clase va a servir para manejar  todas las asignacion preceptores/profesores/alumnos
class AssignmentController {

    static public function infoDataSubject($id)
    {
        return AssignmentModel::infoGetSubjectData($id);
    }
    
    
    }


?>