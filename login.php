<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <?php include_once('assets/css/links.php'); ?>
</head>

<body>
    <div class="row">
        <div class="col-md-6">
            <div class="card" style="width: 40rem;">
                <div class="card-header d-flex justify-content-start" id="header-logEmp">
                    <img class="mt-2" src="assets/icon/briefcase-solid.svg" width="40xp" height="40px" id="emp" alt="">&nbsp;&nbsp;
                    <h2 class="card-title mt-2">Inicio de sesion</h2>
                </div>
                <div class="card-body" id="body-logEmp">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Escribe el nombre de la empresa:</label><br>
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
                                <select class="form-select mt-2" required id="id_departamento">
                                    <option value="0">- Seleccionar departamento-</option>
                                    <?php
                                    include_once('assets/db/conexion.php');
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
                                <select class="form-select mt-2" id="id_municipio" required>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                                    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>