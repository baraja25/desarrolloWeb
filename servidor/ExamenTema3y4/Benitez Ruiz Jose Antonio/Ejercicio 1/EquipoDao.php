<?php

require_once "Database.php";
require_once "Equipo.php";

class EquipoDao extends Database {

    public $equipos = array();

    function __construct() {
        parent::__construct(); // Llama al constructor de la clase DB
    }

    public function listar() {
        $consulta = "SELECT * FROM equipos ORDER BY Puesto;";
        $filas = $this->query($consulta)->fetchAll();

        foreach ($filas as $fila) {
            $equipo = new equipo();    
            $equipo->__set("Id", $fila['Id']);
            $equipo->__set("Nombre", $fila['Nombre']);
            $equipo->__set("FechaFund", $fila['FechaFund']);
            $equipo->__set("Presupuesto", $fila['Presupuesto']);
            $equipo->__set("Puesto", $fila['Puesto']);
            $equipo->__set("Logo", $fila['Logo']);
            $this->equipos[] = $equipo; // Añadimos el objeto al array
        }
    }



    //funcion que inserta
    public function insertar($equipo) {
        $consulta = "INSERT INTO equipos VALUES (:nombre, :FechaFund, :Presupuesto, :Puesto)";
        $params = [
            'Nombre' => $equipo->__get('Nombre'),
            'FechaFund' => $equipo->__get('FechaFund'),
            'Presupuesto' => $equipo->__get('Presupuesto'),
            'Puesto' => $equipo->__get('Puesto')
            //'Logo' => $equipo->__get('Logo')
        ];
        $this->query($consulta, $params);
    }


    //funcion que actualiza un equipo
    public function actualizar($equipo) {
        $consulta = "UPDATE equipos SET Nombre = :nombre, FechaFund = :FechaFund, Presupuesto = :Presupuesto, Puesto = :Puesto, Logo = :Logo WHERE Id = :Id";
        $params = [
            'Nombre' => $equipo->__get('Nombre'),
            'FechaFund' => $equipo->__get('FechaFund'),
            'Presupuesto' => $equipo->__get('Presupuesto'),
            'Puesto' => $equipo->__get('Puesto'),
            'Logo' => $equipo->__get('Logo')
        ];
        $this->query($consulta, $params);
    }

    //funcion que borra por id
    public function borrar($cod) {
        $consulta = " DELETE FROM equipos WHERE Id= ?";
        $this->query($consulta, [$cod]);
    }


    public function subir($id, $puesto) {
        //bajar el equipo con un puesto mejor
        $this->query("UPDATE equipos SET Puesto = :Puesto - 1 WHERE Puesto = (:puesto - 1)", [$puesto]);

        $consulta = "Update equipos SET Puesto = :Puesto WHERE Id = :Id";
        $this->query($consulta, [$puesto, $id]);
    }
}