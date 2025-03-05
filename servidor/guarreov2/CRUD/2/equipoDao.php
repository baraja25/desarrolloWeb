<?php

require_once 'Database.php';
require_once 'Equipo.php';

class equipoDao extends Database {
    public $equipos = array();  //Array de objetos equipos
    
    /**
     * Constructor de la clase
     * Inicializa la conexión a la base de datos heredada de Database
     */
    function __construct()
    {
        parent::__construct();
    }



    public function listar() {
        $consulta = "SELECT * FROM equipos ORDER BY Puesto ASC";
        $filas = $this->query($consulta, [])->fetchAll();

        $this->equipos = []; // Reiniciar el array para evitar duplicados

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

    public function insertar($equipo) {
        
        // Obtener el último puesto si no se proporciona uno
        if (empty($equipo->__get('puesto'))) {
            $consultaPuesto = "SELECT MAX(Puesto) as max_puesto FROM equipos";
            $resultado = $this->query($consultaPuesto, [])->fetch();
            $equipo->__set('puesto', ($resultado['max_puesto'] + 1));
        }
        
        $consulta = "INSERT INTO equipos VALUES (NULL, :Nombre, :FechaFund, :Presupuesto, :Puesto, :Logo)";
        $parametros = [
            ':Nombre' => $equipo->__get('nombre'),
            ':FechaFund' => $equipo->__get('fecha_fundacion'),
            ':Presupuesto' => $equipo->__get('presupuesto'),
            ':Puesto' => $equipo->__get('puesto'),
            ':Logo' => $equipo->__get('logo')
        ];

        $this->query($consulta, $parametros);
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


    public function borrar($id) {
        $consulta = "DELETE FROM equipos WHERE Id = ?";
        $this->query($consulta, [$id]);
    }


    public function subir($id) {
        $consulta = "SELECT Puesto FROM equipos WHERE Id = ?";
        $puestoActual = $this->query($consulta, [$id])->fetch()['Puesto'];//2

        $consulta = "SELECT Id, Puesto FROM equipos WHERE Puesto < ? ORDER BY Puesto DESC LIMIT 1";
        $equipoAnterior = $this->query($consulta, [$puestoActual])->fetch();//1

        if ($puestoActual != 1) {
            $consulta = "UPDATE equipos SET Puesto = ? WHERE Id = ?";
            $this->query($consulta, [$puestoActual, $equipoAnterior['Id']]);
            $this->query($consulta, [$equipoAnterior['Puesto'], $id]);
        }
        
    }

    public function bajar($id) {
        $consulta = "SELECT Puesto FROM equipos WHERE Id = ?";
        $puestoActual = $this->query($consulta, [$id])->fetch()['Puesto'];

        $consulta = "SELECT Id, Puesto FROM equipos WHERE Puesto > ? ORDER BY Puesto ASC LIMIT 1";
        $equipoSiguiente = $this->query($consulta, [$puestoActual])->fetch();

        if ($equipoSiguiente !== false) {
            $consulta = "UPDATE equipos SET Puesto = ? WHERE Id = ?";
            $this->query($consulta, [$puestoActual, $equipoSiguiente['Id']]);
            $this->query($consulta, [$equipoSiguiente['Puesto'], $id]);
        }
    }

}
