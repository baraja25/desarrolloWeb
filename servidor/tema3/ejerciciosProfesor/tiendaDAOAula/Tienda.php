<?php

class Tienda
{
  private $cod;
  private $nombre;
  private $tlf;
    
  function __get($propiedad)
  {
      
      return $this->$propiedad;
  }
  
  function __set($propiedad,$valor)
  {
      $this->$propiedad=$valor;
  }
  
}



?>