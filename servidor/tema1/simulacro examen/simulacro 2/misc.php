<?php 

/* Funcion que crea una tabla y la muestra segun los datos introducidos
 */

// Ejemplo de uso
// $alumnos = [
//     ['ID' => 1, 'Nombre' => 'Juan Pérez', 'Edad' => 20],
//     ['ID' => 2, 'Nombre' => 'Ana Gómez', 'Edad' => 22],
//     ['ID' => 3, 'Nombre' => 'Luis Martínez', 'Edad' => 21],
//     // Puedes agregar más alumnos aquí
// ];

// $titulos = ['ID', 'Nombre', 'Edad'];

// // Llamamos a la función para mostrar la tabla
// mostrarTabla($alumnos, $titulos);

function mostrarTabla($datos, $titulos) {
    // Comenzamos la tabla
    echo "<table border='2'>";

    // Agregamos los encabezados de la tabla
    echo "<tr>";
    foreach ($titulos as $titulo) {
        echo "<th>" . $titulo . "</th>";
    }
    echo "</tr>";

    // Agregamos los datos a la tabla
    foreach ($datos as $fila) {
        echo "<tr>";
        foreach ($fila as $dato) {
            echo "<td>" . $dato . "</td>";
        }
        echo "</tr>";
    }

    // Cerramos la tabla
    echo "</table>";
}

/* funcion que genera una tabla con checkbox a partir de un array asociativo 
    para recoger los datos de los checkboxes marcados simplemente hay que poner $_GET/POST = nombre de la tabla
*/
function generarTablaConCheckboxes($datos, $nombreTabla) {
    // Verificamos que haya datos para mostrar
    if (empty($datos)) {
        echo "No hay datos para mostrar.";
        return;
    }

    // Comenzamos a construir la tabla
    echo "<table border='1'>";
    
    // Encabezados de la tabla
    echo "<thead><tr>";
    echo "<th></th>"; // Columna para el checkbox
    foreach ($datos[0] as $key => $valor) {
        echo "<th>" . $key . "</th>";
    }
    echo "</tr></thead>";
    
    // Cuerpo de la tabla
    echo "<tbody>";
    foreach ($datos as $index => $fila) {
        echo "<tr>";
        // Checkbox para cada fila
        echo "<td><input type='checkbox' name='{$nombreTabla}[]' value='" . $index . "'></td>";
        
        foreach ($fila as $valor) {
            echo "<td>" . $valor . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

// Ejemplo de uso
// $datos = [
//     ['id' => 1, 'nombre' => 'Juan', 'edad' => 25],
//     ['id' => 2, 'nombre' => 'Ana', 'edad' => 30],
//     ['id' => 3, 'nombre' => 'Luis', 'edad' => 28],
// ];

// generarTablaConCheckboxes($datos, 'usuarios');
/* *********************Ejemplo de html************************** */
// if (isset($_POST['usuarios'])) {
//     // Recogemos los valores de los checkboxes marcados
//     $checkboxesMarcados = $_POST['usuarios'];

//     // Procesamos los valores
//     foreach ($checkboxesMarcados as $valor) {
//         echo "Checkbox marcado: " . htmlspecialchars($valor) . "<br>";
//     }
// }


/* Obtener datos de un archivo de texto */
function ObtenerDatosDeArchivo($nombreArchivo, $delimitador, $numeroCamposEsperados)
{
    $datos = array();   // Array para almacenar las líneas del archivo

    $fd = fopen($nombreArchivo, "r") or die("Error al abrir el archivo");

    // Mostramos el contenido del archivo
    while (!feof($fd))     // Mientras no hay llegado al fin del archivo
    {
        $linea = fgets($fd); // Extraemos una línea de ese archivo
        $linea = trim($linea); // Eliminamos espacios en blanco al principio y al final

        if ($linea === '') continue; // Saltamos líneas vacías

        $campos = explode($delimitador, $linea); // Separamos la línea en campos usando el delimitador proporcionado

        // Validamos el número de campos esperados
        if (count($campos) == $numeroCamposEsperados) 
        {
            // Guardamos la línea en el array de datos
            $datos[$campos[0]] = $linea; 
        }
    }

    fclose($fd);

    return $datos; // Devolvemos el array con los datos
}

?>
