<?php
function paginacion($host, $user, $pass, $base, $tabla, $num = 5, $pagina = 1) {
    // Conexión a la base de datos
    $db = mysqli_connect($host, $user, $pass, $base);
    if (!$db) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Función para calcular el número de páginas
    function calcular_num_paginas($db, $num, $tabla) {
        $consulta = "SELECT COUNT(*) AS total FROM $tabla";
        $resul = mysqli_query($db, $consulta);
        $fila = mysqli_fetch_assoc($resul);
        return ceil($fila['total'] / $num);
    }

    // Función para mostrar la tabla
    function mostrar_tabla($filas) {
        echo "<table border='2'>";
        echo "<th>NIF</th>";
        echo "<th>Nombre</th>";
        echo "<th>Apellido1</th>";
        echo "<th>Apellido2</th>";
        echo "<th>Edad</th>";
        echo "<th>Telefono</th>";

        foreach ($filas as $fila) {
            echo "<tr>";
            foreach ($fila as $campo) {
                echo "<td>$campo</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    // Consulta para obtener los registros de la página actual
    $ini = ($pagina - 1) * $num;
    $consulta = "SELECT * FROM $tabla LIMIT $ini, $num";
    $resul = mysqli_query($db, $consulta);

    if ($resul == FALSE) {
        echo "Error en la consulta: " . mysqli_error($db);
    } else {
        $filas = mysqli_fetch_all($resul, MYSQLI_ASSOC);
        mostrar_tabla($filas);
    }

    // Calculamos el número de páginas
    $num_paginas = calcular_num_paginas($db, $num, $tabla);

    // Enlaces de paginación
    echo "<div>";
    for ($i = 1; $i <= $num_paginas; $i++) {
        echo "<a href='$_SERVER[PHP_SELF]?Numero=$num&Pag=$i'>$i</a> ";
    }
    echo "</div>";

    // Cerrar la conexión
    mysqli_close($db);
}
?>