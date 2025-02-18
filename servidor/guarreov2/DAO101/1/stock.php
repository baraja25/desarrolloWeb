<?php

class Stock {
    private $producto;
    private $tienda;
    private $unidades;
    

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
}