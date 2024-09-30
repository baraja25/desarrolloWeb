<?php

// function Ejemplo() {

//     global $num; //accede a la variable globl

//     for ($i=0; $i < $num; $i++) { 
//         echo "Hola";
//     }





// }



// function potencia($base, $exponente) {
//     $potencia=1;

//     for ($i=0; $i < $exponente; $i++) { 
//         $potencia*=$base;
//     }
//     return $potencia;
// }

// $base=2;
// $exponente=3;

// potencia($base, $exponente);

// echo "el resultado de la potencia de $base elevado a $exponente es: ", potencia($base, $exponente);

//Ejemplo();

$numero = 15;

$numDecremento = 5;

$valorDecremento = 2;

echo "El numero original es: $numero";

function decrementar(&$numero, $numDecremento, $valorDecremento)
{
    while ($numDecremento >= 0) {
        $numero = $numero - $valorDecremento;
        $numDecremento--;
    }
}


decrementar($numero, $numDecremento, $valorDecremento);

echo "Decrementado $numDecremento veces en $valorDecremento resulta en: $numero ";
