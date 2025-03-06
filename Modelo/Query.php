<?php
session_start();

class Query
{
    private $conexion;
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
    public function select($tabla, $datos, $filtro)
    {
        if ($datos && !$filtro) {
            $query = "SELECT * FROM " . $tabla . " WHERE ";
            $parametros = [];
            foreach ($datos as $nombreCampo => $valor) {
                $parametros[] = $nombreCampo . " =:" . $nombreCampo;
            }
            $query .= implode(" AND ", $parametros);
            //echo $query."<br>";
            $stmt = $this->conexion->prepare($query);
            foreach ($datos as $nombreCampo => $valor) {
                // echo"". $nombreCampo ."". $valor ."<br>";
                $stmt->bindValue(':' . $nombreCampo, $valor);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if ($datos && $filtro) {
            if ($filtro == "contadorPrestamos") {
                $query = "SELECT count(*) as contador FROM " . $tabla . " WHERE idUsuario = :idUsuario";
                $stmt = $this->conexion->prepare($query);
                $stmt->bindValue(':idUsuario', $datos);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                //echo $query."<br>";
            } else if ($filtro == "filtrarDocs") {
                $query = "SELECT * FROM " . $tabla . " WHERE ";
                $parametros = [];
                foreach ($datos as $nombreCampo => $valor) {
                    $parametros[] = $nombreCampo . " LIKE :" . $nombreCampo;
                }
                $query .= implode(" OR ", $parametros);
                $stmt = $this->conexion->prepare($query);
                foreach ($datos as $nombreCampo => $valor) {
                    $stmt->bindValue(':' . $nombreCampo, '%' . $valor . '%');
                }
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        if (!$datos) {
            $query = "SELECT * FROM " . $tabla;
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function insert($tabla, $datos)
    {
        $query = 'INSERT INTO ' . $tabla . '(`FechaP`, `FechaD`, `IdUsuario`, `IdEjemplar`) VALUES(:fechaP, :fechaD, :idUsuario, :idEjemplar)';
        //echo $query."<br>";        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':fechaP', $datos['fechaP']);
        $stmt->bindValue(':fechaD', $datos['fechaD']);
        $stmt->bindValue(':idUsuario', $datos['idUsuario']);
        $stmt->bindValue(':idEjemplar', $datos['idEjemplar']);
        return $stmt->execute();
    }
}

