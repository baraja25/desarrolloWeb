<?php 

class FileManager {
    private $nombreArchivo;
    private $rutaArchivo;

    public function __construct($nombreArchivo) {
        $this->nombreArchivo = $nombreArchivo;
        $this->rutaArchivo = 'datos.txt';
    }

    public function guardarNombre($nombre) {
        $lineas = file($this->rutaArchivo, FILE_IGNORE_NEW_LINES);
        $encontrado = false;
        foreach ($lineas as &$linea) {
            list($nombreGuardado, $contador) = explode(";", $linea);
            if ($nombreGuardado == $nombre) {
                $contador++;
                $linea = "$nombreGuardado;$contador";
                $encontrado = true;
                break;
            }
        }
        if (!$encontrado) {
            $lineas[] = "$nombre;1";
        }
        file_put_contents($this->rutaArchivo, implode(PHP_EOL, $lineas));
    }

    public function mostrarNombres() {
        if (file_exists($this->rutaArchivo)) {
            return file($this->rutaArchivo, FILE_IGNORE_NEW_LINES);
        } else {
            return [];
        }
    }

    public function borrarNombre($nombre) {
        
        $lineas = file($this->rutaArchivo, FILE_IGNORE_NEW_LINES);
        $nuevasLineas = [];

        foreach ($lineas as $linea) {
            list($nombreGuardado, $contador) = explode(";", $linea);
            if ($nombreGuardado != $nombre) {
                $nuevasLineas[] = $linea;
            }
        }
        file_put_contents($this->rutaArchivo, implode(PHP_EOL, $nuevasLineas));
    }
}

?>