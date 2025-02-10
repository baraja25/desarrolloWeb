<?php

require_once 'LibreriaPDO.php';

$base="Tema3";

$db= new DB($base);

$consulta="select * from Ciclos";

$db->ConsultaDatos($consulta);

$consulta="select * from Paises";

$db->ConsultaDatos($consulta);


foreach($db->filas as $fila )
{
   
   foreach ($fila as $campo) 
   {
     echo "<td>$campo</td>";  
   }
   
   echo "</br>";
}


?>