
<?php

$numeros=array();

//Rellenamos el array con 10 numeros


 rand(0,50);

for($i=0;$i<10;$i++)
{
    $numeros[]=$i*3;
}


$numeros[3]=30;
$numeros[9]=90;
$numeros[5]=50;
$numeros[2]=20;
$numeros[1]=10;

foreach ($numeros as $clave=>$valor )
{
    echo "Clave:$clave  Valor:$valor <br>";
    
}



?>