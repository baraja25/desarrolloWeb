<?php

class Equipo {
    private $id;
    private $nombre;
    private $fecha_fundacion;
    private $presupuesto;
    private $puesto;
    private $logo;

    function __construct() {
        $this->id = 0;
        $this->nombre = "";
        $this->fecha_fundacion = "";
        $this->presupuesto = 0;
        $this->puesto = 0;
        $this->logo = "";
    }

    function __get($atributo) {
        return $this->$atributo;
    }

    function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
}