<?php
$envio = isset($_POST['envio']) ? $_POST['envio'] : '';
    
if (is_numeric($envio)) {
    selectMunicipios($envio);
}else if ($envio == 'alertRegistro') {
    alertRegistro();
}

function alertRegistro()
{
    echo '
    <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
        <div>
            <i class="fa-solid fa-triangle-exclamation"></i> &nbsp;&nbsp;USUARIO O CONTRASEÑA INCORRECTO!
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

function selectMunicipios($envio){
    include_once($_SERVER["DOCUMENT_ROOT"] .'/proyectodwsl/assets/db/conexion.php');
    $munQuery = "Select * from tblmunicipios where id_departamento = " . $envio;
    $ejecutable = $conexion->prepare($munQuery);
    $ejecutable->execute();
    $municipios = $ejecutable->fetchAll(PDO::FETCH_OBJ);
    $mun = array();
    foreach($municipios as $m){
        $nombre = $m->nombre;
        $id = $m->id_municipio;
        $mun[] = array("id_municipio" => $id, "nombre" => $nombre);
   }
   echo json_encode($mun);
}