<?php

class PdfController {
  
    public function pdfDataCareer($data, $preceptor, $dataCountStudent) {
        // Construir el array de datos para el PDF
        $datas = array(
            'encabezado' => "Información de carrera",
            'archive' => "info-" . $data['name_career'] . ".pdf",
            'name' => 'Nombre: ' . $data['name_career'],
            'title' => 'Título: ' . $data['title'],
            'preceptor' => 'Preceptor: ' . $preceptor['preceptores'],
            'count_student' => 'Cantidad de alumnos inscriptos: ' . $dataCountStudent['total_student'],
            'count_subject' => 'Cantidad de Materias: ' . $data['total_subject'],
            'hours of work' => 'Carga Horaria Total: ' . $data['total_hours']
        );
    
        // Construir el PDF y obtener la ruta del archivo generado
        $route = PdfModel::dataCareerPdf($datas);
    
        // Descargar el archivo mediante el navegador
        if (file_exists($route)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($route) . '"');
            header('Content-Length: ' . filesize($route));
            ob_clean();  // Limpiar el búfer de salida para asegurar que no haya contenido extra
            flush();     // Forzar el envío de los encabezados al navegador
            readfile($route);
            unlink($route); 
            exit;
        } else {
            die('El archivo PDF no existe.');
        }
    }
    
    //controlador para manejar los datos de las correlativas
    static public function  dataCareerPdfCorrelatives($career,$id_career){
        $header = array('Para rendir', 'Debe aprobar');
        $correlatives = CorrelativeController::listMultipleCorrelatives($_GET['id_career']);
        $data = array();
        foreach ($correlatives as $correlative) {
            $data[] = array(
                'para_rendir' => $correlative['name_subject'],
                'debe_aprobar' => $correlative['correlatives']
            );
        }
    
        // Llamamos al método en el modelo para generar el PDF
        $route = PdfModel::dataCareerPdfCorrelatives($header, $data, $career);
    
        // Forzamos la descarga del archivo generado
        if (file_exists($route)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="Correlativas-' . $career . '.pdf"');
            header('Content-Length: ' . filesize($route));
            ob_clean();  // Limpiar el búfer de salida para asegurar que no haya contenido extra
            flush();
            readfile($route);
            unlink($route); // Opcional: borrar el archivo después de descargarlo
            exit;
        } else {
            die('El archivo PDF no existe.');
        }
    }

    //controlador para controlar los datos de la materia
    public function dataCareerPdfSubject($career, $id_career) {
        error_log('PDF CONTROLLER-> Entre a dataCareerPdfSubject');

        $header = array('Materia', 'Año','Carga Horaria');
        $subjects = SubjectModel::SubjectCareerAsc($id_career);
        $data = array();
        
        foreach ($subjects as $subject) {
            $data[] = array(
                'Materia' => $subject['name_subject'],
                'Año' => $subject['yearSubject'],
                'Carga Horaria' => $subject['hours'].""."hs",
            );
        }
    
        // Llamar al método en el modelo para generar el PDF
        $route = PdfModel::dataCareerPdfSubject($header, $data, $career);
    
        // Forzar la descarga del archivo generado
        if (file_exists($route)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="subject-' . $career . '.pdf"');
            header('Content-Length: ' . filesize($route));
            ob_clean();
            flush();
            readfile($route);
            unlink($route); // Opcional: borrar el archivo después de descargarlo
            exit;
        } else {
            die('El archivo PDF no existe.');
        }
    }

    public function dataCareerPdfSubjectStudent($subject_id,$name_subject) {
        $header = array('Nombre', 'Apellido', 'DNI');
        $students = AssignmentModel::model_showStudentSubejct($subject_id);
        $data = array();
        
        foreach ($students as $student) {
            $data[] = array(
                'Nombre' => $student['name'],
                'Apellido' => $student['last_name'],
                'DNI' => $student['dni'],
                
            );
        }
    
     
        $route = PdfModel::dataPdfSubjectStudent($header, $data, $name_subject);
    
   
        if ($route && file_exists($route)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="estudiantes-' . $name_subject . '.pdf"');
            header('Content-Length: ' . filesize($route));
            ob_clean();
            flush();
            readfile($route);
            unlink($route);
            exit;
        } else {
            error_log('No se pudo generar el archivo PDF.');  
            die('El archivo PDF no existe o no se pudo generar.');
        }
    }


    
}
    
      

?>