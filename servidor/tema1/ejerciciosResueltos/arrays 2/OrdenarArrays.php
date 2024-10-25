<?php

$edades=array();

$edades["Jose"]=21;
$edades["Luis"]=19;
$edades["Rafa"]=20;
$edades["Tomas"]=22;
$edades["Edu"]=25;

echo "Antesde ordenar:<br>";

echo "[";

foreach ($edades as $clave=>$valor)
{
    echo  "Clave: $clave  valor $valor. " ;
    
}

echo "]";

echo "<br>";

krsort($edades); //Ordenacion por valor ascendente

echo "Despues de ordenar:<br>";

echo "[";


foreach ($edades as $clave=>$valor)
{
    echo  "Clave: $clave  valor $valor. " ;
    
}

echo "]";


?>