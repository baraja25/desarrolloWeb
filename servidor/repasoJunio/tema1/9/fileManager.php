<?php

class FileManager {
    private $directorio;
    private $archivo = "datos.txt";
    
    public function __construct($directorio) {
        $this->directorio = $directorio;
        if (!is_dir($this->directorio)) {
            mkdir($this->directorio, 0777, true);
        }
    }
    
    public function subirArchivo($archivo) {
        // Determinar si se recibió un nombre de archivo o un array de $_FILES
        if (is_string($archivo)) {
            // Si es un string, es el nombre del archivo directamente
            $nombreArchivo = $archivo;
            $rutaDestino = $this->directorio . '/' . $nombreArchivo;
            
            // Simplemente mostrar un mensaje, ya que no hay archivo para mover
            return "Nombre de archivo registrado: <a href='$rutaDestino'>$nombreArchivo</a>";
        } else {
            // Si es un array (desde $_FILES), procesarlo normalmente
            $nombreArchivo = basename($archivo['name']);
            $rutaDestino = $this->directorio . '/' . $nombreArchivo;
            
            if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                return "La imagen se ha subido correctamente: <a href='$rutaDestino'>$nombreArchivo</a>";
            } else {
                return "Error al subir la imagen.";
            }
        }
    }

    public function guardarNombre($archivo) {
        // Similar al método anterior, verificar si es string o array
        if (is_string($archivo)) {
            $nombreArchivo = $archivo;
        } else {
            $nombreArchivo = basename($archivo['name']);
        }
        
        // Guardar el nombre del archivo en el archivo de texto
        $linea = $nombreArchivo . PHP_EOL;
        file_put_contents($this->archivo, $linea, FILE_APPEND);
        
        return "Nombre guardado: $nombreArchivo";
    }
}
// Ejemplo de uso
$fileManager = new FileManager('imagenes');
if (isset($_POST['subir'])) {
    $mensaje = $fileManager->subirArchivo($_FILES['imagen']);
} else {
    $mensaje = "No se ha subido ninguna imagen.";
}