<?php

$host="localhost";

$user="root";

$pass="";

$base="Prueba";

$db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexio

$fd=fopen("Modulos.txt","r") or die("Error al abrir el archivo");


function ExisteId($Id)
{
    global $db;  
    
    $consulta="SELECT count(*) as cuenta
               FROM Modulos
               where Id=$Id ";
    
    
    $resul=mysqli_query($db, $consulta);
    
    if ($resul)
    {
      $fila=mysqli_fetch_assoc($resul); //Extraemos una fila(lá unica posible) del resultado  
        
      
    }
    else
    {
        echo mysqli_error($db);
    }
    
    return $fila['cuenta'];  //Devolvemos como valor de retorno la cuenta de esa fila
}


$cont=0;  //Contador de registros insertados

while(!feof($fd) )
{
   $linea=fgets($fd);    
     
   $campos=explode(":",$linea);
   
   if (count($campos)==4 )  //Si es una linea con 4 campos
   {
       
       if (!ExisteId($campos[0]))      //Si no existe ese Id en la tabla, realizamos la inserción  
       {
          $consulta="insert into Modulos values ($campos[0],'$campos[1]','$campos[2]',$campos[3]) "; 
          
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
       else //Ese Id existe para eso módulo
       {
          echo "<b>ERROR</b>El Módulo con Id $campos[0] ya existe<br> ";  
       }
                
   }
    
}

echo "<b>Se han insertado $cont registros</b>";

fclose($fd);

mysqli_close($db);



?>