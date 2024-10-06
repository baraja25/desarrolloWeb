<!-- ejercicio para buscar cadena dentro de una cadena y devuelva la posicion -->

<?php

function stringpos($aguja, $pajar)
{
    $longitudAguja = strlen($aguja);
    $longitudPajar = strlen($pajar);


    //recorrer la cadena principal
    for ($i = 0; $i <= ($longitudPajar - $longitudAguja); $i++) {
        $coincidencia = true;

        //comprueba que los caracteres coinciden
        for ($j = 0; $j < $longitudAguja; $j++) {
            echo "Comparando letra $aguja[$j] de aguja con " . $pajar[($i + $j)] . " de pajar <br>";

            if ($aguja[$j] !== $pajar[$i + $j]) {//si los caracteres no coinciden sale del  bucle
                $coincidencia = false;
                break;
            }

        }
        if ($coincidencia) {//si encuentra devuelve la posicion inicial
            return $i;
        }
    }
    // si no encuentra nada devuelve falso
    return false;
}

$palabra = "abracadabra";
$buscar = "cada";
$pos = stringpos($buscar, $palabra);

echo "la palabra $buscar se encuentra en la posicion $pos";


?>