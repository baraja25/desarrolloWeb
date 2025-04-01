<?php 
$nombreArchivo = "Prueba.txt";

$fd = fopen($nombreArchivo, "r") or die("No se puede abrir el archivo $nombreArchivo");
$contenidoArray = array(); // Inicializar el array para almacenar el contenido

while (!feof($fd)) {
    
    $linea = fgets($fd);
    
    $campos = explode(" ", $linea);
    $campos = array_map('trim', $campos); // Limpiar espacios en blanco
    $campos = array_filter($campos); // Filtrar campos vacíos

    foreach ($campos as $campo) {
        $contenidoArray[] = $campo;
    }

}

fclose($fd);




//$contenido = file_get_contents($nombreArchivo);

//$contenidoArray = explode(" ", $contenido);

$longitudMaxima = 0;
$palabraMasLarga = "";

foreach ($contenidoArray as $key => $value) {

    if (strlen($value) > $longitudMaxima) {
        $longitudMaxima = strlen($value);
        $palabraMasLarga = $value;
    }
}

$palabraMasLarga = trim($palabraMasLarga); // Limpiar espacios en blanco al inicio y al final

echo "La palabra más larga es: $palabraMasLarga <br>";

$asteriscos = str_repeat("*", strlen($palabraMasLarga));

echo "La palabra más larga reemplazada por asteriscos es: $asteriscos <br>";

?>