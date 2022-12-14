<?php
require('fpdf.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
$id_universidad = isset($_POST['id_universidad']) ? $_POST['id_universidad'] : '';

$conexion->exec("set names utf8");
$proyectoU = "Select p.id_proyecto_universidad, p.nombre_proyecto, p.descripcion, p.fecha_inicio, 
p.fecha_final_estimada, p.fecha_finalizado, u.nombre_usuario, tp.nombre_tipo_proyecto, c.nombre_carrera, ep.estado
from tbl_proyecto_universidad as p 
inner join tbl_super_administrador as u on p.id_usuario = u.id_usuario
inner join tbl_tipo_proyecto as tp on p.id_tipo_proyecto = tp.id_tipo_proyecto
inner join tbl_carreras as c on p.id_carrera = c.id_carrera
inner join tbl_estado_proyectos as ep on p.id_estado = ep.id_estado
where id_proyecto_universidad = "  . $id_universidad;
$ejecutable = $conexion->prepare($proyectoU);
$ejecutable->execute();
$proyectos = $ejecutable->fetchAll(PDO::FETCH_OBJ);
$nr = $ejecutable->RowCount();
class PDF extends FPDF
{
    public $name;

    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4', $name)
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
        $this->Cell(30, 10, utf8_decode("Año ") . $fecha['year'], 0, 0, 'C');
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
//border color
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10,  utf8_decode($proyectos[0]->id_proyecto_universidad), 1, 0, 'C', 1);
$pdf->Cell(155, 10,  utf8_decode('Informacion general sobre el proyecto'), 1, 1, 'C', 1);

$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
foreach ($proyectos as $r) {
    //primer fila
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 10,  utf8_decode('Nombre del proyect'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10,  utf8_decode($r->nombre_proyecto), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(35, 10,  utf8_decode('Tipo de proyect'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(60, 10,  utf8_decode($r->nombre_tipo_proyecto), 1, 1, 'C', 1);

    //segunda fila
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(40, 10,  utf8_decode('Fecha de inici'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10,  utf8_decode($r->fecha_inicio), 1, 0, 'C', 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 10,  utf8_decode('Fecha estimada de finalizacio'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(35, 10,  utf8_decode($r->fecha_final_estimada), 1, 1, 'C', 1);

    //tercer fila
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 10,  utf8_decode('Fecha de finalizacio'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10,  utf8_decode($r->fecha_finalizado), 1, 0, 'C', 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 10,  utf8_decode('Estado del proyect'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', 'B', 10);
    if (strtolower($r->estado) == "finalizado") {
        $pdf->SetTextColor(0, 80, 180);
    } else if (strtolower($r->estado) == "en proceso") {
        $pdf->SetTextColor(91, 192, 222);
    } else if (strtolower($r->estado) == "sin asignar") {
        $pdf->SetTextColor(253, 1, 38);
    } else if (strtolower($r->estado) == "en pausa") {
        $pdf->SetTextColor(240, 173, 78);
    }
    $pdf->Cell(35, 10,  utf8_decode($r->estado), 1, 1, 'C', 1);


    //Cuarta fila
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 10,  utf8_decode('Especialidad del proyect'), 1, 0, 'L', 1);
    $pdf->SetTextColor(253, 1, 38);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(125, 10,  utf8_decode($r->nombre_carrera), 1, 1, 'C', 1);

    //Quinta fila
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 15,  utf8_decode('Descripcion del proyect'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(125, 15,  utf8_decode($r->descripcion), 1, 1, 'L', 1);
}
$pdf->Output();
