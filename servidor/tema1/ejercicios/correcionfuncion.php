<?php
//serializar matriz
function serializarmatriz($matriz) {
    $serializada=""; //va a guardar una cadena serializada

    foreach ($matriz as $clave => $fila) {
        if ($serializada=="") {
            
            $serializada=$serializada.implode(",", $fila);
        } else {
            $serializada=$serializada.",".implode(",", $fila);
        }
    }



}


?>