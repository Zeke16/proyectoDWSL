<?php
$host  = $_SERVER['HTTP_HOST'];
include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
$id_empresa = isset($_POST['id_empresa']) ? $_POST['id_empresa'] : '';

$query = "DELETE FROM tbl_proyecto_empresas where id_proyecto_empresa = " . $id_empresa;
$sql = $conexion->prepare($query);
$sql->execute();

session_start();
    if (isset($_POST['admin'])) {
        $_SESSION['eliminado'] = "eliminado";
        header('location: http://' . $host .'/proyectodwsl/modules/universidad/views/index.php');
    } else if (isset($_POST['empresa'])) {
        $_SESSION['eliminado'] = "eliminado";
        header('location: index.php');
    }
?>