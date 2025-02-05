<?php

class Cliente
{
    private $NIF;
    private $Nombre;
    private $Apellido1;
    private $Apellido2;
    private $FechaNac;
    private $Sexo;
    private $Direccion;
    private $Estado;
    private $Telefono;
    private $CP;
    private $Foto;

    function __get($propiedad)
    {

        return $this->$propiedad;
    }

    function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}
