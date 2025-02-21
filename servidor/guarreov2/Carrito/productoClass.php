<?php
//class Producto
class Producto
{
    private $cod;
    private $nombre;
    private $descripcion;
    private $PVP;
    private $familia;
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
