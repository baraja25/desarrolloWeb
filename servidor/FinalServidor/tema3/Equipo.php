<?php

class Equipo {
    private $id;
    private $nombre;
    private $fecha_fundacion;
    private $presupuesto;
    private $puesto;
    private $logo;


    function __get($atributo) {
        return $this->$atributo;
    }

    function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
}