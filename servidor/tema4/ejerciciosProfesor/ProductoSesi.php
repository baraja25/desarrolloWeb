<?php

class ProductoSesi
{
  private $Id;
  private $Nombre;
  private $Marca;
  private $Precio;
    
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