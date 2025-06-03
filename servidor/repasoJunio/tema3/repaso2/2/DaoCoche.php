<?php

require_once 'Coche.php';
require_once 'Database.php';

class CochesDao extends Database
{
    public $coches = array();

    function __construct()
    {
        parent::__construct();
    }

    public function listarCoches()
    {
        $consulta = "SELECT * FROM coche";
        $filas = $this->query($consulta, [])->fetchAll();

        foreach ($filas as $fila) {
            $coche = new Coche();
            $coche->__set('id', $fila['id']);
            $coche->__set('nombre', $fila['nombre']);
            $coche->__set('marca', $fila['marca']);
            $coche->__set('modelo', $fila['modelo']);
            $coche->__set('precio', $fila['precio']);
            $coche->__set('matricula', $fila['matricula']);
            $coche->__set('anio', $fila['anio']);
            $coche->__set('foto', base64_encode($fila['foto']));
            $this->coches[] = $coche;
        }
    }

    public function buscarPorId($id)
    {
        $consulta = "SELECT * FROM coche WHERE id = :id";
        $fila = $this->query($consulta, [":id" => $id])->fetch();

        if ($fila) {
            $coche = new Coche();
            $coche->__set('id', $fila['id']);
            $coche->__set('nombre', $fila['nombre']);
            $coche->__set('marca', $fila['marca']);
            $coche->__set('modelo', $fila['modelo']);
            $coche->__set('precio', $fila['precio']);
            $coche->__set('matricula', $fila['matricula']);
            $coche->__set('anio', $fila['anio']);
            $coche->__set('foto', base64_encode($fila['foto']));
            return $coche;
        }
        return null; // Si no se encuentra el coche, devolvemos null
    }

    public function first() {
        $consulta = "SELECT * FROM coche LIMIT 1";
        return $this->query($consulta, [])->fetchColumn();
        
    }

    public function last() {
        $consulta = "SELECT * FROM coche ORDER BY id DESC LIMIT 1";
        return $this->query($consulta, [])->fetchColumn();
        
    }

    public function next($id) {
        $consulta = "SELECT * FROM coche WHERE id > :id ORDER BY id ASC LIMIT 1";
        return $this->query($consulta, [":id" => $id])->fetchColumn();
        
    }

    public function previous($id) {
        $consulta = "SELECT * FROM coche WHERE id < :id ORDER BY id DESC LIMIT 1";
        return $this->query($consulta, [":id" => $id])->fetchColumn();
        
    }
}
