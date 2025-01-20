<?php
require_once 'libreria.php';
$database = 'tema3';
$db = new db($database);

$consulta = "SELECT * FROM provincias where IdPais = :IdPais";

$params = array(":IdPais" => 1);

$db->consultaDeDatos($consulta, $params);

echo "<table border='1'>";
echo "<tr><th>id</th><th>nombre</th><th>Ciudad</th></tr>";
foreach ($db->rows as $row) {
    echo "<tr>";
    foreach ($row as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";