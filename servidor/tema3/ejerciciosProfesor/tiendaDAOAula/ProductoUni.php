<?php

class ProductoUni
{
    private $cod;
    private $nombre;
    private $descripcion;
    private $PVP;
    private $familia;
    private $Foto;
    private $Unidades;  //Unidades de ese producto en un tienda seleccionada
    
    public function __get($propiedad)
    {
        return $this->$propiedad;
    }
    
    public function __set($propiedad,$valor)
    {
        $this->$propiedad=$valor;
    }
    
}

?>
