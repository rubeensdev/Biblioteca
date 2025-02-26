<?php

include '../Modelo/Query.php';

$query = new Query();


$accionARealizar = null;
if (isset($_GET['accion'])) {
    $accionARealizar = $_GET['accion'];
} else if (isset($_POST['accion'])) {
    $accionARealizar = $_POST['accion'];
}

if ($accionARealizar == null) {

    $resultado = $query->select('documento', null, "prestamos");
    $textoAImprimir = "<table><tr><th>Titulo</th><th>Autores</th><th>Fecha de publicacion</th><th>Descripcion</th><th>Materia</th><th>Unidades disponibles</th></tr>";
    foreach ($resultado as $valor) {
        $textoAImprimir .= "<tr>";
        $textoAImprimir .= "<td>" . $valor["titulo"] . "</td>";
        $textoAImprimir .= "<td>" . $valor["autores"] . "</td>";
        $textoAImprimir .= "<td>" . $valor["fechaPublicacion"] . "</td>";
        $textoAImprimir .= "<td>" . $valor["descripcion"] . "</td>";
        $textoAImprimir .= "<td>" . $valor["materia"] . "</td>";
        $textoAImprimir .= "<td>" . $valor["numEjemplares"] . "</td>";
        $textoAImprimir .= "<td><a href='controladorPrestamos.php?accion=prestar&id=" . $valor['id'] . "'>Prestar</a></td>";
        $textoAImprimir .= "</tr>";
    }
} else if ($accionARealizar == "contarPrestamos") {
    $resultado = $query->select('documento', null, "contarPrestamos");
    if ($resultado["contador"] >= "6") {
        header("Location: ../Vista/panelUsuario.php?mensaje=Ya tienes 6 prestamos activos");
    } else {
        $datos = array(
            'idUsuario' => $_SESSION['id']

        );
        $query->insert('prestamos', $datos);
    }
}
$textoAImprimir .= "</table>";
echo $textoAImprimir;
