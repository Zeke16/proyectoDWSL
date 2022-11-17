<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
$id_universidad = isset($_POST['id_universidad']) ? $_POST['id_universidad'] : '';

$query = "DELETE FROM tbl_proyecto_universidad where id_proyecto_universidad = " . $id_universidad;
$sql = $conexion->prepare($query);
$sql->execute();

session_start();
    if (isset($_POST['admin'])) {
        $_SESSION['eliminado'] = "eliminado";
        header('location: http://localhost/proyectodwsl/modules/universidad/views/index.php');
    } else if (isset($_POST['empresa'])) {
        $_SESSION['eliminado'] = "eliminado";
        header('location: http://localhost/proyectodwsl/modules/empresas/views/index.php');
    }
?>