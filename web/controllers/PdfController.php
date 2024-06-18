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
    
    }
    
      

?>