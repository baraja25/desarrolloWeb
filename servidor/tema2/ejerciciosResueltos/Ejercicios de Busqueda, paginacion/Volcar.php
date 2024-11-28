<?php

$host="localhost";

$user="root";

$pass="";

$base="Prueba";

$db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexio

$fd=fopen("Alumnos.txt","r") or die("Error al abrir el archivo");


$cont=0;  //Contador de registros insertados

while(!feof($fd) )
{
   $linea=fgets($fd);    
     
   $campos=explode(":",$linea);
   
   if (count($campos)==6 )  //Si es una linea con 6 campos
   {
      $consulta="insert into Alumnos values('$campos[0]','$campos[1]','$campos[2]','$campos[3]',$campos[4],'$campos[5]') "; 
      
      $resul=mysqli_query($db, $consulta);
      
      if ($resul)
      {
          //echo "Registro insertado correctamente";
          $cont++;
          
      }
      else
      {
          echo mysqli_error($db);
      }
      
   }
    
}

echo "<b>Se han insertado $cont registros</b>";

fclose($fd);

mysqli_close($db);



?>