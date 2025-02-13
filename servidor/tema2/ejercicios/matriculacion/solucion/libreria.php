<?php

//Archivo de librería para conectar a una BBDD

$host="localhost";

$user="root";

$pass="";

$base="Prueba";

function Conectar()
{
  global $host,$user,$pass,$base; 
    
  $db=mysqli_connect($host,$user,$pass,$base);  
    
  if ($db==FALSE)
  {
      echo "Error al conectar".mysqli_connect_error();  
      exit ;
  }
  
  return $db;  
}

function ConsultaSimple($consulta)   //Funcion que ejecuta una consulta que no devuelve datos
{
   $db=Conectar();
   
   $resul=mysqli_query($db, $consulta);
   
   if (!$resul)
   {
       echo mysqli_error($db);
   }
  
   Cerrar($db);
      
}

function ConsultaDatos($consulta)   //Funcion que ejecuta una consulta qu devuelve datos
{
    $db=Conectar();
    
    $filas=array();
    
    $resul=mysqli_query($db, $consulta);
    
    if (!$resul)
    {
        echo mysqli_error($db);
    }
    else //Si no hay error, retornamos todas las filas
    {
      $filas=mysqli_fetch_all($resul,MYSQLI_ASSOC);  
    }
    
    Cerrar($db);
    
    return $filas;
    
}


function Cerrar($db)
{
   mysqli_close($db);

}




?>