<?php
require_once 'Database.php';
require_once 'Producto.php';

class ProductoDao extends Database {
    public $productos = array();

    function __construct() {
        parent::__construct(); // Llama al constructor de la clase DB
    }

    public function listar() {
        $consulta = "SELECT * FROM producto";
        $filas = $this->query($consulta)->fetchAll();

        foreach ($filas as $fila) {
            $producto = new Producto();    
            $producto->__set("cod", $fila['cod']);
            $producto->__set("nombre", $fila['nombre']);
            $producto->__set("descripcion", $fila['descripcion']);
            $producto->__set("PVP", $fila['PVP']);
            $producto->__set("familia", $fila['familia']);
            $producto->__set("Foto", $fila['Foto']);
            $this->productos[] = $producto; // Añadimos el objeto al array
        }
    }

    public function getProducto($index) {
        if (isset($this->productos[$index])) {
            return $this->productos[$index];
        }
        return null;
    }

    public function getFirstProducto() {
        return $this->getProducto(0);
    }

    public function getLastProducto() {
        return $this->getProducto(count($this->productos) - 1);
    }

    public function getNextProducto($currentIndex) {
        return $this->getProducto($currentIndex + 1);
    }

    public function getPreviousProducto($currentIndex) {
        return $this->getProducto($currentIndex - 1);
    }


    public function actualizar($producto) {
        $consulta = "UPDATE producto SET nombre = :nombre, PVP = :PVP, familia = :familia, Foto = :Foto WHERE cod = :cod";
        $params = [
            'nombre' => $producto->__get('nombre'),
            'PVP' => $producto->__get('PVP'),
            'familia' => $producto->__get('familia'),
            'Foto' => $producto->__get('Foto'),
            'cod' => $producto->__get('cod')
        ];
        $this->query($consulta, $params);
    }

}