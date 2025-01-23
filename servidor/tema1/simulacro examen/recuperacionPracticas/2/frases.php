<?php

function analizarTexto($texto) {
    // Convertir el texto a minúsculas y eliminar caracteres especiales
    $texto = strtolower($texto);
    $texto = preg_replace('/[^a-záéíóúñ\s]/u', '', $texto);

    // Dividir el texto en palabras
    $palabras = preg_split('/\s+/', $texto);

    // Inicializar variables
    $totalPalabras = count($palabras);
    $longitudTotal = 0;
    $frecuencia = [];
    $palabrasConVocal = 0;

    foreach ($palabras as $palabra) {
        // Contar la longitud total de las palabras
        $longitudTotal += strlen($palabra);

        // Contar la frecuencia de cada palabra
        if (!empty($palabra)) {
            if (isset($frecuencia[$palabra])) {
                $frecuencia[$palabra]++;
            } else {
                $frecuencia[$palabra] = 1;
            }
        }

        // Contar palabras que inician con vocal
        if (preg_match('/^[aeiouáéíóú]/', $palabra)) {
            $palabrasConVocal++;
        }
    }

    // Calcular longitud promedio de las palabras
    $longitudPromedio = $totalPalabras > 0 ? $longitudTotal / $totalPalabras : 0;

    // Encontrar la palabra más frecuente
    $palabraMasFrecuente = array_keys($frecuencia, max($frecuencia));

    // Mostrar resultados
    echo "<br>Longitud promedio de las palabras: " . round($longitudPromedio, 2) . "\n";
    echo "<br>Palabra más frecuente: " . implode(', ', $palabraMasFrecuente) . "\n";
    echo "<br>Cantidad de palabras que inician con vocal: " . $palabrasConVocal . "\n";
}

function contarPalabras($array)
{
    $contadorPalabras = 0;

    foreach ($array as $palabra) {
        if (strlen($palabra) >= 5) {
            $contadorPalabras++;
        }
    }

    return $contadorPalabras;
}



if (isset($_POST["enviar"])) {
    //eliminar espacios principio y final
    $fraseUsuario = trim($_POST["fraseUsuario"]);
    //convertir a array
    $fraseArray = explode(" ", $fraseUsuario);

    $palabrasContadas = contarPalabras($fraseArray);
    echo "<br>Palabras mayor de 5 caracteres: " . $palabrasContadas;

    $listaPalabrasInvertida = array_reverse($fraseArray);
    $textoInvertido = implode("-", $listaPalabrasInvertida);
    echo "<br>Texto invertido: " . $textoInvertido;

    analizarTexto($fraseUsuario);
}



require "frases.view.php";