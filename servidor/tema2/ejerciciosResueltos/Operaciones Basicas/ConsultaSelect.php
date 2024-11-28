<?php

function MostrarCampos($fila) 
{
    foreach ($fila as $clave=>$campo) 
    {
      echo "Campo:$clave es $campo ";  
    }

    echo "<br>";
}



function MostrarTabla($filas) 
{
  echo "<table border='2'>";
  echo "<th>NIF</td><th>Nombre</td><th>Apellido1</td><th>Apellido2</td><th>Telefono</td>";
  
  foreach ($filas as $fila)
  {
     echo "<tr>"; 
      
     foreach ($fila as $campo)
     {
       echo "<td>$campo</td>";  
     }
      
     echo "</tr>"; 
  }
  
  
  echo "</table>";
    
    
}


$host="localhost";

$user="root";

$pass="";

$base="Prueba";

$db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexion

$consulta="SELECT * FROM Alumnos";

$resul=mysqli_query($db, $consulta);

if ($resul==FALSE)
{
    Echo "Error en la consulta:".mysqli_error($db);
    
}
else
{
  $filas=array();  // Declaramos un array para guardar las filas  
    
  //$filas=mysqli_fetch_all($resul);
  
  
  
 $fila=mysqli_fetch_assoc($resul);
  
 echo "Extracción con array asociativo<br>";
 
 MostrarCampos($fila); 
 
 $fila=mysqli_fetch_row($resul);
  
 echo "Extracción con array numérico<br>";
 
 MostrarCampos($fila); 
 
 $fila=mysqli_fetch_array($resul);
 
 echo "Extracción con ambos indices<br>";
 
 MostrarCampos($fila); 
 
 
 
 //MostrarTabla($filas);
    
    
}





?>