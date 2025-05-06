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


    public function buscarCoche($marca, $modelo, $precioMaximo, $precioMinimo)
    {
        $consulta = "SELECT * FROM coche WHERE 1=1";
        $parametros = []; // Array para almacenar los parámetros de la consulta

        // Añadimos condiciones según los campos que estén rellenos
        if (!empty($marca)) {
            // Usamos LIKE para permitir coincidencias parciales
            // y % para indicar que puede haber cualquier cosa antes o después de la marca
            $consulta .= " AND marca LIKE :marca";
            $parametros[":marca"] = "%" . $marca . "%"; // Añadimos el parámetro al array
        }
        if (!empty($modelo)) {
            $consulta .= " AND modelo LIKE :modelo";
            $parametros[":modelo"] = "%" . $modelo . "%"; // Buscamos coincidencias parciales
        }
        if (!empty($precioMaximo)) {
            $consulta .= " AND precio <= :precioMaximo";
            $parametros[":precioMaximo"] = $precioMaximo; // Filtro de precio máximo
        }
        if (!empty($precioMinimo)) {
            $consulta .= " AND precio >= :precioMinimo";
            $parametros[":precioMinimo"] = $precioMinimo; // Filtro de precio mínimo
        }

        // Ejecutamos la consulta con los parámetros y obtenemos todos los resultados
        return $coches = $this->query($consulta, $parametros)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function seleccionarCoche($matricula)
    {
        $consulta = "SELECT * FROM coche WHERE matricula = ?";
        $coche = $this->query($consulta, [$matricula])->fetch(PDO::FETCH_ASSOC);
        return $coche;
    }


    public function seleccionarCocheId($id)
    {
        $consulta = "SELECT * FROM coche WHERE id = ?";
        $coche = $this->query($consulta, [$id])->fetch(PDO::FETCH_ASSOC);
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
