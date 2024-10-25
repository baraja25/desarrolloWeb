<?php

$fd=fopen("Alumnos.txt","a+") or die("Error al abrir el archivo");

$saltoLin="\r\n";

$linea="Juan Perez Lopez".$saltoLin;

$linea2="Pepe Moreno Torres".$saltoLin;

fputs($fd,$linea);

fputs($fd,$linea2);

fclose($fd);


/*
 $fd=fopen("Dominios.txt","r") or die("Error al abrir el archivo");

//Mostramos el contenido del archivo

 while(!feof($fd) )     //Mientras No  llegado al fin del archivo
{
     $linea=fgets($fd); //Extraemos una linea de ese archivo

     echo $linea."<br>";
     
}

fclose($fd); 

*/

?>

