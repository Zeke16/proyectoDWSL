<?php
//manejo de session existente, en caso de no existir se regresa al login
session_start();
if ((isset($_SESSION['administrador']) && isset($_SESSION['id_user'])) || (isset($_SESSION['empresa']) && isset($_SESSION['id_empresa']))) {
    $admin = isset($_SESSION['administrador']) ? $_SESSION['administrador'] : '';
    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';
    $empresa = isset($_SESSION['empresa']) ? $_SESSION['empresa'] : '';
    $id_empresa = isset($_SESSION['id_empresa']) ? $_SESSION['id_empresa'] : '';
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
                    <a href="
                    <?php
                    if (isset($_SESSION['administrador'])) {
                        echo '../../universidad/views/index.php';
                    } else if (isset($_SESSION['empresa'])) {
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
            <?php
            $editar = isset($_POST['editar']) ? $_POST['editar'] : '';
            $proyectoEmp = "Select * from tbl_proyecto_empresas where id_proyecto_empresa = " . $editar;
            $ejecutable = $conexion->prepare($proyectoEmp);
            $ejecutable->execute();
            $proyectos = $ejecutable->fetchAll(PDO::FETCH_OBJ);
            $nr = $ejecutable->RowCount();
            if ($nr == 1 && isset($_SESSION['administrador'])) {
            ?>
                <div class="row mx-2">
                    <div class="col-md-12">
                        <form class="p-3 border border-dark  rounded mt-4" method="post" action="../../empresas/controllers/EmpresasController.php">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal-header">
                                        <h5><i class="fas fa-edit"></i> Editando proyecto <i class="fas fa-angle-right"></i> <?= $proyectos[0]->nombre_proyecto ?></h5>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="nombreProyecto">Escribe el nombre del proyecto:</label>
                                    <input class="form-control mt-2" hidden type="text" name="action" value="edit">
                                    <input class="form-control mt-2" type="text" name="nombreProyecto" value="<?= $proyectos[0]->nombre_proyecto ?>" id="nombreProyecto">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="fechaInit">Selecciona la fecha de inicio:</label>
                                    <input class="form-control mt-2" hidden type="text" name="id_proyecto" value="<?= $editar ?>">
                                    <?php
                                    if (isset($_SESSION['administrador'])) {
                                        echo '<input class="form-control mt-2" hidden type="text" name="admin" value="' . $_SESSION['administrador'] . '">';
                                    } else if (isset($_SESSION['empresa'])) {
                                        echo '<input class="form-control mt-2" hidden type="text" name="empresa" value="' . $_SESSION['empresa'] . '">';
                                    }
                                    ?>
                                    <input class="form-control mt-2" type="date" value="<?= $proyectos[0]->fecha_inicio ?>" name="fechaInit" id="fechaInit">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="fechaEsti">Selecciona la fecha de finalizacion estimada:</label>
                                    <input class="form-control mt-2" type="date" name="fechaEsti" value="<?= $proyectos[0]->fecha_final_estimada ?>" id="fechaEsti">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="carrera">Selecciona la empresa para el proyecto:</label><br>
                                    <select class="form-control mt-2" name="id_empresa" required id="id_empresa">
                                        <option value="0">- Seleccionar empresa-</option>
                                        <?php
                                        $empresa = "Select * from tbl_empresas";
                                        $ejecutable = $conexion->prepare($empresa);
                                        $ejecutable->execute();
                                        $empresas = $ejecutable->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($empresas as $emp) {
                                            if ($emp->id_empresa == $proyectos[0]->id_empresa) {
                                                echo '<option selected value="' . $emp->id_empresa . '">' . $emp->nombre_empresa . '</option>';
                                            } else {
                                        ?>
                                                <option value="<?= $emp->id_empresa ?>"><?= $emp->nombre_empresa ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="tipoProyecto">Selecciona el tipo de proyecto:</label><br>
                                    <select class="form-control mt-2" name="tipoProyecto" required id="tipoProyecto">
                                        <option value="0">- Seleccionar tipo de proyecto-</option>
                                        <?php
                                        $tipo = "Select * from tbl_tipo_proyecto";
                                        $ejecutable = $conexion->prepare($tipo);
                                        $ejecutable->execute();
                                        $tiposP = $ejecutable->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($tiposP as $tipo) {
                                            if ($tipo->id_tipo_proyecto == $proyectos[0]->id_tipo_proyecto) {
                                                echo '<option selected value="' . $tipo->id_tipo_proyecto . '">' . $tipo->nombre_tipo_proyecto . '</option>';
                                            } else {
                                        ?>
                                                <option value="<?= $tipo->id_tipo_proyecto ?>"><?= $tipo->nombre_tipo_proyecto ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label for="carrera">Selecciona la carrera para el proyecto:</label><br>
                                    <select class="form-control mt-2" name="carrera" required id="carrera">
                                        <option value="0">- Seleccionar carrera-</option>
                                        <?php
                                        $carrera = "Select * from tbl_carreras";
                                        $ejecutable = $conexion->prepare($carrera);
                                        $ejecutable->execute();
                                        $carreras = $ejecutable->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($carreras as $ca) {
                                            if ($ca->id_carrera == $proyectos[0]->id_carrera) {
                                                echo '<option selected value="' . $ca->id_carrera . '">' . $ca->nombre_carrera . '</option>';
                                            } else {
                                        ?>
                                                <option value="<?= $ca->id_carrera ?>"><?= $ca->nombre_carrera ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="descripcion">Escribe la descripcion del proyecto:</label>
                                    <textarea rows="1" class="form-control mt-2" type="text" name="descripcion" id="descripcion"><?= $proyectos[0]->descripcion ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" onclick="history.back()">Regresar</button>
                                        <button type="submit" class="btn btn-warning">Actualizar</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            <?php
            } else if ($nr == 1 && isset($_SESSION['empresa'])) {
            ?>
                <div class="row mx-2">
                    <div class="col-md-12">
                        <form class="p-3 border border-dark  rounded mt-4" action="http://localhost/proyectodwsl/modules/empresas/controllers/EmpresasController.php" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal-header">
                                        <h5><i class="fas fa-edit"></i> Editando proyecto <i class="fas fa-angle-right"></i> <?= $proyectos[0]->nombre_proyecto ?></h5>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="nombreProyecto">Escribe el nombre del proyecto:</label>
                                    <input class="form-control mt-2" hidden type="text" name="action" value="edit">
                                    <input class="form-control mt-2" hidden type="text" name="id_empresa" value="<?=$id_empresa?>">
                                    <?php
                                    if (isset($_SESSION['administrador'])) {
                                        echo '<input class="form-control mt-2" hidden type="text" name="admin" value="' . $_SESSION['administrador'] . '">';
                                    } else if (isset($_SESSION['empresa'])) {
                                        echo '<input class="form-control mt-2" hidden type="text" name="empresa" value="' . $_SESSION['empresa'] . '">';
                                    }
                                    ?>
                                    <input class="form-control mt-2" type="text" name="nombreProyecto" value="<?= $proyectos[0]->nombre_proyecto ?>" id="nombreProyecto">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="fechaInit">Selecciona la fecha de inicio:</label>
                                    <input class="form-control mt-2" hidden type="text" name="id_proyecto" value="<?= $editar ?>">
                                    <input class="form-control mt-2" type="date" value="<?= $proyectos[0]->fecha_inicio ?>" name="fechaInit" id="fechaInit">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="fechaEsti">Selecciona la fecha de finalizacion estimada:</label>
                                    <input class="form-control mt-2" type="date" name="fechaEsti" value="<?= $proyectos[0]->fecha_final_estimada ?>" id="fechaEsti">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="tipoProyecto">Selecciona el tipo de proyecto:</label><br>
                                    <select class="form-control mt-2" name="tipoProyecto" required id="tipoProyecto">
                                        <option value="0">- Seleccionar tipo de proyecto-</option>
                                        <?php
                                        $tipo = "Select * from tbl_tipo_proyecto";
                                        $ejecutable = $conexion->prepare($tipo);
                                        $ejecutable->execute();
                                        $tiposP = $ejecutable->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($tiposP as $tipo) {
                                            if ($tipo->id_tipo_proyecto == $proyectos[0]->id_tipo_proyecto) {
                                                echo '<option selected value="' . $tipo->id_tipo_proyecto . '">' . $tipo->nombre_tipo_proyecto . '</option>';
                                            } else {
                                        ?>
                                                <option value="<?= $tipo->id_tipo_proyecto ?>"><?= $tipo->nombre_tipo_proyecto ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="carrera">Selecciona la carrera para el proyecto:</label><br>
                                    <select class="form-control mt-2" name="carrera" required id="carrera">
                                        <option value="0">- Seleccionar carrera-</option>
                                        <?php
                                        $carrera = "Select * from tbl_carreras";
                                        $ejecutable = $conexion->prepare($carrera);
                                        $ejecutable->execute();
                                        $carreras = $ejecutable->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($carreras as $ca) {
                                            if ($ca->id_carrera == $proyectos[0]->id_carrera) {
                                                echo '<option selected value="' . $ca->id_carrera . '">' . $ca->nombre_carrera . '</option>';
                                            } else {
                                        ?>
                                                <option value="<?= $ca->id_carrera ?>"><?= $ca->nombre_carrera ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="descripcion">Escribe la descripcion del proyecto:</label>
                                    <textarea rows="1" class="form-control mt-2" type="text" name="descripcion" id="descripcion"><?= $proyectos[0]->descripcion ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" onclick="history.back()">Regresar</button>
                                        <button type="submit" class="btn btn-warning">Actualizar</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            <?php
            } else { ?>
                <div class="row mx-2">
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
</body>

</html>