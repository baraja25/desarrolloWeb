<?php
function obtenerArchivos($ruta)
{
    $archivos = array();

    if (file_exists($ruta))
    {
        $contenido = file_get_contents($ruta);

        $lineas = array_map("trim", explode("\n", $contenido));

        foreach ($lineas as $linea)
        {
            if (!empty($linea)) {
                $archivos[] = $linea;
            }
        }
    }
    return $archivos;
}

function obtenerFrecuenciaPalabras($archivo)
{
    $frecuencias = array();

    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        $lineas = array_map("trim", explode("\n", $contenido));

        foreach ($lineas as $linea) {
            if (!empty($linea)) {
                if (isset($frecuencias[$linea])) {
                    $frecuencias[$linea]++;
                } else {
                    $frecuencias[$linea] = 1;
                }
            }
        }
    }

    return $frecuencias;
}

function obtenerPalabras($archivo)
{
    $palabras = array();
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        $lineas = array_map("trim", explode("\n", $contenido));
        foreach ($lineas as $linea) {
            if (!empty($linea)) {
                $palabras[] = $linea;
            }
        }
    }
    return $palabras;
}

function ordenarFrecuencias($frecuencias, $criterio)
{
    if ($criterio === 'alfabetico') {
        ksort($frecuencias); // Ordenar por clave (palabra) alfabéticamente.
    } elseif ($criterio === 'repeticiones') {
        arsort($frecuencias); // Ordenar por valor (repeticiones) de mayor a menor.
    }

    return $frecuencias;
}

function generarParametros($seleccionados)
{
    $parametros = '';
    foreach ($seleccionados as $id => $archivo) {
        $parametros .= "seleccionado[$id]=" . urlencode($archivo) . "&";
    }
    return rtrim($parametros, "&");
}



$archivos = obtenerArchivos("Archivos.txt");
$tablas = [];

$criterio = $_GET['orden'] ?? null;
$seleccionados = $_POST['seleccionado'] ?? $_GET['seleccionado'] ?? [];

// Si se envía el formulario para mostrar repeticiones
if (isset($_POST["mostrar"]) || !empty($seleccionados)) {
    if (!empty($seleccionados)) {
        foreach ($seleccionados as $archivo) {
            $frecuencias = obtenerFrecuenciaPalabras($archivo);

            // Obtener criterio de ordenamiento de la URL (si existe).
            $criterio = $_GET['orden'] ?? null;
            if ($criterio) {
                $frecuencias = ordenarFrecuencias($frecuencias, $criterio);
            }

            $tablas[$archivo] = $frecuencias;
        }
    }
}




require "test.view.php";
