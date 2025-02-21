<?php
require_once 'Database.php';
require_once 'DetallePedido.php';

class detallePedidoDao extends Database
{
    public $detalles = array();

    function __construct()
    {
        parent::__construct();
    }


    public function listarDetallesPorPedido($codPedido)
    {
        $consulta = "SELECT dp.IdPed, dp.IdPro, dp.Cantidad, p.nombre, p.PVP 
                 FROM detpedido dp 
                 JOIN producto p ON dp.IdPro = p.cod 
                 WHERE dp.IdPed = ?";
        $filas = $this->query($consulta, [$codPedido])->fetchAll();

        foreach ($filas as $fila) {
            $detalle = new DetallePedido();
            $detalle->__set('IdPed', $fila['IdPed']);
            $detalle->__set('IdPro', $fila['IdPro']);
            $detalle->__set('Cantidad', $fila['Cantidad']);
            $detalle->__set('NombreProducto', $fila['nombre']);
            $detalle->__set('Precio', $fila['PVP']);
            $this->detalles[] = $detalle;
        }
        return $this->detalles;
    }
}
