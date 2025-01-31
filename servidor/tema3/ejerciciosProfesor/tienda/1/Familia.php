<?php

class Familia
{
  private $cod;
  private $nombre;
    
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