<?php
define('FPDF_FONTPATH', 'fpdf/font');
require_once "fpdf/fpdf.php";
class PdfModel{

    static public function dataCareerPdf($data) {
     
        $pdf = new FPDF();
        $pdf->AddPage();
        
        // Obtener el ancho de la página y el ancho de la imagen
        $pageWidth = $pdf->GetPageWidth();
        $imageWidth = 50;
    
        // Centrar la imagen horizontalmente
        $imageX = ($pageWidth - $imageWidth) / 2;
        
        // Logo e imagen
        $pdf->Image('public/img/isft177_H.png', $imageX, 10, $imageWidth); // Ajusta el tamaño de la imagen y su posición
        
        // Título y línea decorativa
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, utf8_decode($data['header']), 0, 1, 'C');
        $pdf->Line(10, 40, 200, 40); // Aumenta la posición vertical de la línea
        
        // Contenido de los datos
        $pdf->SetFont('Arial', '', 12); // Tamaño de fuente más pequeño para los datos
        $pdf->Ln(10); 
        foreach ($data as $key => $value) {
            if ($key != "archive" && $key != "header") {
                $pdf->Cell(0, 10, utf8_decode($value), 0, 1);
            }
        }
       
        $route = "fpdf/" . $data['archive'];
        $pdf->Output('F', $route);
    
        return $route;
    }

    //modelo para crear el pdf de correlativas
    static public function dataCareerPdfCorrelatives($header, $data, $career) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('public/img/isft177_H.png', 10, 10, 0, -300);
        $pdf->Ln(30);
        $pdf->Line(10, 35, 200, 35);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, utf8_decode("Sistema de Correlatividad de: " . $career), 1, 0, 'L');
        $pdf->Ln(8);
    
        // Configuración de la tabla
        $pdf->SetFillColor(100, 140, 140);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 12);
    
        // Cabecera de la tabla
        $w = array(95, 95);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 10, $header[$i], 1, 0, 'C', true);
        }
        $pdf->Ln();
    
        // Restauración de colores y fuentes para los datos
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 10);
    
        // Muestra los datos
        $fill = false;
        foreach ($data as $key => $value) {
            $must_approve = explode('-', $value['debe_aprobar']);
            $maxLines = max(count($must_approve), 1); // Asegura que haya al menos una línea para evitar celdas vacías
    
            // Determina la altura de la celda basada en la cantidad de líneas que mostrará
            $cellHeight = 6 * $maxLines;
    
            // Primera columna: materia para rendir
            $pdf->Cell($w[0], $cellHeight, utf8_decode($value['para_rendir']), 'LR', 0, 'L', $fill);
    
            // Segunda columna: correlatividades
            $correlatives = implode("\n", $must_approve); // Convierte correlatividades en una sola cadena con saltos de línea
            $pdf->MultiCell($w[1], 6, utf8_decode($correlatives), 'LR', 'L', $fill);
    
            $fill = !$fill;
        }
    
        // Línea de cierre de la tabla
        $pdf->Cell(array_sum($w), 0, '', 'T');
    
        // Generación del archivo PDF y retorno de la ruta
        $route = "fpdf/" . "Correlativas-" . $career;
        $pdf->Output('F', $route);
        
        return $route;
    }
    
    //modelo para crear o armar el pdf de materias

    static public function dataCareerPdfSubject($header, $data, $career) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('public/img/isft177_H.png', 10, 10, 0, -300);
        $pdf->Ln(30);
        $pdf->Line(10, 35, 200, 35);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, utf8_decode("Materias de: " . $career), 1, 0, 'C');
        $pdf->Ln(8);
    
        // Configuración de la tabla
        $pdf->SetDrawColor(0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', 'B', 12);
    
        // Cabecera de la tabla
        $w = array(70, 60, 60); // Anchos de las columnas ajustados
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 10, utf8_decode($header[$i]), 1, 0, 'C', false);
        }
        $pdf->Ln();
    
        // Restauración de colores y fuentes para los datos
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial', '', 10);
    
        // Muestra los datos
        $fill = false;
        foreach ($data as $key => $value) {
            $pdf->Cell($w[0], 6, utf8_decode($value['Materia']), 1, 0, 'L', $fill);
            $pdf->Cell($w[1], 6, utf8_decode($value['Año']), 1, 0, 'C', $fill);
            $pdf->Cell($w[2], 6, utf8_decode($value['Carga Horaria']), 1, 0, 'C', $fill);
            $pdf->Ln();
              // Cambiar color de fondo al final de cada fila
            $pdf->SetFillColor(240); // Gris claro
            $pdf->Cell(array_sum($w), 0, '', 'T', 1, '', true);
            $fill = !$fill;
        }
    
        // Línea de cierre de la tabla
        $pdf->Cell(array_sum($w), 0, '', 'T');
    
        // Generación del archivo PDF y retorno de la ruta
        $route = "fpdf/" . "Correlativas-" . $career . ".pdf";
        $pdf->Output('F', $route);
        
        return $route;
    }

    }
    
    
    

   
    

?>