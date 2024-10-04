<!-- ejercicio para buscar cadena dentro de una cadena y devuelva la posicion -->

<?php

function stringpos($aguja , $pajar) {
    $coincidencia="";


    for ($i=0; $i < strlen($aguja); $i++) { 
        echo "buscando letra $aguja[$i] de aguja ";
        for ($j=0; $j < strlen($pajar); $j++) { 
            echo "buscando letra $pajar[$j] de pajar ";
            if ($aguja[$i] === $pajar[$j]) {
                echo " encontre ";
                
                $coincidencia .= $pajar[$j];
            }
        }
    }

    if ($coincidencia === $aguja) {
        return 
    }


}

$palabra = "abracadabra";
$buscar = "cada";
$pos = stringpos($buscar, $palabra);

echo "la palabra $buscar se encuentra en la posicion $pos";


?>