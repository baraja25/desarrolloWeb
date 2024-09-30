<?php

//arrays multidimensionales

$alumnos = array(
    "06459782h " => array("juan", "perez", "Lopez"),
    "05658936s " => array("Jose", "moreno", "garcia"),
    "05789412x " => array("Maria", "Ruiz", "Ruiz")
);


foreach ($alumnos as $key => $alumno) {
    echo "El alumno con dni clave: ", $key;

    foreach ($alumno as $key => $campo) {
        echo $campo, " ";
    }
    echo "<br>";
}
