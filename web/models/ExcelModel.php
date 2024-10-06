<?php

require_once 'fpdf/SimpleXLSXGen.php';
use Shuchkin\SimpleXLSXGen; // Importar la clase con use
class ExcelModel {

    static public function dataCareerExcel($data) {
        $rows = [
            ['Encabezado', $data['encabezado']],
            ['Nombre', $data['name']],
            ['Título', $data['title']],
            ['Preceptor', $data['preceptor']],
            ['Cantidad de Alumnos Inscriptos', $data['count_student']],
            ['Cantidad de Materias', $data['count_subject']],
            ['Carga Horaria Total', $data['hours_of_work']],
        ];

        $xlsx = SimpleXLSXGen::fromArray($rows);
        $route = "fpdf/" . $data['archive'];
        $xlsx->saveAs($route);

        return $route;
    }

    static public function dataCareerExcelCorrelatives($header, $data, $career) {
        $rows = array_merge([$header], $data);

        $xlsx = SimpleXLSXGen::fromArray($rows);
        $route = "fpdf/Correlativas-" . $career . ".xlsx";
        $xlsx->saveAs($route);

        return $route;
    }

    static public function dataCareerExcelSubject($header, $data, $career) {
        $rows = array_merge([$header], $data);

        $xlsx = SimpleXLSXGen::fromArray($rows);
        $route = "fpdf/Materias-" . $career . ".xlsx";
        $xlsx->saveAs($route);

        return $route;
    }
    static public function dataCareerExcelSubjectStudent($header, $data) {
        $rows = array_merge([$header], $data);

        $xlsx = SimpleXLSXGen::fromArray($rows);
        $route = "fpdf/Lista-Estudiantes.xlsx";
        $xlsx->saveAs($route);

        return $route;
    }
}
