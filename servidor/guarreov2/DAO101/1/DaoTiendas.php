<?php
require_once 'Database.php';
require_once 'Tienda.php';

class DaoTiendas extends Database
{
    public $tiendas = array(); //Creamos una array de objetos situaciones

    function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase DB
    }

    // Listar todos registros    

    public function listar()
    {
        $consulta = "SELECT * FROM tienda";

        $filas = $this->query($consulta)->fetchAll();

        foreach ($filas as $fila) {
            $tienda = new Tienda();    //Creamos un objeto de la entidad tienda

            $tienda->__set("cod", $fila['cod']);
            $tienda->__set("nombre", $fila['nombre']);
            $tienda->__set("tlf", $fila['tlf']);

            $this->tiendas[] = $tienda; //Añadimos el objeto a la array
        }
    }
}