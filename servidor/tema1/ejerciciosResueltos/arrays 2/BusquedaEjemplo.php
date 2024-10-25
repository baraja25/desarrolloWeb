<?php

//Arrays multimensionales declaración y recorrido


$Alumnos=array("06167385H"=>array("Juan","Perez","Lopez"),
               "05172939J"=>array("Jose","Moreno","Garcia"),    
               "05782838F"=>array("Luis","Vera","Tellez")     );

echo "<table border='2'>";

echo "<th>Dni</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th>";

foreach ($Alumnos as $clave=>$alumno )
{
    echo "<tr>";
    
    echo "<td>$clave</td>";
    
    foreach ($alumno as $clave=>$campo )
    {
        echo "<td>$campo</td>";
      
    }
    
    echo "</tr>";
    
}

echo "</table>";


?>