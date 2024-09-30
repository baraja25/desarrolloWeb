<?php
$num = 10;
function Ejemplo() {
    
    global $num; //accede a la variable globl

    for ($i=0; $i < $num; $i++) { 
        echo "Hola";
    }
    
    



}

Ejemplo();

?>