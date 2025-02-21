<?php

class Cliente {
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

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
}