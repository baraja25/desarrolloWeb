<?php
function MostrarTabla($filas)
{
    echo "<table border=2>";
    echo "<th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Telefono</th>";
    foreach ($filas as $fila) {
        echo "<tr>";

        foreach ($fila as $campo) {
            echo "<td>$campo</td>";
        }
        echo "</tr>";
    }


    echo "</table>";
}


$host = "localhost";

$user = "root";

$pass = "";

$base = "tema2";


$db = mysqli_connect($host, $user, $pass, $base); // Conexion al servidor de base de datos y devuelve el decriptor de conexion

$consulta = "SELECT * FROM alumnos";

$resultado = mysqli_query($db, $consulta);

if ($resultado == false) {
    echo "Error al hacer la consulta" . mysqli_error($db);
} else {
    $filas = array();

    //$filas  = mysqli_fetch_all($resultado);

    while ($fila==mysqli_fetch_assoc($resultado)) {
        
    }

    MostrarTabla($filas);
}

mysqli_close($db);
