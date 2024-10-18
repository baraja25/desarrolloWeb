<?php

/* acceder a un archivo */
$fd = fopen("archivoserver.txt", "r") or die("Error al abrir el archivo");

/* Mostrar el contenido de un archivo */
while (!feof($fd)) { //mientras no haya llegado al fin del archivo
    /* fgets avanza el puntero a la linea siguiente */
    $linea = fgets($fd); //extrae una linea de ese archivo

    echo $linea . "<br>";
}

fclose($fd); //cerrar archivo

/* Ejemplo de escritura */
$fd2 = fopen("alumnos.txt", "w") or die("Error al abrir el archivo");
$salto = "\r\n";
$linea1 = "juan jose".$salto;
$linea2 = "jose maria".$salto;

fputs($fd2, $linea1);
fputs($fd2, $linea2);

fclose($fd2)

?>