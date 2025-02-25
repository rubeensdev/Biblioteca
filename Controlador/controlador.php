<?php
session_start();

include '../Modelo/Query.php';

$resultado = null;
$query = new Query();
$datos = array(
    'nombre' => $_POST['nombre'],
    'pass' => $_POST['contrasena']
);
//var_dump($datos)."<br>";
$accionARealizar = $_POST['accion'];

if ($accionARealizar == 'login') {
    $resultado = $query->select('usuarios', $datos);
    //echo $resultado."<br>";
    if ($resultado) {
        //echo 'Usuario encontrado';
        header('Location: ../Vista/loginExitoso.html');
        $_SESSION['nombre'] = $_POST['nombre'];
        $_SESSION['contrasena'] = $_POST['contrasena'];

    } else {
        //echo 'Usuario no encontrado';
        header('Location: ../Vista/VistaUsuario.html');
    }


}
?>