<?php
session_start();
if (isset($_SESSION['administrador']) && isset($_SESSION['id'])) {
	$usuarioingresado = $_SESSION['administrador'];
	$id = $_SESSION['id'];
} else {
	header("location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
			<div class="jumbotron">
				<h1>Bienvenido: <?= $usuarioingresado ?></h1>
				<p class="lead">Aca podras encontrar todos los proyectos creados por empresas y por la universidad</p>
				<hr class="my-4">
				<p>Puedes crear nuevos proyecto desde aqui:</p>
				<button type="button" class="btn btn-primary btn-md" role="button" data-toggle="modal" data-target="#crearProyectU"><i class="fas fa-plus"></i> Crear nuevo proyecto</button>
			</div>
			<div class="row mx-2 ">
				<div class="col-md-6">
					<div id="carouselProyectU" class="carousel slide rounded mt-2" data-interval="false" data-ride="carousel">
						<div class="carousel-inner ">
							<?php
							$proyectoU = "Select * from tbl_proyecto_universidad";
							$ejecutable = $conexion->prepare($proyectoU);
							$ejecutable->execute();
							$proyectos = $ejecutable->fetchAll(PDO::FETCH_OBJ);
							$nr = $ejecutable->RowCount();
							for ($i = 0; $i < $nr; $i++) {
							?>
								<div class="carousel-item col-md-12 mt-2">
									<div class="card" id="cardP">
										<div class="card-header d-flex justify-content-start" id="header-logU">
											<h5>#<?= $proyectos[$i]->id_proyecto_universidad . " " .
														$proyectos[$i]->nombre_proyecto; ?></h5>
										</div>
										<div class="card-body" id="body-logU">
											<div class="row">
												<div class="col-md-12">
													<p><?= $proyectos[$i]->descripcion; ?></p>
												</div>
											</div>
										</div>
										<div class="card-footer" id="footer-logU">
											<div class="row">
												<div class="col-md-4">
													<form class="d-flex justify-content-center" action="update.php" method="post">
														<input type="number" hidden name="editar" value="<?= $proyectos[$i]->id_proyecto_universidad ?>">
														<input type="submit" value="Editar" id="btnCard" class="btn btn-warning rounded border border-dark">
													</form>
												</div>
												<div class="col-md-4">
													<form class="d-flex justify-content-center" action="delete.php" method="post">
														<input type="number" hidden name="ver" value="<?= $proyectos[$i]->id_proyecto_universidad ?>">
														<input type="submit" value="Ver" id="btnCard" class="btn btn-success rounded border border-dark">
													</form>
												</div>
												<div class="col-md-4">
													<form class="d-flex justify-content-center" action="http://localhost/proyectodwsl/FPDF/individual.php" method="post">
														<input type="number" hidden name="id_universidad" value="<?= $proyectos[$i]->id_proyecto_universidad ?>">
														<input type="submit" value="Generar pdf" id="pdf" class="btn btn-secondary rounded border border-dark">
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php
							}
							?>
							<div class="carousel-item active col-md-12 mt-2">
								<div class="card" id="cardP">
									<div class="card-header d-flex justify-content-start" id="header-logU">
										<h5>Proyectos propuestos por la universidad</h5>
									</div>
									<div class="card-body" id="body-logU">
										<img id="imgP" src="http://localhost/proyectodwsl/assets/img/universidad.jpg" alt="">&nbsp;&nbsp;
									</div>
								</div>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselProyectU" role="button" data-slide="prev">
						<span class="fas fa-angle-left" id="previusU" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselProyectU" role="button" data-slide="next">
						<span class="fas fa-angle-right" id="nextU" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
				<div class="col-md-6">
					<div id="carouselProyectEmp" class="carousel slide rounded mt-2" data-interval="false" data-ride="carousel">
						<div class="carousel-inner ">
							<?php
							$proyectoE = "Select * from tbl_proyecto_empresas";
							$ejecutable = $conexion->prepare($proyectoE);
							$ejecutable->execute();
							$proyectos = $ejecutable->fetchAll(PDO::FETCH_OBJ);
							$nr = $ejecutable->RowCount();
							for ($i = 0; $i < $nr; $i++) {
							?>
								<div class="carousel-item col-md-12 mt-2">
									<div class="card" id="cardP">
										<div class="card-header d-flex justify-content-start" id="header-logEmp">
											<h5>#<?= $proyectos[$i]->id_proyecto_empresa . " " .
														$proyectos[$i]->nombre_proyecto; ?></h5>
										</div>
										<div class="card-body" id="body-logEmp">
											<div class="row">
												<div class="col-md-12">
													<p><?= $proyectos[$i]->descripcion; ?></p>
												</div>
											</div>
										</div>
										<div class="card-footer" id="footer-logU">
											<div class="row">
												<div class="col-md-4">
													<form class="d-flex justify-content-center" action="update.php" method="post">
														<input type="number" hidden name="editar" value="<?= $proyectos[$i]->id_proyecto_empresa ?>">
														<input type="submit" value="Editar" id="btnCard" class="btn btn-warning rounded border border-dark">
													</form>
												</div>
												<div class="col-md-4">
													<form class="d-flex justify-content-center" action="delete.php" method="post">
														<input type="number" hidden name="ver" value="<?= $proyectos[$i]->id_proyecto_empresa ?>">
														<input type="submit" value="Ver" id="btnCard" class="btn btn-success rounded border border-dark">
													</form>
												</div>
												<div class="col-md-4">
													<form class="d-flex justify-content-center" action="pdf.php" method="post">
														<input type="number" hidden name="id_empresa" value="<?= $proyectos[$i]->id_proyecto_empresa ?>">
														<input type="submit" value="Generar pdf" id="btnCard" class="btn btn-secondary rounded border border-dark">
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php
							}
							?>
							<div class="carousel-item active col-md-12 mt-2">
								<div class="card" id="cardP">
									<div class="card-header d-flex justify-content-start" id="header-logEmp">
										<h5>Proyectos propuestos por empresas</h5>
									</div>
									<div class="card-body" id="body-logEmp">
										<img id="imgP" src="http://localhost/proyectodwsl/assets/img/empresas.jpg" alt="">&nbsp;&nbsp;
									</div>
								</div>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselProyectEmp" role="button" data-slide="prev">
						<span class="fas fa-angle-left" id="previusEmp" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselProyectEmp" role="button" data-slide="next">
						<span class="fas fa-angle-right" id="nextEmp" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="crearProyectU" tabindex="-1" role="dialog" aria-labelledby="crearProyectULabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content ">
				<div class="modal-header">
					<h5 class="modal-title" id="crearProyectULabel"><i class="fas fa-file"></i> Crear nuevo proyecto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body ">
					<div class="row">
						<div class="col-md-12 ">
							<form action="http://localhost/proyectodwsl/modules/universidad/controllers/UniversidadController.php" method="post">
								<div class="row">
									<div class="col-md-12">
										<label for="nombreProyecto">Escribe el nombre del proyecto:</label>
										<input class="form-control mt-2" hidden type="text" name="action" value="create">
										<input class="form-control mt-2" type="text" name="nombreProyecto" id="nombreProyecto">
									</div>
									<div class="col-md-6 mt-2">
										<label for="fechaInit">Selecciona la fecha de inicio:</label>
										<input class="form-control mt-2" type="date" name="fechaInit" id="fechaInit">
									</div>
									<div class="col-md-6 mt-2">
										<label for="fechaEsti">Selecciona la fecha de finalizacion estimada:</label>
										<input class="form-control mt-2" hidden type="number" name="id" id="id" value="<?= $id ?>">
										<input class="form-control mt-2" type="date" name="fechaEsti" id="fechaEsti">
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
											?>
												<option value="<?= $tipo->id_tipo_proyecto ?>"><?= $tipo->nombre_tipo_proyecto ?></option>
											<?php
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
											?>
												<option value="<?= $ca->id_carrera ?>"><?= $ca->nombre_carrera ?></option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="col-md-12 mt-2">
										<label for="descripcion">Escribe la descripcion del proyecto:</label>
										<textarea rows="1" class="form-control mt-2" type="text" name="descripcion" id="descripcion"></textarea>
									</div>
									<div class="col-md-12">
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
											<button type="submit" class="btn btn-primary">Save changes</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
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
	<script src="http://localhost/proyectodwsl/assets/js/alert.js"></script>
</body>
<?php

if (isset($_SESSION['exito'])) {

	print("<script>alertRegistro()</script>");

	unset($_SESSION['exito']);
}
?>

</html>