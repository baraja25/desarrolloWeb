<?php

// Leer contenido de Archivos.txt
$archivo_ruta = "Archivos.txt";
$archivos = array();
if (file_exists($archivo_ruta)) 
{
    $contenido = file_get_contents($archivo_ruta);
    $lineas = explode("\n", $contenido);
    
    foreach ($lineas as $linea) 
    {
        $datos = explode(" ", trim($linea), 2); // Separar ID y nombre

        if (count($datos) === 2) 
        {
            $archivos[$datos[0]] = $datos[1];
            
        }
    }
}

// Recuperar parámetros para orden y selección
if (isset($_POST['MostrarRep'])) 
{
    $seleccionados = isset($_POST['Selec']) ? $_POST['Selec'] : array();
} else 
{
    $seleccionados = isset($_GET['seleccionados']) ? unserialize($_GET['seleccionados']) : array();
}

// Asegurar que $seleccionados sea un array válido
if (!is_array($seleccionados)) 
{
    $seleccionados = array();
}

$archivo_orden = isset($_GET['archivo']) ? $_GET['archivo'] : null;
$orden = isset($_GET['orden']) ? $_GET['orden'] : null;

// Procesar formulario para mostrar las repeticiones
$resultados = array();
foreach ($seleccionados as $id => $value) 
{ // Procesa las claves, ignora el atributo "value"
    if (isset($archivos[$id]) && file_exists($archivos[$id])) 
    {
        $contenido = file_get_contents($archivos[$id]);
        $palabras = array_filter(explode("\n", $contenido)); // Dividir palabras por línea
        $conteo = array_count_values($palabras);

        // Si el archivo es el seleccionado para ordenar
        
        if ($archivo_orden === $archivos[$id]) 
        {
            if ($orden === "palabra") 
            {
                ksort($conteo); // Ordenar por palabra ascendente
            } elseif ($orden === "repeticiones") {
                asort($conteo); // Ordenar por repeticiones ascendente
            }
        } else 
        {
            arsort($conteo); // Ordenar por repeticiones descendente por defecto
        }

        $resultados[$archivos[$id]] = $conteo;
    }
}

// Serializar los archivos seleccionados para pasarlos en la URL
$seleccionados_serializados = serialize($seleccionados);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Repeticiones</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <form method="POST">
        <table>
            <tr>
                <th>Seleccionar</th>
                <th>ID</th>
                <th>Archivo</th>
            </tr>
            <?php
            foreach ($archivos as $id => $nombre) 
            {
                echo "<tr>";
                echo "<td><input type='checkbox' name='Selec[$id]'";
                if (isset($seleccionados[$id])) 
                {
                    echo " checked";
                }
                echo "></td>";
                echo "<td>" . htmlspecialchars($id) . "</td>";
                echo "<td>" . htmlspecialchars($nombre) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <button type="submit" name="MostrarRep">Mostrar Rep</button>
    </form>

    <?php
    if (!empty($resultados)) 
    {
        foreach ($resultados as $archivo => $conteo) 
        {
            echo "<h3>Archivo: " . htmlspecialchars($archivo) . "</h3>";
            echo "<table>";
            echo "<tr>";
            echo "<th><a href='$_SERVER[PHP_SELF]?archivo=$archivo&orden=palabra&seleccionados=$seleccionados_serializados';   >Palabra</a></th>";
            echo "<th><a href='$_SERVER[PHP_SELF]?archivo=$archivo&orden=repeticiones&seleccionados=$seleccionados_serializados'; >Repeticiones</a></th>";
            echo "</tr>";

            foreach ($conteo as $palabra => $repeticiones) 
            {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($palabra) . "</td>";
                echo "<td>" . $repeticiones . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
    }
    ?>
</body>
</html>
