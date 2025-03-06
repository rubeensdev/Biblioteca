<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Usuario</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_GET['mensaje'])){
        echo $_GET['mensaje'];
    }
    echo "Bienvenido a tu panel," . $_SESSION['nombre'];
    echo "<br><br><a href='../Controlador/controladorCerrarSesion.php'>Cerrar sesion</a>";

    echo "<br><br><a href='../Controlador/controladorTablas.php'>Ver documentos</a>";

    echo "<br><br><a href='../Controlador/controladorPrestamos.php'>Pedir documento</a>";

    ?>
</body>

</html>