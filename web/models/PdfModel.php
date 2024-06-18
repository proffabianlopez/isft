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
    
}
    

?>