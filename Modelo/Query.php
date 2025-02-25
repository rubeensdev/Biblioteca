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
            $con = new PDO('mysql:host=127.0.0.1;dbname=biblioteca', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    public function select($tabla, $datos)
    {
        if ($datos) {
            $query = "SELECT * FROM " . $tabla . " WHERE ";
            $parametros = [];
            foreach ($datos as $nombreCampo => $valor) {
                $parametros[] = $nombreCampo . " = :" . $nombreCampo;
            }
            $query .= implode(" OR ", $parametros);
            //echo $query."<br>";
            $stmt = $this->conexion->prepare($query);
            foreach ($datos as $nombreCampo => $valor) {
                // echo"". $nombreCampo ."". $valor ."<br>";
                $stmt->bindValue(':' . $nombreCampo, $valor);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else if (!$datos) {
            $query = "SELECT * FROM " . $tabla;
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function insert($tabla, $datos)
    {
        $query = "INSERT INTO " . $tabla . " VALUES ";
        $parametros = [];
        foreach ($datos as $nombreCampo => $valor) {
            $parametros[] = ":" . $nombreCampo;
        }
        //echo $query."<br>";
        $stmt = $this->conexion->prepare($query);
        foreach ($datos as $nombreCampo => $valor) {
            // echo"". $nombreCampo ."". $valor ."<br>";
            $stmt->bindValue(':' . $nombreCampo, $valor);
        }

        return $stmt->execute();

    }

}

