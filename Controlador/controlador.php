<?php

include '/../Modelo/Query.php';

$query = new Query();
$datos = array($_POST['nombre'], $_POST['contraseña']);
var_dump($datos);
$accionARealizar = $_POST['accion'];
if ($accionARealizar == 'login') {
    $datos = array($_POST['nombre'], $_POST['contraseña']);
    $resultado->$query->select('usuarios', $datos);
    if ($resultado) {
        header('Location: ../Vista/logeoExitoso.php');
    } else {
        header('Location: ../Vista/VistaUsuario.php');
    }


}
?>