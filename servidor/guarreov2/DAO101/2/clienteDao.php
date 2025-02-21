<?php

require_once 'Database.php';
require_once 'Cliente.php';

class ClienteDao extends Database {
    public $clientes = array();

    function __construct() {
        parent::__construct();
    }

    public function listarClientes() {
        $consulta = "SELECT * FROM clientes";
        $filas = $this->query($consulta, [])->fetchAll();

        foreach ($filas as $fila) {
            $cliente = new Cliente();
            $cliente->__set('NIF', $fila['NIF']);
            $cliente->__set('Nombre', $fila['Nombre']);
            $cliente->__set('Apellido1', $fila['Apellido1']);
            $cliente->__set('Apellido2', $fila['Apellido2']);
            $cliente->__set('FechaNac', $fila['FechaNac']);
            $cliente->__set('Sexo', $fila['Sexo']);
            $cliente->__set('Direccion', $fila['Direccion']);
            $cliente->__set('Estado', $fila['Estado']);
            $cliente->__set('Telefono', $fila['Telefono']);
            $cliente->__set('CP', $fila['CP']);
            $cliente->__set('Foto', $fila['Foto']);
            $this->clientes[] = $cliente;
        }
    }

    public function insertar($cliente) {
        $consulta = "INSERT INTO cliente (NIF, Nombre, Apellido1, Apellido2, FechaNac, Sexo, Direccion, Estado, Telefono, CP, Foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->query($consulta, [
            $cliente->__get('NIF'),
            $cliente->__get('Nombre'),
            $cliente->__get('Apellido1'),
            $cliente->__get('Apellido2'),
            $cliente->__get('FechaNac'),
            $cliente->__get('Sexo'),
            $cliente->__get('Direccion'),
            $cliente->__get('Estado'),
            $cliente->__get('Telefono'),
            $cliente->__get('CP'),
            $cliente->__get('Foto')
        ]);
    }
}