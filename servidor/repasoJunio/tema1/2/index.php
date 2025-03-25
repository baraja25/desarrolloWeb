<?php


// Definir la ruta al archivo de texto
$rutaArchivo = "texto.txt";

// Función para encontrar la palabra más larga en un array
function encontrarPalabraMasLarga(array $palabras): string {
    $palabraMasLarga = "";
    $longitudMaxima = 0;

    foreach ($palabras as $palabra) {
        // Limpiamos la palabra de puntuación para medir correctamente
        $palabraLimpia = preg_replace('/[^\p{L}\p{N}]/u', '', $palabra);
        $longitud = mb_strlen($palabraLimpia);
        
        if ($longitud > $longitudMaxima) {
            $longitudMaxima = $longitud;
            $palabraMasLarga = $palabra;
        }
    }

    return $palabraMasLarga;
}

// Función para reemplazar todas las ocurrencias de una palabra por asteriscos
function reemplazarPorAsteriscos(array $palabras, string $palabraAReemplazar): array {
    $palabraLimpia = preg_replace('/[^\p{L}\p{N}]/u', '', $palabraAReemplazar);
    $asteriscos = str_repeat('*', mb_strlen($palabraLimpia));
    
    foreach ($palabras as $clave => $palabra) {
        // Verificamos si coincide ignorando mayúsculas/minúsculas
        if (strcasecmp(preg_replace('/[^\p{L}\p{N}]/u', '', $palabra), $palabraLimpia) === 0) {
            // Preservar signos de puntuación originales
            $palabras[$clave] = preg_replace('/[\p{L}\p{N}]+/u', $asteriscos, $palabra);
        }
    }
    
    return $palabras;
}

// Verificar si el archivo existe
if (!file_exists($rutaArchivo)) {
    die("Error: El archivo $rutaArchivo no existe.");
}

// Leer el contenido del archivo
$contenido = file_get_contents($rutaArchivo);
if ($contenido === false) {
    die("Error: No se pudo leer el archivo $rutaArchivo.");
}

// Dividir el contenido en un array de palabras
$palabras = preg_split('/\s+/', $contenido);

// Encontrar la palabra más larga
$palabraMasLarga = encontrarPalabraMasLarga($palabras);

// Imprimir información para depuración
echo "Palabra más larga encontrada: $palabraMasLarga\n";

// Reemplazar la palabra más larga por asteriscos
$palabrasModificadas = reemplazarPorAsteriscos($palabras, $palabraMasLarga);

// Unir el array modificado para formar el nuevo texto
$nuevoContenido = implode(' ', $palabrasModificadas);

// Mostrar el resultado
echo "\nTexto original:\n";
echo $contenido;
echo "\n\nTexto modificado:\n";
echo $nuevoContenido;


?>