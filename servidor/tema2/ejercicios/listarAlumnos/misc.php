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
?>
