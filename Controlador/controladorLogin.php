<?php
include '../Modelo/Query.php';
echo $_SESSION['idUser']. "<br>";
$resultado = null;
$query = new Query();
$datos = array(
    'nombre' => $_POST['nombre'],
    'pass' => $_POST['contrasena']
);
$resultado = $query->select('usuarios', $datos,false);

var_dump($resultado);
 //echo $resultado."<br>";
if ($resultado) {
    //echo 'Usuario encontrado';
    header('Location: ../Vista/panelUsuario.php');
    $_SESSION['nombre'] = $_POST['nombre'];  
    $_SESSION['idUser'] = $resultado[0]['idUser'];
    $_SESSION['contrasena'] = $_POST['contrasena'];

} else {
    //echo 'Usuario no encontrado';
    header('Location: ../Vista/index.html');
} 