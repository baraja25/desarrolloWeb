<?php
//codigo para recorrer carpetas ignorando las referencias de windows -> .

$dir = opendir("../ejemplos");

$archivosTxt = array();

$archivosPhp = array();

$extensiones = array();

if ($dir) { // Verificar si se pudo abrir el directorio
    while (($nomFichero = readdir($dir)) !== false) {

        if (substr($nomFichero, 0, 1) != ".") {

            $campos = explode(".", $nomFichero);

            if ($campos[1] == "txt") {
                $archivosTxt[] = $nomFichero;
            }

            if ($campos[1] == "php") {
                $archivosPhp[] = $nomFichero;
            }
        }
    }
    
    foreach ($archivosTxt as $archivo) {
        echo "$archivo.<br>";
    }
    
    
    foreach ($archivosPhp as $archivo) {
        echo "$archivo.<br>";
    }
    sort($archivosTxt);
    sort($archivosPhp);
    
    closedir($dir);
} else {
    echo "No se pudo abrir el directorio.";
}
