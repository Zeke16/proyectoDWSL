<?php
//manejo de session existente, en caso de no existir se regresa al login
session_start();
date_default_timezone_set('America/El_Salvador');
if ((isset($_SESSION['administrador']) && isset($_SESSION['id_user']))
    || (isset($_SESSION['estudiante']) && isset($_SESSION['id_estudiante'])
        && isset($_SESSION['num_materias'])
        && isset($_SESSION['carrera']))
) {
    $admin = isset($_SESSION['administrador']) ? $_SESSION['administrador'] : '';
    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';
    $estudiante = isset($_SESSION['estudiante']) ? $_SESSION['estudiante'] : '';
    $id_estudiante = isset($_SESSION['id_estudiante']) ? $_SESSION['id_estudiante'] : '';
    $num_materias = isset($_SESSION['num_materias']) ? $_SESSION['num_materias'] : '';
    $carrera = isset($_SESSION['carrera']) ? $_SESSION['carrera'] : '';
    //control de duracion de sesion
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
    <meta http-equiv="refresh" content="3600">
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
    <title><?= date("Y-m-d h:i:s", $_SESSION['end']); ?></title>
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
                    <a href="
                    <?php
                    if (isset($_SESSION['administrador'])) {
                        echo '../../universidad/views/index.php';
                    } else if (isset($_SESSION['estudiante'])) {
                        echo 'index.php';
                    } ?>" class="nav-link">Home</a>
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
                        <a class="d-block">
                            <?php
                            if ($admin != '') {
                                echo $_SESSION['administrador'];
                            } else if ($estudiante != '') {
                                echo $_SESSION['estudiante'];
                            }
                            ?></a>
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
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>
                                    Area personal
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./proyectos.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Mis proyectos</p>
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

            <div class="row mx-2">
                <div class="col-md-12 mt-2">
                    <h1 class="text-center">Proyectos por parte de la universidad</h1>
                    <?php
                    $proyectosPostulados = "SELECT * from tbl_postulante_universidad as pu
                    inner join tbl_proyecto_universidad as p on pu.id_proyecto_universidad = p.id_proyecto_universidad
                    inner join tbl_estado_postulaciones as ep on pu.id_estado_postulacion = ep.id_estado_postulacion
                    inner join tbl_tipo_proyecto as tp on p.id_tipo_proyecto = tp.id_tipo_proyecto
                    inner join tbl_carreras as c on p.id_carrera = c.id_carrera
                    where id_estudiante = " . $id_estudiante . " ORDER BY pu.id_proyecto_universidad";
                    //echo $proyectosPostulados;
                    $ejecutable = $conexion->prepare($proyectosPostulados);
                    $ejecutable->execute();
                    $proyectos = $ejecutable->fetchAll(PDO::FETCH_OBJ);
                    $nr1 = $ejecutable->rowCount();

                    $proyectosPostulados2 = "SELECT * from tbl_postulante_empresas as pe
                    inner join tbl_proyecto_empresas as p on pe.id_proyecto_empresa = p.id_proyecto_empresa
                    inner join tbl_estado_postulaciones as ep on pe.id_estado_postulacion = ep.id_estado_postulacion
                    inner join tbl_tipo_proyecto as tp on p.id_tipo_proyecto = tp.id_tipo_proyecto
                    inner join tbl_carreras as c on p.id_carrera = c.id_carrera
                    where id_estudiante = " . $id_estudiante . " ORDER BY pe.id_proyecto_empresa ASC";
                    //echo $proyectosPostulados2;
                    $ejecutable = $conexion->prepare($proyectosPostulados2);
                    $ejecutable->execute();
                    $proyectos2 = $ejecutable->fetchAll(PDO::FETCH_OBJ);
                    $nr2 = $ejecutable->rowCount();
                    //var_dump($proyectos2);
                    if ($nr1 > 0) {
                        foreach ($proyectos as $p1) {
                    ?>
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><?= $p1->id_proyecto_universidad ?></th>
                                        <th scope="col" colspan="3">Informacion general sobre el proyecto</th>
                                    </tr>
                                </thead>
                                <tbody class="table-bordered">
                                    <tr>
                                        <th width="25%">Nombre del proyecto</th>
                                        <td width="25%"><?= $p1->nombre_proyecto ?></td>
                                        <th width="25%">Estado de la postulacion</th>
                                        <td width="25%" class="text-center">
                                            <?php
                                            if ($p1->id_estado_postulacion == 2) {
                                                echo '<div class="container rounded bg-danger" style="width:7rem;">' . $p1->estado_postulacion . '</div>';
                                            } else if ($p1->id_estado_postulacion == 3) {
                                                echo '<div class="container rounded bg-info" style="width:7rem;">' . $p1->estado_postulacion . '</div>';
                                            } else if ($p1->id_estado_postulacion == 1) {
                                                echo '<div class="container rounded bg-success" style="width:7rem;">' . $p1->estado_postulacion . '</div>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="25%">Descripcion</th>
                                        <td width="25%" colspan="3"><?= $p1->descripcion ?></td>
                                    </tr>
                                    <tr>
                                        <th width="25%">Fecha de inicio:</th>
                                        <td width="25%"><?= $p1->fecha_inicio ?></td>
                                        <th width="25%">Fecha estimada de finalizacion:</th>
                                        <td width="25%"><?= $p1->fecha_final_estimada ?></td>
                                    </tr>
                                    <tr>
                                        <th width="25%">Tipo de proyecto:</th>
                                        <td width="25%"><?= $p1->nombre_tipo_proyecto ?></td>
                                        <th width="25%">Especialidad del proyecto:</th>
                                        <td width="25%"><?= $p1->nombre_carrera ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" onclick="history.back()">Regresar</button>
                                    <form class="d-flex justify-content-center" action="../../../FPDF/individual-universidad.php" target="_blank" method="post">
                                        <input type="number" hidden name="id_universidad" value="<?= $p1->id_proyecto_universidad ?>">
                                        <input type="submit" value="Generar pdf" id="pdf" class="btn btn-secondary rounded">
                                        <input type="number" hidden name="id_estudiante" value="<?= $id_estudiante?>">
                                    </form>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <h1 class="text-center">No existen registros para mostrar...</h1>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-12 mt-2">
                    <h1 class="text-center">Proyectos de empresas</h1>
                    <?php
                    if ($nr2 > 0) {
                        foreach ($proyectos2 as $p2) {
                    ?>
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th><?= $p2->id_proyecto_empresa ?></th>
                                        <th scope="col" colspan="3">Informacion general sobre el proyecto</th>
                                    </tr>
                                </thead>
                                <tbody class="table-bordered">
                                    <tr>
                                        <th width="25%">Nombre del proyecto</th>
                                        <td width="25%"><?= $p2->nombre_proyecto ?></td>
                                        <th width="25%">Estado de la postulacion</th>
                                        <td width="25%" class="text-center">
                                            <?php
                                            if ($p2->id_estado_postulacion == 2) {
                                                echo '<div class="container rounded bg-danger" style="width:7rem;">' . $p2->estado_postulacion . '</div>';
                                            } else if ($p2->id_estado_postulacion == 3) {
                                                echo '<div class="container rounded bg-info" style="width:7rem;">' . $p2->estado_postulacion . '</div>';
                                            } else if ($p2->id_estado_postulacion == 1) {
                                                echo '<div class="container rounded bg-success" style="width:7rem;">' . $p2->estado_postulacion . '</div>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="25%">Descripcion</th>
                                        <td width="25%" colspan="3"><?= $p2->descripcion ?></td>
                                    </tr>
                                    <tr>
                                        <th width="25%">Fecha de inicio:</th>
                                        <td width="25%"><?= $p2->fecha_inicio ?></td>
                                        <th width="25%">Fecha estimada de finalizacion:</th>
                                        <td width="25%"><?= $p2->fecha_final_estimada ?></td>
                                    </tr>
                                    <tr>
                                        <th width="25%">Tipo de proyecto:</th>
                                        <td width="25%"><?= $p2->nombre_tipo_proyecto ?></td>
                                        <th width="25%">Especialidad del proyecto:</th>
                                        <td width="25%"><?= $p2->nombre_carrera ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" onclick="history.back()">Regresar</button>
                                    <form class="d-flex justify-content-center" action="../../../FPDF/individual-empresa.php" target="_blank" method="post">
                                        <input type="number" hidden name="id_empresa" value="<?= $p2->id_proyecto_empresa?>">
                                        <input type="number" hidden name="id_estudiante" value="<?= $id_estudiante?>">
                                        <input type="submit" value="Generar pdf" id="pdf" class="btn btn-secondary rounded">
                                    </form>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <h1>No existen registros para mostrar...</h1>
                    <?php
                    } ?>

                </div>
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
        <script src="http://localhost/proyectodwsl/assets/js/applyProject.js"></script>
</body>
<?php

if (isset($_SESSION['exito'])) {

    print("<script>alertRegistro('crear')</script>");

    unset($_SESSION['exito']);
}

if (isset($_SESSION['editado'])) {

    print("<script>alertRegistro('editar')</script>");

    unset($_SESSION['editado']);
}

if (isset($_SESSION['eliminado'])) {

    print("<script>alertRegistro('eliminar')</script>");

    unset($_SESSION['eliminado']);
}
?>

</html>