<?php

class Cliente
{
  private $Nif;
  private $Nombre;
  private $Apellido1;
  private $NumCuenta;
  private $Saldo;
    
  function __construct($nif,$nombre,$apellido1)
  {
      $this->Nif=$nif;
      $this->Nombre=$nombre;
      $this->Apellido1=$apellido1;
         
  }
    
  function __set($propiedad,$valor)
  {
    $this->$propiedad=$valor;
  }
  
  function __get($propiedad)
  {
     
      return $this->$propiedad;
  }
}

$cli = new Cliente('05666332211H','Juan','Perez');

//echo "El nombre del cliente es:".$cli->Nif." ".$cli->Nombre." ".$cli->Apellido1;


$cli->__set("NumCuenta", "ES2345123422");

$cli->__set("Saldo","1000");


echo "El saldo del cliente es ".$cli->__get("Saldo")." en la cuenta ".$cli->__get("NumCuenta");




?>