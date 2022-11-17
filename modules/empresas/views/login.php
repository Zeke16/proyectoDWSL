<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
date_default_timezone_set('America/El_Salvador');
session_start();
if (isset($_SESSION['empresa'])) {
    header("location: index.php");
}
$opcion = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre =  isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $pass =  isset($_POST['pass']) ? $_POST['pass'] : '';
    $tabla = isset($_POST['tabla']) ? $_POST['tabla'] : '';
    $query = "Select * from " . $tabla . " where correo_electronico = '" . $nombre . "' and password = '" . $pass . "'";
    $exec = $conexion->prepare($query);
    $exec->execute();
    $registro = $exec->fetchAll(PDO::FETCH_OBJ);
    $nr = $exec->rowCount();
    if ($nr == 1) {
        $_SESSION['empresa'] = $registro[0]->nombre_empresa;
        $_SESSION['id_empresa'] = $registro[0]->id_empresa;
        //Se calcula cuanto durara la sesion
        $_SESSION['start'] = time();
        $_SESSION['end'] = $_SESSION['start'] + (60*60);
        header("location: index.php");
    }
    if ($nr == 0) {
        $opcion = 1;
    }
}
?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://localhost/proyectodwsl/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/proyectodwsl/index.php"><img src="http://localhost/proyectodwsl/assets/img/logo.png" width="50xp" height="50px" alt=""><i class="fa-solid" id="home-logo">&nbsp;UNIVO</i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/proyectodwsl/modules/universidad/views/login.php">Universidad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/proyectodwsl/modules/empresas/views/login.php">Empresas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/proyectodwsl/modules/estudiantes/views/login.php" id="loginEstudiante">Estudiantes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="alert">

    </div>
    <div class="container mt-2 p-2 d-flex justify-content-center" id="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="width: 40rem;">
                    <div class="card-header d-flex justify-content-start" id="header-logEmp">
                        <img class="mt-2" src="http://localhost/proyectodwsl/assets/icon/briefcase-solid.svg" width="40xp" height="40px" id="emp" alt="">&nbsp;&nbsp;
                        <h2 class="card-title mt-2">Inicio de sesion</h2>
                    </div>
                    <div class="card-body" id="body-logEmp">
                        <form method="POST">
                            <label>Escribe el correo electrónico:</label><br>
                            <input class="form-control mt-2" type="text" name="usuario" placeholder="Ingresar usuario" required /><br>
                            <label>Contraseña</label><br>
                            <input class="form-control mt-2" type="password" name="pass" placeholder="Ingresar password" required /><br>
                            <input class="form-control mt-2" type="text" hidden name="tabla" value="tbl_empresas" />
                            <input class="rounded-pill form-control" type="submit" name="btnIngresar" id="btnEnviarEmp" value="Ingresar" /><br>
                            <a href="http://localhost/proyectodwsl/modules/empresas/views/form-register.php" class="btn form-control rounded-pill" id="btnRegresar">Crear nueva cuenta</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>

</html>
<?php

if (isset($_SESSION['exito'])) {

    print("<script>alertify.success('Registro creado correctamente!');</script>");

    unset($_SESSION['exito']);
}

if ($opcion == 1) {
    print("<script>alertify.error('Usuario o contraseña incorrectos!');</script>");
    print('<script>history.replaceState(null, "", "login.php");</script>');
} else if ($opcion == 0) {
    print("");
}
?>