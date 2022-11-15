<?php
require('fpdf.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
$id_universidad = isset($_POST['id_universidad']) ? $_POST['id_universidad'] : '';

$conexion->exec("set names utf8");
$proyectoU = "Select * from tbl_proyecto_universidad where id_proyecto_universidad = " . $id_universidad;
$ejecutable = $conexion->prepare($proyectoU);
$ejecutable->execute();
$proyectos = $ejecutable->fetchAll(PDO::FETCH_OBJ);
$nr = $ejecutable->RowCount();

class PDF extends FPDF
{
    public $name;
    
    public function __construct($orientation='P', $unit='mm', $size='A4', $name)
    {
        parent::__construct($orientation, $unit, $size);
        $this->name = $name;
    }
    //Cabezera principal de la pagina
    function header()
    {
        $fecha = getdate();
        //Imagen y su tamaño
        $this->Image('logo.png', 10, 8, 25);
        //Estilo, tipo de letra y tamaño
        $this->SetFont('helvetica', 'B', 13);
        //Crear una sangria
        $this->Cell(80);
        //Crear contenido dentro de una celda
        $this->Cell(30, 10, 'Reporte - ' . $this->name, 0, 0, 'C');
        //Saltos de linea
        $this->Ln(5);
        $this->Cell(80);
        //colocar tildes y caracteres especiales
        $this->Cell(30, 10, utf8_decode("Año ") . $fecha['year'] , 0, 0, 'C');
        $this->Ln(27);
    }

    function footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
$pdf = new PDF('p', 'mm', 'A4', $proyectos[0]->nombre_proyecto);
$pdf->SetMargins(17, 10);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, 'ID', 1, 0, 'C', 1);
$pdf->Cell(60, 5, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(60, 5, 'Inicio', 1, 0, 'C', 1);
$pdf->Cell(35, 5, 'Fin estimado', 1, 1, 'C', 1);

foreach ($proyectos as $r) {
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(20, 5,  utf8_decode($r->id_proyecto_universidad), 1, 0, 'C', 1);
    $pdf->Cell(60, 5,  utf8_decode($r->nombre_proyecto), 1, 0, 'C', 1);
    $pdf->Cell(60, 5,  utf8_decode($r->fecha_inicio), 1, 0, 'C', 1);
    $pdf->Cell(35, 5,  utf8_decode($r->fecha_final_estimada), 1, 1, 'C', 1);
}
$pdf->Output();
