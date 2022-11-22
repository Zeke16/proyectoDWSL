<?php
//post de ajax
$envio = isset($_POST['envio']) ? $_POST['envio'] : '';
$proceso = isset($_POST['proceso']) ? $_POST['proceso'] : '';
date_default_timezone_set('America/El_Salvador');

//Aplicacion de postulacion a proyecto de universidad
$id_estudiante_aplicar = isset($_POST['id_estudiante_aplicar']) ? $_POST['id_estudiante_aplicar'] : '';
$id_proyecto_aplicar = isset($_POST['id_proyecto_aplicar']) ? $_POST['id_proyecto_aplicar'] : '';
$id_proyecto_finalizar = isset($_POST['id_proyecto_finalizar']) ? $_POST['id_proyecto_finalizar'] : '';

//post del form para crud
$action = isset($_POST['action']) ? $_POST['action'] : ''; //input que define que accion crud hacer
$id_proyecto = isset($_POST['id_proyecto']) ? $_POST['id_proyecto'] : '';
$nombre = isset($_POST['nombreProyecto']) ? $_POST['nombreProyecto'] : '';
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
$fechaInicio = isset($_POST['fechaInit']) ? $_POST['fechaInit'] : '';
$fechaEsti = isset($_POST['fechaEsti']) ? $_POST['fechaEsti'] : '';
$idUser = isset($_POST['id_user']) ? $_POST['id_user'] : '';
$tipoProyecto = isset($_POST['tipoProyecto']) ? $_POST['tipoProyecto'] : '';
$carrera = isset($_POST['carrera']) ? $_POST['carrera'] : '';

$info = array(
    "nombre" => $nombre,
    "descripcion" => $descripcion,
    "fechaInicio" => $fechaInicio,
    "fechaEsti" => $fechaEsti,
    "fechaFinal" => $fechaEsti,
    "idUser" => $idUser,
    "tipoProyecto" => $tipoProyecto,
    "estado" => 1,
    "carrera" => $carrera
);
function alert($toDo)
{
    if ($toDo == "editar") {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> Registro actualizado correctamente!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    if ($toDo == "crear") {
        echo '
        
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> Registro creado correctamente!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }

    if ($toDo == "eliminar") {
        echo '
        
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> Registro eliminado correctamente!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    if($toDo == "aplicar"){
        echo '
        <button type="button" class="btn btn-success btn-md" id="apply"><i class="fas fa-check-circle"></i>Hecho</button>
        ';
    }
}
function createProyect($array)
{
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $insert = "INSERT INTO tbl_proyecto_universidad 
        (nombre_proyecto, descripcion, fecha_inicio, fecha_final_estimada, fecha_finalizado, id_usuario, id_tipo_proyecto, id_estado, id_carrera) 
        VALUES (:nombre_proyecto, :descripcion, :fecha_inicio, :fecha_final_estimada, :fecha_finalizado, :id_usuario, :id_tipo_proyecto, :id_estado, :id_carrera)";

print_r($array);
    $sql = $conexion->prepare($insert);
    $sql->bindParam(':nombre_proyecto', $array["nombre"], PDO::PARAM_STR);
    $sql->bindParam(':descripcion', $array["descripcion"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_inicio', $array["fechaInicio"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_final_estimada', $array["fechaEsti"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_finalizado', $array["fechaFinal"], PDO::PARAM_STR);
    $sql->bindParam(':id_usuario', $array["idUser"], PDO::PARAM_INT);
    $sql->bindParam(':id_tipo_proyecto', $array["tipoProyecto"], PDO::PARAM_INT);
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

function updateProyect($array, $idupdate)
{
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $update = "UPDATE tbl_proyecto_universidad set nombre_proyecto = :nombre_proyecto, descripcion = :descripcion, fecha_inicio = :fecha_inicio, 
        fecha_final_estimada = :fecha_final_estimada, fecha_finalizado = :fecha_finalizado, id_usuario = :id_usuario,
        id_tipo_proyecto = :id_tipo_proyecto, id_estado = :id_estado, id_carrera = :id_carrera where id_proyecto_universidad = " . $idupdate;

    $sql = $conexion->prepare($update);
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

    session_start();
    $_SESSION['editado'] = "editado";
    header('location: index.php');
}

function aceptarPostulacion($id_est, $id_proy){
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $query = "UPDATE tbl_postulante_universidad 
    SET id_estado_postulacion = 1 
    WHERE id_estudiante = " . $id_est . " and id_proyecto_universidad = " . $id_proy; 
    $sql = $conexion->prepare($query);
    $sql->execute();

    $query2 = "update tbl_proyecto_universidad set id_estado = 2 where id_proyecto_universidad = " . $id_proy;
    $sql = $conexion->prepare($query2);
    $sql->execute(); 
    echo '<div class="container rounded bg-primary text-center" style="width:7rem;">Aceptado</div>';
}

function rechazarPostulacion($id_est, $id_proy){
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $query = "UPDATE tbl_postulante_universidad 
    SET id_estado_postulacion = 2 
    WHERE id_estudiante = " . $id_est . " and id_proyecto_universidad = " . $id_proy; 
    $sql = $conexion->prepare($query);
    $sql->execute();
    echo '<div class="container rounded bg-danger text-center" style="width:7rem;">Rechazado</div>';
}

function finalizarProyecto($id){
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $query = "UPDATE tbl_proyecto_universidad
    SET id_estado = 3, fecha_finalizado = '" . date('Y-m-d') . "' WHERE id_proyecto_universidad = " . $id;
    $sql = $conexion->prepare($query);
    $sql->execute();
    //echo $query;die;
    echo '<div class="container rounded bg-primary" style="width:7rem;">Finalizado</div>';
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == 'create') {
    createProyect($info);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == 'edit') {
    updateProyect($info, $id_proyecto);
}
if ($envio == 'alertRegistro') {
    alert($proceso);
}
if($envio == 'aceptarPostulante'){
    aceptarPostulacion($id_estudiante_aplicar, $id_proyecto_aplicar);
}
if($envio == 'rechazarPostulante'){
    rechazarPostulacion($id_estudiante_aplicar, $id_proyecto_aplicar);
}
if($envio == 'finalizarProyecto'){
    finalizarProyecto($id_proyecto_finalizar);
}
