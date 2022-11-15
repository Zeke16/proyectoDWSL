<?php
$editar = isset($_POST['editar']) ? $_POST['editar'] : '';
if($editar != ''){
    echo $editar;
}
?>