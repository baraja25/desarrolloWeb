<?php

//Declaracion de funciones. Entrada y salida de datos


$num=10;

/*

function Ejemplo() 
{
    global $num;    //Acceso a variable global
    
    for($i=0;$i<$num;$i++)
    {
     echo "Hola<br>";
    }
}

$potencia=1;

function Potencia($base,$exp) 
{
   global $potencia;
    
   for($i=0;$i<$exp;$i++)  
   {
       $potencia*=$base;
   }
     
}

$base=2;

$exp=3;

Potencia($base,$exp); 

echo "El resultado de la potencia de $base elevado a $exp es:$potencia";



function Potencia($base,$exp)
{
    $potencia=1;
    
    for($i=0;$i<$exp;$i++)
    {
        $potencia*=$base;
    }
    
    return $potencia;
}

$base=2;

$exp=3;

echo "El resultado de la potencia de $base elevado a $exp es: ".Potencia($base,$exp)   ;

*/


$numero=15;

$NumDecrementos=5;

$ValorDecrementos=2;

echo "El numero original es $numero<br>";

function Decrementar(&$numero,$NumDecrementos,$ValorDecrementos)
{
    while($NumDecrementos>0)
    {
        $numero=$numero-$ValorDecrementos;
        
        $NumDecrementos--;
    }
      
}

Decrementar($numero,$NumDecrementos,$ValorDecrementos);

echo "Decrementado $NumDecrementos veces en $ValorDecrementos resulta $numero";








?>