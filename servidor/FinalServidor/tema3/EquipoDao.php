<?php
require_once 'Database.php';
require_once 'Equipo.php';

class equipoDao extends Database {
    public $equipos = array();

    function __construct() {
        parent::__construct(); // Llama al constructor de la clase DB
    }

    public function listar() {
        $consulta = "SELECT * FROM equipos";
        $filas = $this->query($consulta, [])->fetchAll();

        //$this->equipos = []; // Reiniciar el array para evitar duplicados

        foreach ($filas as $fila) {
            $equipo = new Equipo();
            $equipo->__set('id', $fila['Id']);
            $equipo->__set('nombre', $fila['Nombre']);
            $equipo->__set('fecha_fundacion', $fila['FechaFund']);
            $equipo->__set('presupuesto', $fila['Presupuesto']);
            $equipo->__set('puesto', $fila['Puesto']);
            $equipo->__set('logo', $fila['Logo']);

            // Usar el ID como clave en el array para acceso directo
            $this->equipos[$fila['Id']] = $equipo;
        }

    }

    public function getequipo($index) {
        if (isset($this->equipos[$index])) {
            return $this->equipos[$index];
        }
        return null;
    }

    public function getFirstequipo() {
        return $this->getequipo(0);
    }

    public function getLastequipo() {
        return $this->getequipo(count($this->equipos) - 1);
    }

    public function getNextequipo($currentIndex) {
        return $this->getequipo($currentIndex + 1);
    }

    public function getPreviousequipo($currentIndex) {
        return $this->getequipo($currentIndex - 1);
    }


    public function actualizar($equipo) {
        $consulta = "UPDATE equipos SET Nombre = :Nombre, FechaFund = :FechaFund, Presupuesto = :Presupuesto,  Puesto = :Puesto, "; 
        
        if ($equipo->__get('logo') != "") {
            $consulta .= " Logo = :Logo";
            $parametros = [':Logo' => $equipo->__get('logo')];
        }
        
        
        
        $consulta .= " WHERE Id = :Id";
        $parametros = [
            ':Id' => $equipo->__get('id'),
            ':Nombre' => $equipo->__get('nombre'),
            ':FechaFund' => $equipo->__get('fecha_fundacion'),
            ':Presupuesto' => $equipo->__get('presupuesto'),
            ':Puesto' => $equipo->__get('puesto')
        ];
        

        $this->query($consulta, $parametros);
    }

}