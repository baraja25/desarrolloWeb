<?php

//Conectar al Servidor de BBDD

  $host="localhost";
  
  $user="root";
  
  $pass="";
  
  $base="Prueba";

  $db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexion

  $consulta="insert into Alumnos values('33333333C','Pedro','Lopez','Moreno','222333444')";
  
  $resul=mysqli_query($db, $consulta);
  
  if ($resul==FALSE)
  {
      Echo "Error en la consulta:".mysqli_error($db);
      
  }
  
  mysqli_close($db);
  
  
  
  
  
  

?>