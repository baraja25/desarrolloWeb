<?php

/*

$alumnos=array('Juan'=>array('Fol'=>4,'Ingles'=>7,'Cliente'=>8,'Servidor'=>9),
                3=>array('Fol'=>5,'Ingles'=>3,'Cliente'=>4),
               2.53=>array('Fol'=>7,'Ingles'=>1,'Cliente'=>1)
              );
 

echo "<table border='2'>";

foreach($alumnos as $clave=>$valor)
{ 
    
    echo "<tr>";
    
    echo "<td>$clave</td>";
    
    foreach($valor as $modulo=>$nota )
    {
        echo "<td>Modulo:$modulo Nota: $nota</td>";
        
    }
    
    echo "</tr>";
    
}

echo "</table>";


$notas=array('Fol'=>4,'Ingles'=>7,'Cliente'=>8,'Servidor'=>9);  //Array con las notas de un alumno


in_array(10,$notas);

array_key_exists("Fol", $notas);



//$notas=array('Fol'=>4,'Ingles'=>7,'Cliente'=>8,'Servidor'=>9);  //Array con las notas de un alumno

$notas=array(4,7,8,9);



$valor=4;

if ( array_search($valor, $notas)!==false )
{
    echo "El elemento con valor $valor esta en el array"; 
}
else 
{
   echo "El elemento con valor $valor no está en el array"; 
}

*/


function Mostrar($vector)
{
    foreach ($vector as $clave=>$valor  )
    {
        echo "Clave $clave valor $valor";
        
        echo "<br>";
    }
}

$notas=array('Fol'=>6,'Ingles'=>3,'Cliente'=>2,'Servidor'=>9);

echo "Antes de ordenar<br>";

Mostrar($notas);

echo "<br>";

krsort($notas);  // Ordenamos el array por valor

echo "Despues de ordenar<br>";

Mostrar($notas);





?>