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
					<?php
					$count = 0;
					//seleccionar los proyectos rechazados de empresas
					$query = "SELECT 
						p.id_postulacion_empresa, p.id_proyecto_empresa, p.id_estado_postulacion,
						pe.nombre_proyecto
						from tbl_postulante_empresas as p 
						inner join tbl_proyecto_empresas as pe on pe.id_proyecto_empresa = p.id_proyecto_empresa
						WHERE id_estudiante = " . $id_estudiante .
						" AND id_estado_postulacion = 2";
					$ejecutable = $conexion->prepare($query);
					$ejecutable->execute();
					//echo $query;
					$count += $ejecutable->rowCount();
					$rechazosEmp = $ejecutable->fetchAll(PDO::FETCH_OBJ);

					//seleccionar los proyectos rechazados de u
					$query = "SELECT 
						p.id_postulacion_universidad, p.id_proyecto_universidad, p.id_estado_postulacion,
						pe.nombre_proyecto
						from tbl_postulante_universidad as p 
						inner join tbl_proyecto_universidad as pe on pe.id_proyecto_universidad = p.id_proyecto_universidad
						WHERE id_estudiante = " . $id_estudiante .
						" AND id_estado_postulacion = 2";
					//echo $query;
					$ejecutable = $conexion->prepare($query);
					$ejecutable->execute();
					$count += $ejecutable->rowCount();
					$rechazosU = $ejecutable->fetchAll(PDO::FETCH_OBJ);

					//seleccionar los proyectos aceptados de empresas
					$query = "SELECT 
						p.id_postulacion_empresa, p.id_proyecto_empresa, p.id_estado_postulacion,
						pe.nombre_proyecto
						from tbl_postulante_empresas as p 
						inner join tbl_proyecto_empresas as pe on pe.id_proyecto_empresa = p.id_proyecto_empresa
						WHERE id_estudiante = " . $id_estudiante .
						" AND id_estado_postulacion = 1";
					$ejecutable = $conexion->prepare($query);
					$ejecutable->execute();
					//echo $query;
					$count += $ejecutable->rowCount();
					$aceptadoEmp = $ejecutable->fetchAll(PDO::FETCH_OBJ);

					//seleccionar los proyectos rechazados de u
					$query = "SELECT 
						p.id_postulacion_universidad, p.id_proyecto_universidad, p.id_estado_postulacion,
						pe.nombre_proyecto
						from tbl_postulante_universidad as p 
						inner join tbl_proyecto_universidad as pe on pe.id_proyecto_universidad = p.id_proyecto_universidad
						WHERE id_estudiante = " . $id_estudiante .
						" AND id_estado_postulacion = 1";
					//echo $query;
					$ejecutable = $conexion->prepare($query);
					$ejecutable->execute();
					$count += $ejecutable->rowCount();
					$aceptadoU = $ejecutable->fetchAll(PDO::FETCH_OBJ);


					?>
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge"><?= ($count) ? $count : '' ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-item dropdown-header"> Notificationes</span>

						<?php
						foreach ($rechazosEmp as $reject) {
						?>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fas fa-times mr-2 text-danger"></i>
								Has sido rechazado del proyecto<br>
								<b><u><?= $reject->nombre_proyecto ?></u></b>
							</a>
						<?php
						} ?>

						<?php
						foreach ($rechazosU as $reject) {
						?>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fas fa-times mr-2 text-danger"></i>
								Has sido rechazado del proyecto<br>
								<b><u><?= $reject->nombre_proyecto ?></u></b>
							</a>
						<?php
						} ?>

						<?php
						foreach ($aceptadoEmp as $reject) {
						?>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fas fa-check mr-2 text-primary"></i>
								Has sido aceptado en el proyecto<br>
								<b><u><?= $reject->nombre_proyecto ?></u></b>
							</a>
						<?php
						} ?>

						<?php
						foreach ($aceptadoU as $reject) {
						?>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fas fa-check mr-2 text-primary"></i>
								Has sido aceptado en el proyecto<br>
								<b><u><?= $reject->nombre_proyecto ?></u></b>
							</a>
						<?php
						} ?>
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
				<h1>Bienvenido: <?= $estudiante ?> - Interfaz de estudiante</h1>
				<p class="lead">Aca podras encontrar todos los proyectos disponibles para usted</p>
				<hr class="my-4">
				<p class="lead">Puedes aplicar al proyecto que desees desde aqui:</p>

			</div>
			<div class="row mx-2">
				<div class="col-md-12">
					<div id="carouselProyectU" class="carousel slide rounded mt-2" data-interval="false" data-ride="carousel">
						<div class="carousel-inner ">
							<?php
							//Obtener la cantidad minima de la carrera a la que pertenece el usuario
							$numero_materias_carrera = "Select * from tbl_carreras where id_carrera = " . $carrera;
							$materia = $conexion->prepare($numero_materias_carrera);
							$materia->execute();
							$materias = $materia->fetchAll(PDO::FETCH_OBJ);
							$materiasMinimas = $materias[0]->numero_materias / 2;

							//Saber si el usuario esta registrado en cierto proyecto, en caso de estarlo capturamos el id del proyecto postulado
							$postulado = "select id_proyecto_universidad from tbl_postulante_universidad  where id_estudiante = " . $id_estudiante;
							$existe = $conexion->prepare($postulado);
							$existe->execute();
							$existente = $existe->fetchAll(PDO::FETCH_OBJ);
							$postulados = array();

							//Guardamos todos los id de cada proyecto en el que el estudiante esta postulado
							foreach ($existente as $ex) {
								$postulados[] = $ex->id_proyecto_universidad;
							}

							//saber si es usuario ya posee un proyecto activo
							$activo = "SELECT * from tbl_postulante_empresas as p where p.id_estudiante =".$id_estudiante." AND p.id_estado_postulacion = 1";
							$existe = $conexion->prepare($activo);
							$existe->execute();
							$nActivoEmp = $existe->rowCount();
							
							$activo = "SELECT * from tbl_postulante_universidad as p where p.id_estudiante =".$id_estudiante." AND p.id_estado_postulacion = 1";
							$existe = $conexion->prepare($activo);
							$existe->execute();
							$nActivoU = $existe->rowCount();
							//Seleccionando los proyectos que pertenecen a la carrera del usuario
							$proyectoU = "Select * from tbl_proyecto_universidad where id_carrera = " . $carrera . " and id_estado = 1";
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
												<?php
												/**Si la cantidad de materias cursadas por el usuario son igual o mayor
												 * a la cantidad minima requerida de materias para aplicar a los proyectos
												 * es cierto, mostrara el siguiente contenido
												 * */
												if ($num_materias >= $materiasMinimas) {
													/**Si existe un proyecto activo, no permitira aplicar a otro proyecto, 
													 * en caso contrario, permitira aplicar como dejar de aplicar*/

													if ($nActivoEmp == 1 || $nActivoU == 1) {
														echo '';
													} else {
														/**Se revisa si el estudiante esta postulado en los proyectos,
														 * Si esta postulado mostramos un boton para dejar de postularnos
														 * En caso contrario nos permite aplicar al proyecto
														 */
														if (in_array($proyectos[$i]->id_proyecto_universidad, $postulados)) {

															echo '
														<div class="col-md-12 d-flex justify-content-center" id="apply-' . $proyectos[$i]->id_proyecto_universidad . '">
															<button type="button" class="btn btn-danger btn-md border border-dark" data-id-proyect="' . $proyectos[$i]->id_proyecto_universidad . '" data-id="' . $id_estudiante . '" id="noAplicar"><i class="fas fa-reply"></i> Dejar de aplicar</button>
														</div>';
														} else {
															echo '
														<div class="col-md-12 d-flex justify-content-center" id="apply-' . $proyectos[$i]->id_proyecto_universidad . '">
															<button type="button" class="btn btn-primary btn-md border border-dark" data-id-proyect="' . $proyectos[$i]->id_proyecto_universidad . '" data-id="' . $id_estudiante . '" id="aplicar"><i class="fas fa-envelope"></i>  Aplicar</button>
														</div>';
														}
													}
												} else {
													/**Si no se cumple la cantidad minima de materias no se podra
													 * postular al proyecto
													 */
												?>
													<div class="col-md-12">
														<h4 class="lean">No cumples con la cantidad minima de materias para aplicar a proyectos</h4>
													</div>
												<?php
												} ?>
											</div>
										</div>
									</div>
								</div>
							<?php
							}
							?>
							<?php
							//Saber si el usuario esta registrado en cierto proyecto, en caso de estarlo capturamos el id del proyecto postulado
							$postuladoEmpresa = "select id_proyecto_empresa from tbl_postulante_empresas where id_estudiante = " . $id_estudiante;
							$existeEmpresa = $conexion->prepare($postuladoEmpresa);
							$existeEmpresa->execute();
							$existenteEmpresa = $existeEmpresa->fetchAll(PDO::FETCH_OBJ);
							$postuladosEmpresa = array();

							//Guardamos todos los id de cada proyecto en el que el estudiante esta postulado
							foreach ($existenteEmpresa as $exEmpresa) {
								$postuladosEmpresa[] = $exEmpresa->id_proyecto_empresa;
							}
							$proyectoE = "Select * from tbl_proyecto_empresas where id_carrera = " . $carrera . " and id_estado = 1";
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
												<?php
												/**Si la cantidad de materias cursadas por el usuario son igual o mayor
												 * a la cantidad minima requerida de materias para aplicar a los proyectos
												 * es cierto, mostrara el siguiente contenido
												 * */
												if ($num_materias >= $materiasMinimas) {
													if ($nActivoU == 1 || $nActivoEmp == 1) {
														echo '';
													} else {
														/**Se revisa si el estudiante esta postulado en los proyectos,
														 * Si esta postulado mostramos un boton para dejar de postularnos
														 * En caso contrario nos permite aplicar al proyecto
														 */
														if (in_array($proyectos[$i]->id_proyecto_empresa, $postuladosEmpresa)) {
															echo '
														<div class="col-md-12 d-flex justify-content-center" id="apply-empresa-' . $proyectos[$i]->id_proyecto_empresa . '">
															<button type="button" class="btn btn-danger btn-md border border-dark" data-id-proyect="' . $proyectos[$i]->id_proyecto_empresa . '" data-id="' . $id_estudiante . '" id="noAplicarEmpresa"><i class="fas fa-reply"></i> Dejar de aplicar</button>
														</div>';
														} else {
															echo '
														<div class="col-md-12 d-flex justify-content-center" id="apply-empresa-' . $proyectos[$i]->id_proyecto_empresa . '">
															<button type="button" class="btn btn-primary btn-md border border-dark" data-id-proyect="' . $proyectos[$i]->id_proyecto_empresa . '" data-id="' . $id_estudiante . '" id="aplicarEmpresa"><i class="fas fa-envelope"></i>  Aplicar</button>
														</div>';
														}
													}
												} else {
													/**Si no se cumple la cantidad minima de materias no se podra
													 * postular al proyecto
													 */
												?>
													<div class="col-md-12">
														<h4 class="lean">No cumples con la cantidad minima de materias para aplicar a proyectos</h4>
													</div>
												<?php
												} ?>
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
										<h5>Proyectos disponibles</h5>
									</div>
									<div class="card-body" id="body-logU">
										<p class="lead">Este conjunto de proyectos estan enfocados en tu carrera</p>
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
				<div class="col-md-12">
					<div id="carouselProyectOtros" class="carousel slide rounded mt-2" data-interval="false" data-ride="carousel">
						<div class="carousel-inner ">
							<?php

							//Seleccionando los proyectos que pertenecen a la carrera del usuario
							$proyectoU = "Select * from tbl_proyecto_universidad where id_carrera != " . $carrera;
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
									</div>
								</div>
							<?php
							}
							?>
							<?php
							$proyectoE = "Select * from tbl_proyecto_empresas where id_carrera != " . $carrera;
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
									</div>
								</div>
							<?php
							}
							?>
							<div class="carousel-item active col-md-12 mt-2">
								<div class="card" id="cardP">
									<div class="card-header d-flex justify-content-start" id="header-logU">
										<h5>Proyectos de otras carreras</h5>
									</div>
									<div class="card-body" id="body-logU">
										<p class="lead">Este conjunto de proyectos estan enfocados en otras carreras, solo lectura</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselProyectOtros" role="button" data-slide="prev">
						<span class="fas fa-angle-left" id="previusU" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselProyectOtros" role="button" data-slide="next">
						<span class="fas fa-angle-right" id="nextU" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
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