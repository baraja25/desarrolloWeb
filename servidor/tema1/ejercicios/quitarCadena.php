<?php

//funcion que indica si esa posicion esta dentro de los limites de la cadena
function DentroCadena($cad, $pos)
{
    return ( ($pos>=0) && ($pos<strlen($cad)) );
}


function extraerCad($cad, $ini, $fin)
{
    $sub="";
    if (DentroCadena($cad, $ini) && DentroCadena($cad, $fin)) {
        if ($ini > $fin) {
            echo "<b>Error</b> ha introducido un valor inicial mayor que el final";
        } else {
            for ($i = $ini; $i <= $fin; $i++) {
                $sub .= $cad[$i];
            }
        }
    } else {
        echo "Error los limites introducidos no estan dentro de la cadena";
    }

    return $sub;
}


$cadena="telescopio";

$ini = 6;
$fin = 9;
$sub = extraerCad($cadena, $ini, $fin);
echo $sub;

?>

