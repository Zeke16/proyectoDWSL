<?php

//post para crear cuentas tipo empresa
$action = isset($_POST['action']) ? $_POST['action'] : '';
$nombre = isset($_POST['nombreEmpresa']) ? $_POST['nombreEmpresa'] : '';
$nrc = isset($_POST['nrc']) ? $_POST['nrc'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$id_departamento = isset($_POST['id_departamento']) ? $_POST['id_departamento'] : '';
$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

//Aplicacion de postulacion a proyecto de universidad
$envio = isset($_POST['envio']) ? $_POST['envio'] : '';
$id_estudiante_aplicar = isset($_POST['id_estudiante_aplicar']) ? $_POST['id_estudiante_aplicar'] : '';
$id_proyecto_aplicar = isset($_POST['id_proyecto_aplicar']) ? $_POST['id_proyecto_aplicar'] : '';
$id_proyecto_finalizar = isset($_POST['id_proyecto_finalizar']) ? $_POST['id_proyecto_finalizar'] : '';

$info = array(
    "nombre" => $nombre, "nrc" => $nrc, "direccion" => $direccion,
    "telefono" => $telefono, "id_departamento" => $id_departamento, "id_municipio" => $id_municipio,
    "correo" => $correo, "password" => $password, "id_tipo_usuario" => 2
);

//post para crear proyectos de empresas
//post del form para crud
$action = isset($_POST['action']) ? $_POST['action'] : ''; //input que define que accion crud hacer
$id_proyecto = isset($_POST['id_proyecto']) ? $_POST['id_proyecto'] : '';
$nombre = isset($_POST['nombreProyecto']) ? $_POST['nombreProyecto'] : '';
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
$fechaInicio = isset($_POST['fechaInit']) ? $_POST['fechaInit'] : '';
$fechaEsti = isset($_POST['fechaEsti']) ? $_POST['fechaEsti'] : '';
$idEmpresa = isset($_POST['id_empresa']) ? $_POST['id_empresa'] : '';
$tipoProyecto = isset($_POST['tipoProyecto']) ? $_POST['tipoProyecto'] : '';
$carrera = isset($_POST['carrera']) ? $_POST['carrera'] : '';
$admin = isset($_POST['admin']) ? $_POST['admin'] : '';
$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';

$infoCrud = array(
    "nombre" => $nombre,
    "descripcion" => $descripcion,
    "fechaInicio" => $fechaInicio,
    "fechaEsti" => $fechaEsti,
    "fechaFinal" => $fechaEsti,
    "idEmpresa" => $idEmpresa,
    "tipoProyecto" => $tipoProyecto,
    "estado" => 1,
    "carrera" => $carrera,
    "admin" => $admin,
    "empresa" => $empresa
);

//funcion para crear una cuenta de tipo empresa, recibe por parametro un array con la data proveniente del post
function createEmpresa($array)
{
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $newEmpresa = "INSERT INTO tbl_empresas 
    (nombre_empresa, nrc, direccion_empresa, telefono, id_departamento, id_municipio, correo_electronico, password, id_tipo_usuario) 
    VALUES (:nombre_empresa, :nrc, :direccion_empresa, :telefono, :id_departamento, :id_municipio, :correo_electronico, :password, :id_tipo_usuario)";

    $sql = $conexion->prepare($newEmpresa);
    $sql->bindParam(':nombre_empresa', $array["nombre"], PDO::PARAM_STR);
    $sql->bindParam(':nrc', $array["nrc"], PDO::PARAM_STR);
    $sql->bindParam(':direccion_empresa', $array["direccion"], PDO::PARAM_STR);
    $sql->bindParam(':telefono', $array["telefono"], PDO::PARAM_STR);
    $sql->bindParam(':id_departamento', $array["id_departamento"], PDO::PARAM_INT);
    $sql->bindParam(':id_municipio', $array["id_municipio"], PDO::PARAM_INT);
    $sql->bindParam(':correo_electronico', $array["correo"], PDO::PARAM_STR);
    $sql->bindParam(':password', $array['password'], PDO::PARAM_STR);
    $sql->bindParam(':id_tipo_usuario', $array['id_tipo_usuario'], PDO::PARAM_STR);
    $sql->execute();

    $lastInsertId = $conexion->lastInsertId();
    if ($lastInsertId > 0) {
        session_start();
        $_SESSION['exito'] = "exito";
        header('location: http://localhost/proyectodwsl/modules/empresas/views/login.php');
    } else {
        print_r($sql->errorInfo());
    }
}

function createProyectEmpresa($array)
{
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $insert = "INSERT INTO tbl_proyecto_empresas 
        (nombre_proyecto, descripcion, fecha_inicio, fecha_final_estimada, fecha_finalizado, id_empresa, id_tipo_proyecto, id_estado, id_carrera) 
        VALUES (:nombre_proyecto, :descripcion, :fecha_inicio, :fecha_final_estimada, :fecha_finalizado, :id_empresa, :id_tipo_proyecto, :id_estado, :id_carrera)";

    print_r($array);
    $sql = $conexion->prepare($insert);
    $sql->bindParam(':nombre_proyecto', $array["nombre"], PDO::PARAM_STR);
    $sql->bindParam(':descripcion', $array["descripcion"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_inicio', $array["fechaInicio"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_final_estimada', $array["fechaEsti"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_finalizado', $array["fechaFinal"], PDO::PARAM_STR);
    $sql->bindParam(':id_empresa', $array["idEmpresa"], PDO::PARAM_INT);
    $sql->bindParam(':id_tipo_proyecto', $array["tipoProyecto"], PDO::PARAM_INT);
    $sql->bindParam(':id_estado', $array['estado'], PDO::PARAM_INT);
    $sql->bindParam(':id_carrera', $array['carrera'], PDO::PARAM_INT);
    $sql->execute();
    $lastInsertId = $conexion->lastInsertId();
    if ($lastInsertId > 0) {
        session_start();
        if ($array["admin"] != '') {
            $_SESSION['exito'] = "exito";
            header('location: http://localhost/proyectodwsl/modules/universidad/views/index.php');
        } else if ($array["empresa"] != '') {
            $_SESSION['exito'] = "exito";
            header('location: http://localhost/proyectodwsl/modules/empresas/views/index.php');
        }
    } else {
        print_r($sql->errorInfo());
    }
}

function updateProyectEmpresa($array, $idupdate)
{
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $update = "UPDATE tbl_proyecto_empresas set nombre_proyecto = :nombre_proyecto, descripcion = :descripcion, fecha_inicio = :fecha_inicio, 
        fecha_final_estimada = :fecha_final_estimada, fecha_finalizado = :fecha_finalizado, id_empresa = :id_empresa,
        id_tipo_proyecto = :id_tipo_proyecto, id_estado = :id_estado, id_carrera = :id_carrera where id_proyecto_empresa = " . $idupdate;

    print_r($array);
    echo $idupdate;
    
    $sql = $conexion->prepare($update);
    $sql->bindParam(':nombre_proyecto', $array["nombre"], PDO::PARAM_STR);
    $sql->bindParam(':descripcion', $array["descripcion"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_inicio', $array["fechaInicio"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_final_estimada', $array["fechaEsti"], PDO::PARAM_STR);
    $sql->bindParam(':fecha_finalizado', $array["fechaFinal"], PDO::PARAM_STR);
    $sql->bindParam(':id_empresa', $array["idEmpresa"], PDO::PARAM_INT);
    $sql->bindParam(':id_tipo_proyecto', $array["tipoProyecto"], PDO::PARAM_INT);
    $sql->bindParam(':id_estado', $array['estado'], PDO::PARAM_INT);
    $sql->bindParam(':id_carrera', $array['carrera'], PDO::PARAM_INT);
    $sql->execute();
    print_r($sql);
    session_start();
    if ($array["admin"] != '') {
        $_SESSION['editado'] = "editado";
        header('location: http://localhost/proyectodwsl/modules/universidad/views/index.php');
    } else if ($array["empresa"] != '') {
        $_SESSION['editado'] = "editado";
        header('location: http://localhost/proyectodwsl/modules/empresas/views/index.php');
    }
}

function aceptarPostulacion($id_est, $id_proy){
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $query = "UPDATE tbl_postulante_empresas 
    SET id_estado_postulacion = 1 
    WHERE id_estudiante = " . $id_est . " and id_proyecto_empresa = " . $id_proy; 
    $sql = $conexion->prepare($query);
    $sql->execute();
    //echo $query;die;
    $query2 = "update tbl_proyecto_empresas set id_estado = 2 where id_proyecto_empresa = " . $id_proy;
    $sql = $conexion->prepare($query2);
    $sql->execute(); 
    echo '<div class="container rounded bg-primary text-center" style="width:7rem;">Aceptado</div>';
}

function rechazarPostulacion($id_est, $id_proy){
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $query = "UPDATE tbl_postulante_empresas 
    SET id_estado_postulacion = 2 
    WHERE id_estudiante = " . $id_est . " and id_proyecto_empresa = " . $id_proy; 
    $sql = $conexion->prepare($query);
    $sql->execute();
    echo '<div class="container rounded bg-danger text-center" style="width:7rem;">Rechazado</div>';
}

function finalizarProyecto($id){
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $query = "UPDATE tbl_proyecto_empresas
    SET id_estado = 3, fecha_finalizado = '" . date('Y-m-d') . "' WHERE id_proyecto_empresa = " . $id;
    $sql = $conexion->prepare($query);
    $sql->execute();
    //echo $query;die;
    echo '<div class="container rounded bg-primary" style="width:7rem;">Finalizado</div>';
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == 'create') {
    createProyectEmpresa($infoCrud);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == 'edit') {
    updateProyectEmpresa($infoCrud, $id_proyecto);
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
if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == "crear") {
    createEmpresa($info);
}
