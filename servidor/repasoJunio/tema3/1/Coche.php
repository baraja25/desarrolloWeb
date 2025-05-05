<?php 
class Coche {
    private $id;
    private $marca;
    private $modelo;
    private $precio;
    private $matricula;
    private $anio;
    private $foto;
    private $nombre;
    
    
    public function __get($propiedad) {
        return $this->$propiedad;
    }
    
    public function __set($propiedad, $valor) {
        $this->$propiedad = $valor;
    }
}




?>