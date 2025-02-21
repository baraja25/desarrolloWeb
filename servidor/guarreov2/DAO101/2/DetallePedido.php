<?php

class DetallePedido {
    private $IdPed;
    private $IdPro;
    private $Cantidad;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
}