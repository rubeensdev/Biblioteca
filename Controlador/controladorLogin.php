<?php
include '../Modelo/Query.php';

$resultado = null;
$query = new Query();
$datos = array(
    'nombre' => $_POST['nombre'],
    'pass' => $_POST['contrasena']
);
$resultado = $query->select('usuarios', $datos,false);
//echo $resultado."<br>";
if ($resultado) {
    //echo 'Usuario encontrado';
    header('Location: ../Vista/panelUsuario.php');
    $_SESSION['idUser'] = &resultado['idUser'];
    $_SESSION['nombre'] = $_POST['nombre'];
    $_SESSION['contrasena'] = $_POST['contrasena'];

} else {
    //echo 'Usuario no encontrado';
    header('Location: ../Vista/index.html');
}