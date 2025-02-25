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
    echo "Bienvenido a tu panel," . $_SESSION['nombre'];

    echo "<a href='../Controlador/controlador.php?accion=mostrarTablas'>Ver documentos</a>";

    ?>
</body>

</html>