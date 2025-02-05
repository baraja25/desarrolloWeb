<?php

require_once 'LibreriaPDO.php';
require_once 'cliente.php';

class DaoClientes extends DB
{
    public $clientes = array(); //Creamos una array de objetos situaciones

    function __construct($base)
    {
        parent::__construct($base); // Llama al constructor de la clase DB
    }

    // Listar todos registros    

    public function listar()
    {
        $consulta = "SELECT * FROM cliente";

        $this->ConsultaDeDatos($consulta);

        foreach ($this->rows as $fila) {
            $cliente = new cliente();    //Creamos un objeto de la entidad tienda

            $cliente->__set("NIF", $fila['NIF']);          //Le asiganamos a las propiedades del objeto los campos de esa fila
            $cliente->__set("Nombre", $fila['nombre']);
            $cliente->__set("Apellido1", $fila['Apellido1']);
            $cliente->__set("Apellido2", $fila['Apellido2']);
            $cliente->__set("FechaNac", $fila['FechaNac']);
            $cliente->__set("Sexo", $fila['Sexo']);
            $cliente->__set("Direccion", $fila['Direccion']);
            $cliente->__set("Estado", $fila['Estado']);
            $cliente->__set("Telefono", $fila['Telefono']);
            $cliente->__set("CP", $fila['CP']);
            $cliente->__set("Foto", $fila['Foto']);


            $this->clientes[] = $cliente;  //Guardamos ese objeto en el array de objetos situaciones  

        }
    }
}
