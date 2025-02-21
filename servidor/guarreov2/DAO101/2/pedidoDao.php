<?php
require_once 'Database.php';
require_once 'Pedido.php';
require_once 'Cliente.php';

class pedidoDao extends Database {
    public $pedidos = array();

    function __construct() {
        parent::__construct();
    }

    public function listarPedidosPorFechas($fechaInicio, $fechaFin) {
        $consulta = "SELECT * FROM pedido WHERE Fecha BETWEEN ? AND ?";
        $filas = $this->query($consulta, [$fechaInicio, $fechaFin])->fetchAll();

        $pedidos = [];
        foreach ($filas as $fila) {
            $pedido = new Pedido();
            $pedido->__set('Id', $fila['Id']);
            $pedido->__set('Cliente', $fila['Cliente']);
            $pedido->__set('Fecha', $fila['Fecha']);
            $pedidos[] = $pedido;
        }
        return $pedidos;
    }

    public function listarPedidos($usuario) {
        $usuarioCod = $usuario->__get('nif');
        $consulta = "SELECT * FROM pedido WHERE Cliente = ?";
        $filas = $this->query($consulta, [$usuarioCod])->fetchAll();

        foreach ($filas as $fila) {
            $pedido = new Pedido();
            $pedido->__set('Id', $fila['Id']);
            $pedido->__set('Cliente', $fila['Cliente']);
            $pedido->__set('Fecha', $fila['Fecha']);
            $this->pedidos[] = $pedido;
        }
    }

    public function insertar($pedido) {
        $consulta = "INSERT INTO pedido VALUES (?, ?, ?, ?)";
        $this->query($consulta, [$pedido->__get('Id'), $pedido->__get('Cliente'), $pedido->__get('Fecha'), $pedido->__get('estado')]);
    }
}