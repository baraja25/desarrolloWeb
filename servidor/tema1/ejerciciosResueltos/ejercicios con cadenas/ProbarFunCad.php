<?php

/*

$nombre="jUAN";

echo "Nombre original:$nombre nombre convertido:".ucfirst(strtolower($nombre));

*/

$nombre="telescopio";

$cad="tel";


if ( strpos($nombre,$cad)===FALSE )
{
    echo "La cadena $cad NO esta en la palabra $nombre" ; 
}
else 
{
    echo "La cadena $cad esta en la palabra $nombre en la posicion ".strpos($nombre,$cad) ; 
}



?>