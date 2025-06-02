<?php

class Coche
{
    private $id;
    private $nombre;
    private $marca;
    private $modelo;
    private $precio;
    private $matricula;
    private $anio;
    private $foto;

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }
}