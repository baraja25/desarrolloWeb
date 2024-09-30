<?php

//arrays multidimensionales declaracion y recorrido

$alumnos = array(
    "06459782h " => array("juan", "perez", "Lopez"),
    "05658936s " => array("Jose", "moreno", "garcia"),
    "05789412x " => array("Maria", "Ruiz", "Ruiz")
);

echo "<table border='2'>";
echo "<th>Dni</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th>";

foreach ($alumnos as $key => $alumno) {
    
    echo "<tr>";

    echo "<td>$key</td>";

    foreach ($alumno as $key => $campo) {
        echo "<td>$campo</td>";
    }
    echo "</tr>";
}

echo "</table>";
