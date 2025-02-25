<?php

class Conexion
{
    private $conexion;
    private $sql;
    private $datos;

    function __construct()
    {
        $this->conexion = $this->conectar();
    }

    private function conectar()
    {
        try {
            $con = new PDO('mysql:host=127.0.0.1;dbname=biblioteca', 'root', 'root');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function select($tabla, $nombre, $clave)
    {
        $query = "SELECT * FROM " . $tabla . " WHERE nombre = :nombre AND clave = :clave";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([':nombre' => $nombre, ':clave' => $clave]);
        return $this->datos->fetch(PDO::FETCH_ASSOC);
    }
    public function insert()
    {
        $tabla = "prestamos";
        $datos = "Ruben,123,1daw,rubenmail,123456789,direccion";
        $columnas = implode(", ", array_keys($datos));
        $valores = ":" . implode(", :", array_keys($datos));

        // Crear la consulta segura con placeholders
        $query = "INSERT INTO $tabla ($columnas) VALUES ($valores)";
        echo $query;
        /*  $stmt = $this->conexion->prepare($query);
         // Ejecutar con los valores correspondientes
        $stmt->execute($datos);

         // Devolver el ID del último registro insertado
         return $this->conexion->lastInsertId(); */
    }


}
$conn = new Conexion();
$conn->insert();

