<!DOCTYPE html>
<html>

<body>

<?php 

require_once 'libreria.php';

$consulta="select * from Alumnos";

$filas=ConsultaDatos($consulta);

echo "<fieldset><legend>Haga click en el alumno cuyas notas quiera mostrar</legend>";

echo "<table border='2'>";

foreach ($filas as $fila)
{
    echo "<tr>";
    
    foreach ($fila as $clave=>$campo)
    {
        if ($clave=="NIF")
        {  
          echo "<td><a href=$_SERVER[PHP_SELF]?NIF=$campo>$campo</a></td>";
        }
        else 
        {
         echo "<td>$campo</td>";
        }
         
         
     }
    
    
    echo "</tr>";
    
}

echo "</table>";

echo "</fieldset>";


if (isset($_GET['NIF']) )  //Si recibimos un nif mostramos sus notas
{
    $nif=$_GET['NIF'];
    
    $consulta="SELECT n.NIF,m.Nombre,n.Nota 
               FROM Notas n,Modulos m 
               WHERE n.CodMod=m.Id AND NIF='$nif'";
    
    $filas=ConsultaDatos($consulta);
    
    echo "<fieldset><legend>Notas del alumno</legend>";
    
    echo "<table border='2'>";
    echo "<th>Módulo</th><th>Nota</th>";
    
       
    foreach ($filas as $fila)
    {
        echo "<tr>";
           
        foreach ($fila as $clave=>$campo)
        {
          if ($clave!="NIF")
          {
           echo "<td>$campo</td>";
          }
        }
        
        echo "</tr>";
        
    }
       
    echo "</table>";
    
    echo "</fieldset>";
}






?>



   




</body>    
    
  
</html> 