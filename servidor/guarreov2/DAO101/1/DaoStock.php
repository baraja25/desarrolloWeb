<?php
require_once 'Database.php';
require_once 'stock.php';

class DaoStocks extends Database
{
    public $stocks = array();

    function __construct() {
        parent::__construct();
    }

    public function listarFamiliaTiendas($tienda, $familia)
    {
        $tiendaCod = $tienda->__get('cod');
        $consulta = "SELECT * FROM stock WHERE tienda = ? AND producto IN (SELECT cod FROM producto WHERE familia = ?)";
        $filas = $this->query($consulta, [$tiendaCod, $familia])->fetchAll();

        foreach ($filas as $fila) {
            $stock = new Stock();
            $stock->__set('producto', $fila['producto']);
            $stock->__set('tienda', $fila['tienda']);
            $stock->__set('unidades', $fila['unidades']);
            $this->stocks[] = $stock;
        }
    }
}