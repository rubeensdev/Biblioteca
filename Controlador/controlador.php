<?php

include '/../Modelo/Query.php';

$query = new Query();
$datos = array($_POST['nombre'], $_POST['contraseña']);
var_dump($datos);
$accionARealizar = $_POST['accion'];
if ($accionARealizar == 'login') {
    $datos = array($_POST['nombre'], $_POST['contraseña']);
    $query->select('usuarios', $datos);
}
?> 