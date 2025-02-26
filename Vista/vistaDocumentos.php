<?php


echo "<form action='../Controlador/controladorTablas.php' method='post'>";
echo "<input type='text' name='filtro' value='' placeholder='Filtrar por titulo'>";   
echo "<input type='submit' value='Filtrar'>";
echo "</form>";


if ($_GET["tabla"]) {
    echo $_GET["tabla"];
} else {
    echo "No se encontraron resultados";
}


