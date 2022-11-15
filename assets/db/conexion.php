<?php
try{
$conexion = new PDO('mysql:host=localhost;dbname=db_proyecto_dwsl;', 'root', '');
}catch(PDOException $e){
    echo $e;
}

?>