<?php
require_once 'Database.php';
require_once 'FamiliaProductos.php';

class DaoFamiliasProductos extends Database {
    public $familiasProductos = array();

    function __construct() {
        parent::__construct();
    }

    public function listar() {
        $consulta = "SELECT * FROM familia";

        $filas = $this->query($consulta)->fetchAll();

        foreach ($filas as $fila) {
            $familiaProducto = new FamiliaProductos();

            $familiaProducto->__set('cod', $fila['cod']);
            $familiaProducto->__set('nombre', $fila['nombre']);

            $this->familiasProductos[] = $familiaProducto;
        }
    }
}