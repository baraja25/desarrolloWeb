<?php

class Equipo {
    private $Id;
    private $Nombre;
    private $FechaFund;
    private $Presupuesto;
    private $Puesto;
    private $Logo;


    public function __get($propiedad)
  {  
      return $this->$propiedad;
  }
  
  public function __set($propiedad,$valor)
  {
      $this->$propiedad=$valor;
  }
}