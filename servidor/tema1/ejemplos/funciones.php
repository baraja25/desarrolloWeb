<?php
$num = 10;
// function Ejemplo() {
    
//     global $num; //accede a la variable globl

//     for ($i=0; $i < $num; $i++) { 
//         echo "Hola";
//     }
    
    



// }



function potencia($base, $exponente) {
    $potencia=1;

    for ($i=0; $i < $exponente; $i++) { 
        $potencia*=$base;
    }
    return $potencia;
}

$base=2;
$exponente=3;

potencia($base, $exponente);

echo "el resultado de la potencia de $base elevado a $exponente es: ", potencia($base, $exponente);

//Ejemplo();

?>