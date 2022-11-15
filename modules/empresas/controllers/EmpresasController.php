<?php

$nombre = isset($_POST['nombreEmpresa']) ? $_POST['nombreEmpresa'] : '';
$nrc = isset($_POST['nrc']) ? $_POST['nrc'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$id_departamento = isset($_POST['id_departamento']) ? $_POST['id_departamento'] : '';
$id_municipio = isset($_POST['id_municipio']) ? $_POST['id_municipio'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$info = array(
    "nombre" => $nombre, "nrc" => $nrc, "direccion" => $direccion,
    "telefono" => $telefono, "id_departamento" => $id_departamento, "id_municipio" => $id_municipio,
    "correo" => $correo, "password" => $password, "id_tipo_usuario" => 2
);

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

if($_SERVER['REQUEST_METHOD'] == "POST"){
    createEmpresa($info);
}