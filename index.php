<?php
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://localhost/proyectodwsl/assets/css/style.css?r=<?php echo (rand()); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

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
    <div class="container d-flex justify-content-center">
        <div class="jumbotron rounded m-1 p-2" id="intro">

            <h1>Bienvenid@:</h1>
            <p class="lead">Este sitio web esta dedicado a los estudiantes que deseen iniciar su servicio social y no poseen conocimiento sobre 
                que proyectos se encuentran disponibles.
                <br><br>
                Nuestra principal meta como equipo es que nuestro sitio web pueda mostrar de una manera sencilla y amigable todas las
                opciones de proyectos por los que puedes optar.
            </p>
            <hr class="my-4">
            <i>Para poder ver los proyectos disponibles debes logearte en el sitio web y acceder a traves del login que corresponde.</i>
            
        </div>
    </div>
    <div class="container mt-2 p-2 d-flex justify-content-center" id="content">
        <div class="row">
            <div class="col-md-12 d-flex" id="cards-content">
                <div class="col-md-4 col-sm-12 m-2">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid" id="titulos-card">Inicia sesion como administrador!</i>
                        </div>
                        <img class="img-fluid" src="assets/img/universidad.jpg" alt="">&nbsp;&nbsp;
                        <div class="card-body">
                            <h5 class="card-title">Haz clic en este boton para acceder</h5>
                            <a href="http://localhost/proyectodwsl/modules/universidad/views/login.php" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 m-2">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid" id="titulos-card">Inicia sesion como una empresa!</i>
                        </div>
                        <img class="img-fluid" src="assets/img/empresas.jpg" alt="">&nbsp;&nbsp;

                        <div class="card-body">
                            <h5 class="card-title">Haz clic en este boton para acceder</h5>
                            <a href="http://localhost/proyectodwsl/modules/empresas/views/login.php" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 m-2">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid" id="titulos-card">Inicia sesion como estudiante!</i>
                        </div>
                        <img class="img-fluid" src="assets/img/estudiantes.png" alt="">&nbsp;&nbsp;

                        <div class="card-body">
                            <h5 class="card-title">Haz clic en este boton para acceder</h5>
                            <a href="http://localhost/proyectodwsl/modules/estudiantes/views/login.php" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="http://localhost/proyectodwsl/assets/js/content.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>

</html>