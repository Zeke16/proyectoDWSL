<?php
//post de ajax
$envio = isset($_POST['envio']) ? $_POST['envio'] : '';
$proceso = isset($_POST['proceso']) ? $_POST['proceso'] : '';

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
    "fechaFin" => $fechaEsti,
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
    header('location: http://localhost/proyectodwsl/modules/universidad/views/index.php');
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
