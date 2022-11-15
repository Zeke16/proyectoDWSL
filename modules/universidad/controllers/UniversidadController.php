<?php
$envio = isset($_POST['envio']) ? $_POST['envio'] : '';

$nombre = isset($_POST['nombreProyecto']) ? $_POST['nombreProyecto'] : '';
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
$fechaInicio = isset($_POST['fechaInit']) ? $_POST['fechaInit'] : '';
$fechaEsti = isset($_POST['fechaEsti']) ? $_POST['fechaEsti'] : '';
$fechaFin = isset($_POST['fechaEsti']) ? $_POST['fechaEsti'] : '';
$idUser = isset($_POST['id']) ? $_POST['id'] : '';
$tipoProyecto = isset($_POST['tipoProyecto']) ? $_POST['tipoProyecto'] : '';
$carrera = isset($_POST['carrera']) ? $_POST['carrera'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : '';

$info = array(
    "nombre" => $nombre,
    "descripcion" => $descripcion,
    "fechaInicio" => $fechaInicio,
    "fechaEsti" => $fechaEsti,
    "fechaFin" => $fechaFin,
    "idUser" => $idUser,
    "tipoProyecto" => $tipoProyecto,
    "estado" => 1,
    "carrera" => $carrera
);
function alert()
{
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> Registro creado correctamente!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
}
function createProyect($array)
{
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $insert = "INSERT INTO tbl_proyecto_universidad 
        (nombre_proyecto, descripcion, fecha_inicio, fecha_final_estimada, fecha_finalizado, id_usuario, id_tipo_proyecto, id_estado, id_carrera) 
        VALUES (:nombre_proyecto, :descripcion, :fecha_inicio, :fecha_final_estimada, :fecha_finalizado, :id_usuario, :id_tipo_proyecto, :id_estado, :id_carrera)";

    $sql = $conexion->prepare($insert);
    $sql->bindParam(':nombre_proyecto', $array["nombre"], PDO::PARAM_STR);
    $sql->bindParam(':descripcion', $array["descripcion"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_inicio', $array["fechaInicio"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_final_estimada', $array["fechaEsti"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_finalizado', $array["fechaFin"], PDO::PARAM_INT);
    $sql->bindParam(':id_usuario', $array["idUser"], PDO::PARAM_INT);
    $sql->bindParam(':id_tipo_proyecto', $array["tipoProyecto"], PDO::PARAM_STR);
    $sql->bindParam(':id_estado', $array['estado'], PDO::PARAM_INT);
    $sql->bindParam(':id_carrera', $array['carrera'], PDO::PARAM_INT);
    $sql->execute();

    $lastInsertId = $conexion->lastInsertId();
    if ($lastInsertId > 0) {
        session_start();
        $_SESSION['exito'] = "exito";
        header('location: http://localhost/proyectodwsl/modules/universidad/views/index.php');
    } else {
        print_r($sql->errorInfo());
    }
}

function update(){
    
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == 'create') {
    createProyect($info);
}

if ($envio == 'alertRegistro') {
    alert();
}
