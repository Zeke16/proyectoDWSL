<?php
require('fpdf.php');
include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
$id_empresa = isset($_POST['id_empresa']) ? $_POST['id_empresa'] : '';
$id_estudiante = isset($_POST['id_estudiante']) ? $_POST['id_estudiante'] : '';

$conexion->exec("set names utf8");
$proyectoEmp = " SELECT p.id_postulacion_empresa, p.id_estado_postulacion, ep.estado_postulacion,
pe.id_proyecto_empresa, pe.nombre_proyecto, pe.descripcion, pe.fecha_inicio, 
pe.fecha_final_estimada, pe.fecha_finalizado, c.nombre_carrera, tp.nombre_tipo_proyecto
from tbl_postulante_empresas as p 
inner join tbl_estado_postulaciones as ep on p.id_estado_postulacion = ep.id_estado_postulacion 
inner join tbl_proyecto_empresas as pe on p.id_proyecto_empresa = pe.id_proyecto_empresa
inner join tbl_carreras as c on pe.id_carrera = c.id_carrera
inner join tbl_tipo_proyecto as tp on pe.id_tipo_proyecto = tp.id_tipo_proyecto
WHERE id_estudiante = " . $id_estudiante . " AND p.id_proyecto_empresa = " . $id_empresa;
//echo $proyectoEmp;
$ejecutable = $conexion->prepare($proyectoEmp);
$ejecutable->execute();
$proyectos = $ejecutable->fetchAll(PDO::FETCH_OBJ);

$estudiante = " SELECT *, c.nombre_carrera FROM tbl_estudiantes as e
inner join tbl_carreras as c on e.id_carrera = c.id_carrera
WHERE e.id_estudiante = " . $id_estudiante ;
//echo $estudiante;
$ejecutable = $conexion->prepare($estudiante);
$ejecutable->execute();
$estudianteInfo = $ejecutable->fetchAll(PDO::FETCH_OBJ);

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
        $this->Cell(30, 10, 'Informacion sobre postulacion de proyectos - ' . $this->name, 0, 0, 'C');
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
$pdf = new PDF('p', 'mm', 'A4', $estudianteInfo[0]->nombre_estudiante);
$pdf->SetMargins(17, 10);
$pdf->AliasNbPages();
$pdf->AddPage();
//info del estudiante - titulo
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(175, 10,  utf8_decode('Informacion general sobre el estudiante'), 1, 1, 'C', 1);

//contenido
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

//Primer fila
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'Carnet:', 1, 0, 'L', 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 10, utf8_decode($estudianteInfo[0]->carnet), 1, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, 'Nombre completo:', 1, 0, 'L', 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(85, 10, utf8_decode($estudianteInfo[0]->nombre_estudiante), 1, 1, 'L', 1);

//segunda fila
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'Edad:', 1, 0, 'L', 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 10, utf8_decode($estudianteInfo[0]->edad), 1, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, 'Correo electronico:', 1, 0, 'L', 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(85, 10, utf8_decode($estudianteInfo[0]->correo_electronico), 1, 1, 'L', 1);

//tercera fila
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'Dui:', 1, 0, 'L', 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 10, utf8_decode($estudianteInfo[0]->dui), 1, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, 'Direccion:', 1, 0, 'L', 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(85, 10, utf8_decode($estudianteInfo[0]->direccion), 1, 1, 'L', 1);

//cuarta fila
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'Telefono:', 1, 0, 'L', 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 10, utf8_decode($estudianteInfo[0]->telefono), 1, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, 'Carrera:', 1, 0, 'L', 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(253, 1, 38);
$pdf->Cell(85, 10, utf8_decode($estudianteInfo[0]->nombre_carrera), 1, 1, 'C', 1);


//info del proyecto
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFillColor(184, 218, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(175, 10,  utf8_decode('Informacion general sobre el proyecto'), 1, 1, 'C', 1);

$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
foreach ($proyectos as $r) {
    //primer fila
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 10,  utf8_decode('Nombre del proyecto:'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10,  utf8_decode($r->nombre_proyecto), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(35, 10,  utf8_decode('Tipo de proyecto:'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(60, 10,  utf8_decode($r->nombre_tipo_proyecto), 1, 1, 'L', 1);

    //segunda fila
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(40, 10,  utf8_decode('Fecha de inicio:'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10,  utf8_decode($r->fecha_inicio), 1, 0, 'C', 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 10,  utf8_decode('Fecha estimada de finalizacion:'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(35, 10,  utf8_decode($r->fecha_final_estimada), 1, 1, 'C', 1);

    //tercer fila
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 10,  utf8_decode('Fecha de finalizacion:'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10,  utf8_decode($r->fecha_finalizado), 1, 0, 'C', 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 10,  utf8_decode('Estado de la postulacion:'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', 'B', 10);
    if (strtolower($r->estado_postulacion) == "aprobado") {
        $pdf->SetTextColor(0, 80, 180);
    } else if (strtolower($r->estado_postulacion) == "pendiente") {
        $pdf->SetTextColor(91, 192, 222);
    } else if (strtolower($r->estado_postulacion) == "rechazado") {
        $pdf->SetTextColor(253, 1, 38);
    }
    $pdf->Cell(35, 10,  utf8_decode($r->estado_postulacion), 1, 1, 'C', 1);


    //Cuarta fila
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 10,  utf8_decode('Especialidad del proyecto:'), 1, 0, 'L', 1);
    $pdf->SetTextColor(253, 1, 38);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(125, 10,  utf8_decode($r->nombre_carrera), 1, 1, 'C', 1);

    //Quinta fila
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 15,  utf8_decode('Descripcion del proyecto:'), 1, 0, 'L', 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(125, 15,  utf8_decode($r->descripcion), 1, 1, 'L', 1);
}

$pdf->Output();