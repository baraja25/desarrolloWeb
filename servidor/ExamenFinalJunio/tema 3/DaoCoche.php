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

    public function buscar($marca, $modelo, $precioMaximo, $precioMinimo)
    {
        $consulta = "SELECT * FROM coche WHERE 1=1";
        $params = [];
        if (!empty($marca)) {
            $consulta .= " AND marca LIKE :marca";
            $params[":marca"] = "%" . $marca . "%";
        }
        if (!empty($modelo)) {
            $consulta .= " AND modelo LIKE :modelo";
            $params[":modelo"] = "%" . $modelo . "%";
        }
        if (!empty($precioMaximo)) {
            $consulta .= " AND precio <= :precioMaximo";
            $params[":precioMaximo"] = $precioMaximo;
        }
        if (!empty($precioMinimo)) {
            $consulta .= " AND precio >= :precioMinimo";
            $params[":precioMinimo"] = $precioMinimo;
        }

        return $filas = $this->query($consulta, $params)->fetchAll();
    }

    public function insertarCoche($nombre, $marca, $modelo, $precio, $matricula, $anio)
    {
        // Insertar el coche en la base de datos (sin foto)
        $consulta = "INSERT INTO coche (id, nombre, marca, modelo, precio, matricula, anio) 
                     VALUES (:id, :nombre, :marca, :modelo, :precio, :matricula, :anio)";

        $params = [
            ":id" => $this->last() + 1, //obtiene el ultimo id y aumenta en 1
            ":nombre" => $nombre,
            ":marca" => $marca,
            ":modelo" => $modelo,
            ":precio" => $precio,
            ":matricula" => $matricula,
            ":anio" => $anio
        ];

        $this->query($consulta, $params);
        
    }

    public function insertarFoto($foto) {
        $consultaFoto = "INSERT INTO cochefotos (idcoche, idfoto, foto) 
                                VALUES (:idcoche, :idfoto, :foto)";

        $this->query($consultaFoto, [
            ":idcoche" => $this->last(), //asigna el ultimo id del coche a la tabla fotos
            ":idfoto" => rand(1, 50000),  // Asigna un id aleatorio a la foto entre 1 y 50000
            ":foto" => $foto // añade el nombre de la foto
        ]);
    }



    public function first()
    {
        $consulta = "SELECT * FROM coche LIMIT 1";
        return $this->query($consulta, [])->fetchColumn();
    }

    public function last()
    {
        $consulta = "SELECT * FROM coche ORDER BY id DESC LIMIT 1";
        return $this->query($consulta, [])->fetchColumn();
    }

    public function next($id)
    {
        $consulta = "SELECT * FROM coche WHERE id > :id ORDER BY id ASC LIMIT 1";
        return $this->query($consulta, [":id" => $id])->fetchColumn();
    }

    public function previous($id)
    {
        $consulta = "SELECT * FROM coche WHERE id < :id ORDER BY id DESC LIMIT 1";
        return $this->query($consulta, [":id" => $id])->fetchColumn();
    }

    public function actualizarCoche($id, $nombre, $marca, $modelo, $precio, $anio, $matricula, $foto)
    {

        if ($foto) {
            $foto = base64_decode($foto);
        } else {
            // Si no se proporciona una nueva foto, se puede mantener la foto actual
            $cocheActual = $this->buscarPorId($id);
            if ($cocheActual) {
                $foto = base64_decode($cocheActual->__get('foto'));
            }
        }
        $consulta = "UPDATE coche SET nombre = ?, marca = ?, modelo = ?, precio = ?, anio = ?, matricula = ?, foto = ? WHERE id = ?";
        $this->query($consulta, [$nombre, $marca, $modelo, $precio, $anio, $matricula, $foto, $id]);
    }
}
