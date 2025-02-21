<?php
class Pedido {
    private $Id;
    private $Cliente;
    private $Fecha;


    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
}