<?php

class Stock
{
  private $producto;
  private $tienda;
  private $unidades;
    
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