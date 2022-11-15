<?php

session_start();

if ((isset($_SESSION['empresa']) && isset($_SESSION['id_empresa']))) {
	$empresa = isset($_SESSION['empresa']) ? $_SESSION['empresa'] : '';
    $id_empresa = isset($_SESSION['id_empresa']) ? $_SESSION['id_empresa'] : '';
	echo "
	<div class=\"jumbotron\">
  		
		<h1>Bienvenido: $empresa </h1>\"
  		<p class=\"lead\">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
		<hr class=\"my-4\">
		<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
		<a class=\"btn btn-primary btn-lg\" href=\"#\" role=\"button\">Learn more</a>
	</div>";
} else {
	header("location: login.php");
}

if (isset($_POST['btncerrar'])) {
	session_destroy();
	header("location: login.php");
}
?>

<link rel="stylesheet" href="login.css">

<body>
	<form method="POST">
		<input type="submit" value="Cerrar sesión" name="btncerrar" />
	</form>
</body>