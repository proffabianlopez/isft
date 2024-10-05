<?php

class ExcelController {

    public function excelDataCareer($data, $preceptor, $dataCountStudent) {
        $datas = array(
            'encabezado' => "Información de carrera",
            'archive' => "info-" . $data['name_career'] . ".xlsx",
            'name' => 'Nombre: ' . $data['name_career'],
            'title' => 'Título: ' . $data['title'],
            'preceptor' => 'Preceptor: ' . $preceptor['preceptores'],
            'count_student' => 'Cantidad de alumnos inscriptos: ' . $dataCountStudent['total_student'],
            'count_subject' => 'Cantidad de Materias: ' . $data['total_subject'],
            'hours_of_work' => 'Carga Horaria Total: ' . $data['total_hours']
        );

        $route = ExcelModel::dataCareerExcel($datas);

        if (file_exists($route)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . basename($route) . '"');
            header('Content-Length: ' . filesize($route));
            ob_clean();
            flush();
            readfile($route);
            unlink($route);
            exit;
        } else {
            die('El archivo Excel no existe.');
        }
    }

    public function excelDataCareerCorrelatives($career, $id_career) {
        $header = array('Para rendir', 'Debe aprobar');
        $correlatives = CorrelativeController::listMultipleCorrelatives($id_career);
        $data = array();
        foreach ($correlatives as $correlative) {
            $data[] = array(
                $correlative['name_subject'],
                $correlative['correlatives']
            );
        }

        $route = ExcelModel::dataCareerExcelCorrelatives($header, $data, $career);

        if (file_exists($route)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . basename($route) . '"');
            header('Content-Length: ' . filesize($route));
            ob_clean();
            flush();
            readfile($route);
            unlink($route);
            exit;
        } else {
            die('El archivo Excel no existe.');
        }
    }

    public function excelDataCareerSubject($career, $id_career) {

        error_log('EXCEL CONTROLLER-> Entre a excelDataCareerSubject');
        $header = array('Materia', 'Año', 'Carga Horaria');
        $subjects = SubjectModel::SubjectCareerAsc($id_career);
        $data = array();

        foreach ($subjects as $subject) {
            $data[] = array(
                $subject['name_subject'],
                $subject['yearSubject'],
                $subject['hours'] . " hs"
            );
        }

        $route = ExcelModel::dataCareerExcelSubject($header, $data, $career);

        if (file_exists($route)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . basename($route) . '"');
            header('Content-Length: ' . filesize($route));
            ob_clean();
            flush();
            readfile($route);
            unlink($route);
            exit;
        } else {
            die('El archivo Excel no existe.');
        }
    }
    
    public function excelDataCareerSubjectStudent($id_subject, $id_career) {

        error_log('EXCEL CONTROLLER-> Entre a excelDataCareerSubject');
        $header = array('Apellido', 'Nombre');
        $subjects =AssignmentController::showStudentSubejct($id_subject);
        $data = array();

        foreach ($subjects as $subject) {
            $data[] = array(
                $subject['last_name'],
                $subject['name'],
            );
        }

        $route = ExcelModel::dataCareerExcelSubjectStudent($header, $data);

        if (file_exists($route)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . basename($route) . '"');
            header('Content-Length: ' . filesize($route));
            ob_clean();
            flush();
            readfile($route);
            unlink($route);
            exit;
        } else {
            die('El archivo Excel no existe.');
        }
    }
}
?>
