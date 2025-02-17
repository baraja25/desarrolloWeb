<?php
class Producto {
    private $id;
    private $nombre;
    private $marca;
    private $precio;

    

  public function __get($propiedad)
  {  
      return $this->$propiedad;
  }
  
  public function __set($propiedad,$valor)
  {
      $this->$propiedad=$valor;
  }
}
?>