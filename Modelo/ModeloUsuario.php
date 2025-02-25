<?php
include "Query.php";
class Usuario 
{
    private $nombre;
    private $clave;
    private $curso;
    private $email;
    private $telefono;
    private $direccion;

    public function __construct($nombre, $clave, $curso, $email, $telefono, $direccion)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->curso = $curso;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            echo "No existe el atributo $name.";
        }
    }

    public function getUsuario()
    {
        $query = new Query();
        
    }



}
