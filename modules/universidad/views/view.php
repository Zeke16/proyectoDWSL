<?php
//manejo de session existente, en caso de no existir se regresa al login
session_start();
date_default_timezone_set('America/El_Salvador');
if (isset($_SESSION['administrador']) && isset($_SESSION['id_user'])) {
    $usuarioingresado = $_SESSION['administrador'];
    $id_user = $_SESSION['id_user'];

    $now = time();
    if ($now > $_SESSION['end']) {
        session_destroy();
        header("location: login.php");
    }
} else {
    header("location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cerrar'])) {
    session_destroy();
    header("location: login.php");
}
include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/proyectodwsl/assets/css/style.css">
    <!--ICONOS-->
    <link rel="stylesheet" href="http://localhost/proyectodwsl/assets/css/all.min.css">
    <!--CSS AdminLTE-->
    <link rel="stylesheet" href="http://localhost/proyectodwsl/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="http://localhost/proyectodwsl/assets/css/adminlte.min.css.map">
    <!--Toggle-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body class="sidebar-collapse">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <input id="a" type="checkbox" data-on="Claro" data-off="Oscuro" checked data-toggle="toggle" data-onstyle="light" data-offstyle="dark" data-size="xs">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i data-toggle="toggle" class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!--Seccion para cerrar sesion-->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header" id="user">
                            <img src="http://localhost/proyectodwsl/assets/img/logo.png" class="img-fluid" alt="User Image">
                            <p>Nombre<small>USUARIO</small></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <form method="POST" action="index.php">
                                <div class="row d-flex justify-content-around">
                                    <a id="btnEnviarU" class="col-5 rounded-pill text-center form-control" type="submit"><i class="fas fa-user"></i> Ver perfil</a>
                                    <input type="text" hidden name="cerrar" id="" value="cerrar">
                                    <button id="btnRegresar" class="col-5 rounded-pill  text-center form-control" type="submit"><i class="fas fa-arrow-circle-right"></i> Salir</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="http://localhost/proyectodwsl/assets/img/logo.png" alt="UNIVO Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="http://localhost/proyectodwsl/assets/img/user-default.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block"><?= $usuarioingresado ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
			 with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./index.html" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./index2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./index3.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="main">

            <div id="alert">

            </div>
            <div class="row mx-2">
                <?php
                $ver = isset($_POST['ver']) ? $_POST['ver'] : '';
                $proyectoU = "Select p.id_proyecto_universidad, p.nombre_proyecto, p.descripcion, p.fecha_inicio, p.fecha_final_estimada, p.fecha_finalizado, u.nombre_usuario, tp.nombre_tipo_proyecto, c.nombre_carrera, ep.estado
                from tbl_proyecto_universidad as p 
                inner join tbl_super_administrador as u on p.id_usuario = u.id_usuario
                inner join tbl_tipo_proyecto as tp on p.id_tipo_proyecto = tp.id_tipo_proyecto
                inner join tbl_carreras as c on p.id_carrera = c.id_carrera
                inner join tbl_estado_proyectos as ep on p.id_estado = ep.id_estado
                where id_proyecto_universidad = " . $ver;

                $ejecutable = $conexion->prepare($proyectoU);
                $ejecutable->execute();
                $proyectos = $ejecutable->fetchAll(PDO::FETCH_OBJ);

                $nr = $ejecutable->RowCount();
                if ($nr == 1) {
                ?>

                    <div class="col-md-12 mt-2">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th><?= $proyectos[0]->id_proyecto_universidad ?></th>
                                    <th scope="col" colspan="3">Informacion general sobre el proyecto</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered">
                                <tr>
                                    <th width="25%">Nombre del proyecto</th>
                                    <td width="25%"><?= $proyectos[0]->nombre_proyecto ?></td>
                                    <th width="25%">Registrado por: </th>
                                    <td width="25%"><?= $proyectos[0]->nombre_usuario ?></td>
                                </tr>
                                <tr>
                                    <th width="25%">Descripcion</th>
                                    <td width="25%" colspan="3"><?= $proyectos[0]->descripcion ?></td>
                                </tr>
                                <tr>
                                    <th width="25%">Fecha de inicio:</th>
                                    <td width="25%"><?= $proyectos[0]->fecha_inicio ?></td>
                                    <th width="25%">Fecha estimada de finalizacion:</th>
                                    <td width="25%"><?= $proyectos[0]->fecha_final_estimada ?></td>
                                </tr>
                                <tr>
                                    <th width="25%">Tipo de proyecto:</th>
                                    <td width="25%"><?= $proyectos[0]->nombre_tipo_proyecto ?></td>
                                    <th width="25%">Especialidad del proyecto:</th>
                                    <td width="25%"><?= $proyectos[0]->nombre_carrera ?></td>
                                </tr>
                                <tr>
                                    <th width="25%">Fecha de finalizacion de proyecto:</th>
                                    <td width="25%"><?= $proyectos[0]->fecha_finalizado ?></td>
                                    <th width="25%">Estado del proyecto:</th>
                                    <td width="25%" class="text-center" id="status">
                                        <?php
                                        if (strtolower($proyectos[0]->estado) == "sin asignar") {
                                            echo '<div class="container rounded bg-danger" style="width:7rem;">' . $proyectos[0]->estado . '</div>';
                                        } else if (strtolower($proyectos[0]->estado) == "en proceso") {
                                            echo '<div class="container rounded bg-info" style="width:7rem;">' . $proyectos[0]->estado . '</div>';
                                        } else if (strtolower($proyectos[0]->estado) == "en pausa") {
                                            echo '<div class="container rounded bg-warning" style="width:7rem;">' . $proyectos[0]->estado . '</div>';
                                        } else if (strtolower($proyectos[0]->estado) == "finalizado") {
                                            echo '<div class="container rounded bg-primary" style="width:7rem;">' . $proyectos[0]->estado . '</div>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-danger align-self-start" onclick="history.back()">Regresar</button>
                                <form class="d-flex justify-content-center" action="../../../FPDF/individual-universidad.php" target="_blank" method="post">
                                    <input type="number" hidden name="id_universidad" value="<?= $proyectos[0]->id_proyecto_universidad ?>">
                                    <input type="submit" value="Generar pdf" id="pdf" class="btn btn-secondary rounded">
                                </form>
                                <?php
                                if (strtolower($proyectos[0]->estado) == "finalizado") {
                                ?>
                                <?php
                                } else {
                                ?>
                                    <button type="button" class="btn btn-primary" id="finalizar-proyecto" data-id-proyecto-fin="<?= $ver ?>">Finalizar proyecto</button>
                                <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    //Seleccionamos todos los postulantes aplicados a este proyecto en especifico
                    $selectPostulantesUniversidad = isset($_POST['ver']) ? $_POST['ver'] : '';
                    $postulante = "
                    Select 
                        p.id_postulacion_universidad, p.id_estado_postulacion,
                        est.carnet, est.id_estudiante, est.nombre_estudiante, est.correo_electronico, est.edad, ca.nombre_carrera 
                    from tbl_postulante_universidad as p 
                    inner join tbl_estudiantes as est on p.id_estudiante = est.id_estudiante 
                    inner join tbl_carreras as ca on est.id_carrera = ca.id_carrera 
                    where id_proyecto_universidad = 
                    " . $ver;
                    $ejecutable = $conexion->prepare($postulante);
                    $ejecutable->execute();
                    $postulaciones = $ejecutable->fetchAll(PDO::FETCH_OBJ);



                    $nr2 = $ejecutable->RowCount();
                    if ($nr2 > 0) {
                    ?>
                        <div class="col-md-12 mt-2">
                            <h1 class="lead text-center bg-primary border mb-0">Postulantes del proyecto - <?= $proyectos[0]->nombre_proyecto ?></h1>
                            <table class="table table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th width="10%">Carnet</th>
                                        <th width="20%">Nombre</th>
                                        <th width="20%">Correo electronico</th>
                                        <th width="10%">Edad</th>
                                        <th width="20%" class="text-center">Acciones/Estados</th>
                                    </tr>
                                </thead>
                                <tbody class="table-bordered">
                                    <?php
                                    foreach ($postulaciones as $p) {
                                    ?>
                                        <tr>
                                            <th><?= $p->carnet ?></th>
                                            <td><?= $p->nombre_estudiante ?></td>
                                            <td><?= $p->correo_electronico ?></td>
                                            <td><?= $p->edad ?></td>
                                            <td class="bg-ligh">
                                                <?php
                                                if ($p->id_estado_postulacion == 1) {
                                                ?>
                                                    <div class="container rounded bg-primary text-center" style="width:7rem;">Aceptado</div>
                                                <?php
                                                } else if ($p->id_estado_postulacion == 2) {
                                                ?>
                                                    <div class="container rounded bg-danger text-center" style="width:7rem;">Rechazado</div>
                                                <?php
                                                } else { ?>
                                                    <div class="d-flex justify-content-around" id="content-button-<?= $p->id_estudiante ?>">
                                                        <button type="button" id="postulacionAceptar" data-id-estudiante="<?= $p->id_estudiante ?>" data-proyecto="<?= $ver; ?>" class="btn btn-primary">
                                                            <i class="fas fa-check"></i> Aceptar
                                                        </button>
                                                        <button type="button" id="postulacionRechazar" data-id-estudiante="<?= $p->id_estudiante ?>" data-proyecto="<?= $ver; ?>" class="btn btn-danger">
                                                            <i class="fas fa-times"></i> Rechazar
                                                        </button>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-md-12 mt-2 d-flex flex-column justify-content-center">
                            <h1 class="text-center">No existe postulantes para este proyecto</h1>
                        </div>
                    <?php
                    }
                    ?>
                <?php
                } else {
                ?>
                    <div class="col-md-12 mt-2 d-flex flex-column justify-content-center">
                        <h1 class="text-center">No existe este registro...</h1>
                        <a href="index.php" class="btn btn-danger rounded align-self-center mt-4" style="width: 20rem;">Regresar</a>
                    </div>
                <?php
                } ?>
            </div>
        </div>

        <!--TOGGLE-->
        <script src="http://localhost/proyectodwsl/assets/js/bootstrap4-toggle.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <!--JS PARA AdminLTE-->
        <script src="http://localhost/proyectodwsl/assets/js/bootstrap.bundle.min.js"></script>
        <script src="http://localhost/proyectodwsl/assets/js/bootstrap.bundle.min.js.map"></script>
        <script src="http://localhost/proyectodwsl/assets/js/adminlte.min.js"></script>
        <script src="http://localhost/proyectodwsl/assets/js/adminlte.min.js.map"></script>
        <script src="http://localhost/proyectodwsl/assets/js/changeBColor.js"></script>
        <script src="http://localhost/proyectodwsl/assets/js/alert.js"></script>
        <script src="http://localhost/proyectodwsl/assets/js/aceptarPostulacionUniversidad.js"></script>
        <script src="http://localhost/proyectodwsl/assets/js/rechazarPostulacionUniversidad.js"></script>
</body>

</html>