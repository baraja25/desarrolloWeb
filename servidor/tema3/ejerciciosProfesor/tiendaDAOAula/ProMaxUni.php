<?php

class ProMaxUni
{
    private $cod;
    private $nombre;
    private $descripcion;
    private $PVP;
    private $TotUni;
    
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
