<?php
require_once 'Database.php';
require_once 'Coche.php';

class CocheDao extends Database
{
    public $coches = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function listar()
    {
        $query = "SELECT * FROM coche";
        $coches = $this->query($query)->fetchAll();

        foreach ($coches as $coche) {
            $nuevoCoche = new Coche();
            $nuevoCoche->__set('id', $coche['id']);
            $nuevoCoche->__set('marca', $coche['marca']);
            $nuevoCoche->__set('modelo', $coche['modelo']);
            $nuevoCoche->__set('precio', $coche['precio']);
            $nuevoCoche->__set('matricula', $coche['matricula']);
            $nuevoCoche->__set('anio', $coche['anio']);
            $nuevoCoche->__set('foto', base64_encode($coche['foto']));
            $nuevoCoche->__set('nombre', $coche['nombre']);

            $this->coches[] = $nuevoCoche;
        }
    }

    public function insertarCoche($coche)
    {
        $query = "INSERT INTO coche (marca, modelo, precio, matricula, anio, foto, nombre) VALUES (:marca, :modelo, :precio, :matricula, :anio, :foto, :nombre)";
        $params = [
            ':marca' => $coche->marca,
            ':modelo' => $coche->modelo,
            ':precio' => $coche->precio,
            ':matricula' => $coche->matricula,
            ':anio' => $coche->anio,
            ':foto' => base64_decode($coche->foto),
            ':nombre' => $coche->nombre
        ];
        $this->query($query, $params);
    }
    public function eliminarCoche($id)
    {
        $query = "DELETE FROM coches WHERE id = :id";
        $params = [':id' => $id];
        $this->query($query, $params);
    }

    public function actualizarCoche($coche)
    {
        $query = "UPDATE coche SET marca = :marca, modelo = :modelo, precio = :precio, matricula = :matricula, anio = :anio, foto = :foto, nombre = :nombre WHERE id = :id";
        $params = [
            ':id' => $coche->id,
            ':marca' => $coche->marca,
            ':modelo' => $coche->modelo,
            ':precio' => $coche->precio,
            ':matricula' => $coche->matricula,
            ':anio' => $coche->anio,
            ':foto' => base64_decode($coche->foto),
            ':nombre' => $coche->nombre
        ];
        $this->query($query, $params);
    }

   
}
