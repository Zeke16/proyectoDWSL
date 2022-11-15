<?php
$nombre = isset($_POST['nombreEstudiante']) ? $_POST['nombreEstudiante'] : '';
$edad = isset($_POST['edad']) ? $_POST['edad'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$carnet = isset($_POST['carnet']) ? $_POST['carnet'] : '';
$dui = isset($_POST['dui']) ? $_POST['dui'] : '';
$materias = isset($_POST['materias']) ? $_POST['materias'] : '';
$carrera = isset($_POST['carrera']) ? $_POST['carrera'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


$info = array(
    "nombre" => $nombre, "edad" => $edad, "direccion" => $direccion,
    "fecha" => $fecha, "telefono" => $telefono, "carnet" => $carnet,
    "dui" => $dui, "materias" => $materias, "carrera" => $carrera,
    "correo" => $correo, "password" => $password, "id_tipo_usuario" => 2
);

function createEstudiante($array)
{
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
    $newEstudiante = "INSERT INTO tbl_estudiantes 
    (nombre_estudiante, edad, dui, direccion, telefono, fecha_nacimiento, carnet, id_carrera, materias_cursadas, correo_electronico, password, id_tipo_usuario) 
    VALUES (:nombre_estudiante, :edad, :dui, :direccion, :telefono, :fecha_nacimiento, :carnet, :id_carrera, :materias_cursadas, :correo_electronico, :password, :id_tipo_usuario)";

    $sql = $conexion->prepare($newEstudiante);
    $sql->bindParam(':nombre_estudiante', $array["nombre"], PDO::PARAM_STR);
    $sql->bindParam(':edad', $array["edad"], PDO::PARAM_INT);
    $sql->bindParam(':dui', $array["dui"], PDO::PARAM_STR);
    $sql->bindParam(':direccion', $array["direccion"], PDO::PARAM_STR);
    $sql->bindParam(':telefono', $array["telefono"], PDO::PARAM_INT);
    $sql->bindParam(':fecha_nacimiento', $array["fecha"], PDO::PARAM_STR);
    $sql->bindParam(':carnet', $array["carnet"], PDO::PARAM_STR);
    $sql->bindParam(':id_carrera', $array['carrera'], PDO::PARAM_INT);
    $sql->bindParam(':materias_cursadas', $array['materias'], PDO::PARAM_INT);
    $sql->bindParam(':correo_electronico', $array['correo'], PDO::PARAM_STR);
    $sql->bindParam(':password', $array['password'], PDO::PARAM_STR);
    $sql->bindParam(':id_tipo_usuario', $array['id_tipo_usuario'], PDO::PARAM_INT);
    $sql->execute();

    $lastInsertId = $conexion->lastInsertId();
    if ($lastInsertId > 0) {
        session_start();
        $_SESSION['exito'] = "exito";
        header('location: http://localhost/proyectodwsl/modules/estudiantes/views/login.php');
    } else {
        print_r($sql->errorInfo());
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    createEstudiante($info);
}
?>