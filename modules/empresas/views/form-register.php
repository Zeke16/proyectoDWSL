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
                    <div class="card-header d-flex justify-content-start" id="header-logEmp">
                        <img class="mt-2" src="http://localhost/proyectodwsl/assets/icon/user-plus-solid.svg" width="40xp" height="40px" id="emp" alt="">&nbsp;&nbsp;
                        <h2 class="card-title mt-2">Crear nueva empresa</h2>
                    </div>
                    <div class="card-body" id="body-logEmp">
                        <form method="POST" action="http://localhost/proyectodwsl/modules/empresas/controllers/EmpresasController.php" class="mb-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Escribe el nombre de la empresa:</label><br>
                                    <input class="form-control mt-2" type="text" name="action" value="create" hidden />
                                    <input class="form-control mt-2" type="text" name="nombreEmpresa" placeholder="Ingresar nombre de la empresa" required /><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Escribe el NRC:</label><br>
                                    <input class="form-control mt-2" type="number" name="nrc" placeholder="Ingresar NRC" required /><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Escribe la direccion:</label><br>
                                    <textarea class="form-control mt-2" maxlength="255" rows="1" name="direccion" placeholder="Ingresar direccion" required></textarea><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Escribe el numero de telefono:</label><br>
                                    <input class="form-control mt-2" type="number" name="telefono" placeholder="Ingresar telefono" required></input><br>
                                </div>
                                <div class="col-md-6">
                                    <label>Selecciona el departamento:</label><br>
                                    <select class="form-select mt-2" name="id_departamento" required id="id_departamento">
                                        <option value="0">- Seleccionar departamento-</option>
                                        <?php
                                        include_once($_SERVER["DOCUMENT_ROOT"] . '/proyectodwsl/assets/db/conexion.php');
                                        $depQuery = "Select * from tbldepartamentos";
                                        $ejecutable = $conexion->prepare($depQuery);
                                        $ejecutable->execute();
                                        $departamentos = $ejecutable->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($departamentos as $dep) {
                                        ?>
                                            <option value="<?= $dep->id_departamento ?>"><?= $dep->nombre ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Selecciona el municipio:</label><br>
                                    <select disabled class="form-select mt-2" name="id_municipio" id="id_municipio" required>
                                        <option value="0">- Seleccionar municipio-</option>
                                    </select><br>
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
                                    <input class="rounded-pill form-control" type="submit" name="btnIngresar" id="btnEnviarEmp" value="Crear" /><br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- LINK DE JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="http://localhost/proyectodwsl/assets/js/selectDep.js"></script>

</body>

</html>