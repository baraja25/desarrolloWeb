<?php

class Coche  
{
    private $id;
    private $nombre;
    private $marca;
    private $modelo;
    private $precio; 
    private $matricula;
    private $anio;
    private $foto;
    
    public function __get($nombre) 
    {
      return $this->$nombre;   
    }
    
    public function __set($nombre,$valor)
    {
        $this->$nombre=$valor;
    }
    
    
}

?>