<?php
/*  
Falta borrar los productos de la tabla. (No me sale)

*/


// Funcion que obtiene los datos de un archivo de texto y lo devuelve en una lista
function obtenerDatos($archivo_ruta)
{
    $archivos = [];
    if (file_exists($archivo_ruta)) {
        $contenido = file_get_contents($archivo_ruta);
        $lineas = explode("\n", $contenido);

        foreach ($lineas as $linea) {
            $datos = explode(":", trim($linea));

            if (count($datos) === 5) {
                $archivos[$datos[0]] = $datos;
            }
        }
    }
    return $archivos;
}
// declaracion de variables
$productos = obtenerDatos("Productos.txt");
$seleccionados = $_POST['seleccionado'] ?? [];

$area = $_POST["Area"] ?? "";
$valor1 = "";
$valor2 = "";
$valor3 = "";

//mover los datos seleccionados al text area correspondiente
if (isset($_POST["mover"]) && $area === "moverArea1" ) {
    foreach ($seleccionados as $key => $value) {
        $valor1 .= $value." ";
    }
}
if (isset($_POST["mover"]) && $area === "moverArea2" ) {
    foreach ($seleccionados as $key => $value) {
        $valor2 .= $value." ";
    }
}
if (isset($_POST["mover"]) && $area === "moverArea3" ) {
    foreach ($seleccionados as $key => $value) {
        $valor3 .= $value." ";
    }
}


require "moverArea.view.php";