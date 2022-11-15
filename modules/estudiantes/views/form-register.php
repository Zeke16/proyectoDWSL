<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://localhost/proyectodwsl/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
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
    <div class="container mt-2  p-2 d-flex justify-content-center" id="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="width: 40rem;">
                    <div class="card-header d-flex justify-content-start" id="header-logEst">
                        <img class="mt-2" src="http://localhost/proyectodwsl/assets/icon/user-plus-solid.svg" width="40xp" height="40px" id="emp" alt="">&nbsp;&nbsp;
                        <h2 class="card-title mt-2">Crear nuevo estudiante</h2>
                    </div>
                    <div class="card-body" id="body-logEst">
                        <form method="POST" action="http://localhost/proyectodwsl/modules/estudiantes/controllers/EstudiantesController.php" class="mb-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Escribe tu nombre:</label><br>
                                    <input class="form-control mt-2" type="text" name="nombreEstudiante" placeholder="Ingresar nombre del estudiante" required /><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Escribe tu edad:</label><br>
                                    <input class="form-control mt-2" type="number" name="edad" placeholder="Ingresar edad" required /><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Escribe tu direccion:</label><br>
                                    <textarea class="form-control mt-2" maxlength="255" rows="1" name="direccion" placeholder="Ingresar direccion" required></textarea><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Selecciona tu fecha de nacimiento:</label><br>
                                    <input class="form-control mt-2" type="date" name="fecha" placeholder="Seleccionar fecha" required/><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Escribe el numero de telefono:</label><br>
                                    <input class="form-control mt-2" type="number" name="telefono" placeholder="Ingresar telefono" required></input><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Escribe tu carnet:</label><br>
                                    <input class="form-control mt-2" type="text" name="carnet" placeholder="Ingresar carnet" required></input><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Escribe tu dui:</label><br>
                                    <input class="form-control mt-2" type="text" name="dui" placeholder="Ingresar dui" required></input><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Escribe el # de materias cursadas:</label><br>
                                    <input class="form-control mt-2" type="number" name="materias" placeholder="Ingresar # de materias" required></input><br>
                                </div>
                                <div class="col-md-12">
                                    <label>Selecciona la carrera:</label><br>
                                    <select class="form-select mt-2" name="carrera" required id="carrera">
                                        <option value="0">- Seleccionar carrera-</option>
                                        <?php
                                        include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
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
                                <div class="col-md-6">
                                    <label>Escribe el correo electrónico:</label><br>
                                    <input class="form-control mt-2" type="email" name="correo" placeholder="Ingrese correo" required></input><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Escribe la contraseña:</label><br>
                                    <input class="form-control mt-2" type="text" name="password" placeholder="Ingresar contraseña" required></input><br>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <button class="rounded-pill form-control" id="btnRegresar">Regresar</button>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <button class="rounded-pill form-control" type="submit" name="btnIngresar" id="btnEnviarEst">Crear</button><br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="http://localhost/proyectodwsl/assets/js/inputEmpresas.js"></script>
</body>

</html>