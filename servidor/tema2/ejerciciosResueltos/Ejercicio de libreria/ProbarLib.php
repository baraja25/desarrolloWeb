<?php

require_once 'libreria.php'; 

$consulta="Delete from Alumnos where NIF='88888888J'";

ConsultaSimple($consulta);

/* 
 
$consulta="select * from Notas";

$filas=ConsultaDatos($consulta);

echo "<table border='2'>";

foreach ($filas as $fila)
{
    echo "<tr>";
    
    foreach ($fila as $campo)
    {
        echo "<td>$campo</td>";
    }
        
    
    echo "</tr>";
    
}

echo "</table>";


*/



?>