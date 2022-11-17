<?php
//informacion para crear una cuenta tipo estudiante
$action = isset($_POST['action']) ? $_POST['action'] : '';
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

//info para aplicar o dejar de aplicar en un proyecto
$proceso = isset($_POST['proceso']) ? $_POST['proceso'] : '';
$idProyecto =  isset($_POST['idProyecto']) ? $_POST['idProyecto'] : '';
$idEstudiante = isset($_POST['idEstudiante']) ? $_POST['idEstudiante'] : '';
$entidad = isset($_POST['entidad']) ? $_POST['entidad'] : '';

//array que contiene todo lo relacionado a la creacion de una cuenta de estudiante
$info = array(
    "nombre" => $nombre, "edad" => $edad, "direccion" => $direccion,
    "fecha" => $fecha, "telefono" => $telefono, "carnet" => $carnet,
    "dui" => $dui, "materias" => $materias, "carrera" => $carrera,
    "correo" => $correo, "password" => $password, "id_tipo_usuario" => 2
);

//funcion para crear cuentas tipo estudiantes
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

function aplicarUniversidad($pro, $idP, $idE)
{
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');

    if ($pro == "aplicar") {
        $aplicando = "INSERT INTO tbl_postulante_universidad (id_proyecto_universidad, id_estudiante)
            VALUES (:id_proyecto_universidad, :id_estudiante)";
        $sql = $conexion->prepare($aplicando);
        $sql->bindParam(':id_proyecto_universidad', $idP, PDO::PARAM_INT);
        $sql->bindParam(':id_estudiante', $idE, PDO::PARAM_INT);
        $sql->execute();

        $lastInsertId = $conexion->lastInsertId();
        if ($lastInsertId > 0) {
            echo
            '
            <button type="button" class="btn btn-danger btn-md border border-dark" data-id-proyect="' . $idP . '" data-id="' . $idE . '" id="noAplicar"><i class="fas fa-reply"></i> Dejar de aplicar</button>
            ';
        } else {
            print_r($sql->errorInfo());
        }
    } else if ($pro == "noAplicar") {
        $retirando = "DELETE FROM tbl_postulante_universidad where id_proyecto_universidad = " . $idP
            . ' and id_estudiante = ' . $idE;
        $sql = $conexion->prepare($retirando);
        $sql->execute();
        echo
        '
            <button type="button" class="btn btn-primary btn-md border border-dark" data-id-proyect="' . $idP . '" data-id="' . $idE . '" id="aplicar"><i class="fas fa-envelope"></i>  Aplicar</button>
        ';
    }
}

function aplicarEmpresa($pro, $idP, $idE)
{
    include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');

    if ($pro == "aplicar") {
        $aplicando = "INSERT INTO tbl_postulante_empresas (id_proyecto_empresa, id_estudiante)
            VALUES (:id_proyecto_empresa, :id_estudiante)";
        $sql = $conexion->prepare($aplicando);
        $sql->bindParam(':id_proyecto_empresa', $idP, PDO::PARAM_INT);
        $sql->bindParam(':id_estudiante', $idE, PDO::PARAM_INT);
        $sql->execute();

        $lastInsertId = $conexion->lastInsertId();
        if ($lastInsertId > 0) {
            echo
            '
                <button type="button" class="btn btn-danger btn-md border border-dark" data-id-proyect="' . $idP . '" data-id="' . $idE . '" id="noAplicar"><i class="fas fa-reply"></i> Dejar de aplicar</button>
            ';
        } else {
            print_r($sql->errorInfo());
        }
    } else if ($pro == "noAplicar") {
        $retirando = "DELETE FROM tbl_postulante_empresas where id_proyecto_empresa = " . $idP
            . ' and id_estudiante = ' . $idE;
        $sql = $conexion->prepare($retirando);
        $sql->execute();
        echo
        '
            <button type="button" class="btn btn-primary btn-md border border-dark" data-id-proyect="' . $idP . '" data-id="' . $idE . '" id="aplicar"><i class="fas fa-envelope"></i>  Aplicar</button>
            ';
    }
}

//conjunto de if que define que lanzar en caso de realizarse un post

if ($_SERVER['REQUEST_METHOD'] == "POST" && $action == "crear") {
    createEstudiante($info);
}
if (($_POST['proceso'] == "aplicar" || $_POST['proceso'] == "noAplicar") && $_POST['entidad'] == "universidad") {
    aplicarUniversidad($proceso, $idProyecto, $idEstudiante);
}
if (($_POST['proceso'] == "aplicar" || $_POST['proceso'] == "noAplicar") && $_POST['entidad'] == "empresa") {
    aplicarEmpresa($proceso, $idProyecto, $idEstudiante);
}
