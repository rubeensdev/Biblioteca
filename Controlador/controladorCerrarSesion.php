<?php
echo $_SESSION["nombre"];
if (isset($_SESSION["nombre"])){
    session_unset();
    session_destroy();
    header("Location: ../Vista/index.html");
}
?>