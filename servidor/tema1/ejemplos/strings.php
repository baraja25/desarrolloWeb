<?php
$nombre = "juan";

$apellido1 = "Gomez";

$apellido2 = "Perez";

//concatenar
echo $nombre." ".$apellido1." ".$apellido2;
echo "$nombre $apellido1 $apellido2";//no funciona con funciones, objetos o arrays

echo "<br>";

//uso de strlen()

for ($i=0; $i < strlen($nombre); $i++) { 
    echo $nombre[$i];
    echo "<br>";
}
?>