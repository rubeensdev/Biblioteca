<?php

class Query
{
    private $conexion;
    private $sql;
    private $datos;

    public function __construct()
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

    public function select($tabla, $datos)
    {
        $query = "SELECT * FROM " . $tabla . " WHERE nombre = :nombre AND clave = :clave";
        $stmt = $this->conexion->prepare($query);
        foreach ($datos as $nombreCampo => $valor) {
            $stmt->bindValue(':' . $nombreCampo, $valor);
        }
        return $this->datos->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($tabla, $datos)
    {
        $columnas = implode(", ", array_keys($datos));
        $valores = ":" . implode(", :", array_keys($datos));
        $query = "INSERT INTO $tabla ($columnas) VALUES ($valores)";
        $stmt = $this->conexion->prepare($query);
        foreach ($datos as $nombreCampo => $valor) {
            $stmt->bindValue(':' . $nombreCampo, $valor);
        }
        $stmt->execute();
        echo $query;

    }


}
$conn = new Conexion();
$conn->insert();

