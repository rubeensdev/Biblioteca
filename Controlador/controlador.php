<?php
session_start();

include '../Modelo/Query.php';

$resultado = null;
$query = new Query();

$accionARealizar = null;
if (isset($_GET['accion'])) {
    $accionARealizar = $_GET['accion'];
} else if (isset($_POST['accion'])) {
    $accionARealizar = $_POST['accion'];
}


if ($accionARealizar == 'login') {
    $datos = array(
        'nombre' => $_POST['nombre'],
        'pass' => $_POST['contrasena']
    );
    $resultado = $query->select('usuarios', $datos, 1);
    //echo $resultado."<br>";
    if ($resultado) {
        //echo 'Usuario encontrado';
        header('Location: ../Vista/panelUsuario.php');
        $_SESSION['nombre'] = $_POST['nombre'];
        $_SESSION['contrasena'] = $_POST['contrasena'];

    } else {
        //echo 'Usuario no encontrado';
        header('Location: ../Vista/VistaUsuario.html');
    }
} else if ($accionARealizar == 'mostrarTablas') {
    if (($_POST['filtro']) != null) {
        $datos = array(
            'titulo' => $_POST['filtro'],
            'autores' => $_POST['filtro'],
            'materia' => $_POST['filtro'],

        );
        $resultado = $query->select('documento', $datos);
    } else {
        $resultado = $query->select('documento', null);
    }

    $textoAImprimir = "<table><tr><th>Titulo</th><th>Autores</th><th>Fecha de publicacion</th><th>Descripcion</th><th>Materia</th></tr>";
    foreach ($resultado as $valor) {
        $textoAImprimir .= "<tr>";
        $textoAImprimir .= "<td>" . $valor["titulo"] . "</td>";
        $textoAImprimir .= "<td>" . $valor["autores"] . "</td>";
        $textoAImprimir .= "<td>" . $valor["fechaPublicacion"] . "</td>";
        $textoAImprimir .= "<td>" . $valor["descripcion"] . "</td>";
        $textoAImprimir .= "<td>" . $valor["materia"] . "</td>";
        $textoAImprimir .= "</tr>";
    }
    $textoAImprimir .= "</table>";
    header("Location: ../Vista/vistaDocumentos.php?tabla=" . $textoAImprimir);

}
?>