<?php

include '../Modelo/Query.php';

$resultado = null;
$query = new Query();


if (($_POST['filtro']) != null) {
    $datos = array(
        'titulo' => $_POST['filtro'],
        'autores' => $_POST['filtro'],
        'materia' => $_POST['filtro'],

    );
    $resultado = $query->select('documento', $datos, true);
} else {

    $resultado = $query->select('documento', null, false);
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


?>