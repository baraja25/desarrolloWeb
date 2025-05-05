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

    public function actualizarCoche($matricula, $nombre, $marca, $modelo, $precio, $anio, $foto)
    {   
        if ($foto) {
            $this->query("UPDATE coche SET marca = ?, modelo = ?, precio = ?, anio = ?, nombre = ?, foto = ? WHERE matricula = ?", [$marca, $modelo, $precio, $anio, $nombre, $foto, $matricula]);
        } else {
            $this->query("UPDATE coche SET marca = ?, modelo = ?, precio = ?, anio = ?, nombre = ? WHERE matricula = ?", [$marca, $modelo, $precio, $anio, $nombre, $matricula]);
        }

        
    }

    public function seleccionarCoche($matricula)
    {
        $consulta = "SELECT * FROM coche WHERE matricula = ?";
        $coche = $this->query($consulta, [$matricula])->fetch(PDO::FETCH_ASSOC);
        return $coche;
    }

    public function primerCoche()
    {
        return $consulta = $this->query("SELECT id FROM coche LIMIT 1", [])->fetchColumn();
    }

    public function ultimoCoche()
    {
        return $consulta = $this->query("SELECT id FROM coche ORDER BY id DESC LIMIT 1", [])->fetchColumn();
    }
    public function siguienteCoche($id)
    {
        return $consulta = $this->query("SELECT id FROM coche WHERE id > ? LIMIT 1", [$id])->fetchColumn();
    }
    public function anteriorCoche($id)
    {
        return $consulta = $this->query("SELECT id FROM coche WHERE id < ? ORDER BY id DESC LIMIT 1", [$id])->fetchColumn();
    }
}
