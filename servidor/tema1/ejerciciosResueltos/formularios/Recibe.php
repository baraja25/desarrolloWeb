<?php

//Recepción de los datos del formulario


if ( isset($_GET['nombre'] ) )
{
 $nom=$_GET['nombre'];
}
else
{
  echo "Variable nombre no recibida";  

  $nom="";
}


$ape1=$_GET['Apellido1'];

$ape2=$_GET['Apellido2'];


echo "Hola $nom $ape1 $ape2";



?>