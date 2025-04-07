<?php
/**
 * Clase para gestionar operaciones con archivos de contactos
 */
class File {
    private $nombre;
    private $correo;
    private $archivo = "datos.txt";
    
    /**
     * Constructor de la clase
     * 
     * @param string $nombre Nombre del contacto
     * @param string $correo Correo electrónico del contacto
     */
    public function __construct($nombre = "", $correo = "") {
        $this->nombre = $nombre;
        $this->correo = $correo;
    }
    
    /**
     * Guarda un nuevo contacto en el archivo
     * 
     * @return bool true si la operación fue exitosa
     */
    public function guardar() {
        // Validar que los datos no estén vacíos
        if (empty($this->nombre) || empty($this->correo)) {
            return false;
        }
        
        // Verificar si el correo ya existe
        if ($this->buscarCorreo($this->correo)) {
            return false;
        }
        
        // Formatear la línea y guardarla en el archivo
        $linea = $this->nombre . ";" . $this->correo . PHP_EOL;
        return file_put_contents($this->archivo, $linea, FILE_APPEND) !== false;
    }
    
    /**
     * Busca un contacto por su correo electrónico
     * 
     * @param string $correo Correo electrónico a buscar
     * @return array|bool Array con los datos del contacto o false si no existe
     */
    public function buscarCorreo($correo) {
        if (!file_exists($this->archivo)) {
            return false;
        }
        
        $lineas = file($this->archivo, FILE_IGNORE_NEW_LINES);
        foreach ($lineas as $linea) {
            $datos = explode(";", $linea);
            if (isset($datos[1]) && trim($datos[1]) === trim($correo)) {
                return [
                    'nombre' => $datos[0],
                    'correo' => $datos[1],
                    'linea' => $linea
                ];
            }
        }
        
        return false;
    }
    
    /**
     * Elimina un contacto por su correo electrónico
     * 
     * @param string $correo Correo electrónico del contacto a eliminar
     * @return bool true si la eliminación fue exitosa
     */
    public function eliminar($correo) {
        if (!file_exists($this->archivo)) {
            return false;
        }
        
        $lineas = file($this->archivo, FILE_IGNORE_NEW_LINES);
        $contenido = "";
        $eliminado = false;
        
        foreach ($lineas as $linea) {
            $datos = explode(";", $linea);
            if (isset($datos[1]) && trim($datos[1]) !== trim($correo)) {
                $contenido .= $linea . PHP_EOL;
            } else {
                $eliminado = true;
            }
        }
        
        // Si se encontró y eliminó el contacto, actualizar el archivo
        if ($eliminado) {
            return file_put_contents($this->archivo, $contenido) !== false;
        }
        
        return false;
    }
    
    /**
     * Lista todos los contactos guardados
     * 
     * @return array Array con todos los contactos
     */
    public function listarContactos() {
        if (!file_exists($this->archivo)) {
            return [];
        }
        
        $contactos = [];
        $lineas = file($this->archivo, FILE_IGNORE_NEW_LINES);
        
        foreach ($lineas as $linea) {
            $datos = explode(";", $linea);
            if (isset($datos[1])) {
                $contactos[] = [
                    'nombre' => $datos[0],
                    'correo' => $datos[1]
                ];
            }
        }
        
        return $contactos;
    }
}