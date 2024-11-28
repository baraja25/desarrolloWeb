
<html>
 <body>

 <?php 
 
function MostrarTabla($filas,$camposCad)
{
   echo "<fieldset><legend>Resultado de la búsqueda</legend></fieldset>"; 
    
   echo "<table border='2'>";
   echo "<th><a href='$_SERVER[PHP_SELF]?Orden=NIF&Campos=$camposCad'>NIF</a></th>";
   echo "<th><a href='$_SERVER[PHP_SELF]?Orden=Nombre&Campos=$camposCad'>Nombre</a></th>";
   echo "<th><a href='$_SERVER[PHP_SELF]?Orden=Apellido1&Campos=$camposCad'>Apellido1</a></th>";
   echo "<th><a href='$_SERVER[PHP_SELF]?Orden=Apellido2&Campos=$camposCad'>Apellido2</a></th>";
   echo "<th><a href='$_SERVER[PHP_SELF]?Orden=Edad&Campos=$camposCad'>Edad</a></th>";
   echo "<th><a href='$_SERVER[PHP_SELF]?Orden=Telefono&Campos=$camposCad'>Telefono</a></th>"; 
   
   foreach($filas as $fila) 
   {
      echo "<tr>";
      
      foreach ($fila as $campo)
      {
        echo "<td>$campo</td>";  
      }
      
      echo "</tr>";
       
   }
   
   echo "</table>";
   
   echo "</fieldset>";
}
 
 
 $host="localhost";
 
 $user="root";
 
 $pass="";
 
 $base="Prueba";
 
 $db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexion
 
 
 $campos=array(); //Array con los campos de búsqueda
 

 $campos[0]="";
 
 if (isset($_POST['Nombre']) )
 {
     $campos[0]=$_POST['Nombre'];
 }
 
 $campos[1]="";
 
 if (isset($_POST['Apellido1']) )
 {
     $campos[1]=$_POST['Apellido1'];
 }
 
 $campos[2]="";
 
 if (isset($_POST['Apellido2']) )
 {
     $campos[2]=$_POST['Apellido2'];
 }
 
 $campos[3]="";
 
 if (isset($_POST['Min']) )
 {
     $campos[3]=$_POST['Min'];
 }
 
 $campos[4]="";
 
 if (isset($_POST['Max']) )
 {
     $campos[4]=$_POST['Max'];
 }
  
?>
 
 <fieldset><legend>Buscar Alumnos</legend> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        
        Nombre<input type="text" name="Nombre" ><br>      
        Apellido1<input type="text" name="Apellido1"><br> 
        Apellido2<input type="text" name="Apellido2"><br>   
    
        Edad Minima<input type="text" name="Min" size="3">Edad Máxima<input type="text" name="Max" size="3"><br>
        
        <input type="submit" name="Buscar" value="Buscar">
      
      </form>

  </fieldset>
  
  <?php
  
  if ( isset($_POST['Buscar']) || (isset($_GET['Orden']))  ) 
  {
     $orden="NIF";  //Por defecto ordenamos por NIF
     
     if ( isset($_GET['Orden']) )   //Salvo que reciba otro campo de ordenación
     {
         $orden=$_GET['Orden'];   //Recogemos el campos de ordenación
         
         $campos=explode(",",$_GET['Campos']); // Y los campos de filtrado en búsqueda
     }
     
         $consulta="select * from Alumnos where 1 ";
         
         if ($campos[0]!="")
         {
             $consulta.=" AND Nombre like '%$campos[0]%' ";
         }
         
         if ($campos[1]!="")
         {
             $consulta.=" AND Apellido1 like '%$campos[1]%' ";
         }
         
         if ($campos[2]!="")
         {
             $consulta.=" AND Apellido2 like '%$campos[2]%' ";
         }
         
         if ($campos[3]!="")
         {
             $consulta.=" AND Edad>='$campos[3]' ";
         }
         
         if ($campos[4]!="")
         {
             $consulta.=" AND Edad<='$campos[4]' ";
         }
            
         
         $consulta.=" ORDER BY $orden";
         
         
         $resul=mysqli_query($db, $consulta);
         
         if ($resul==FALSE)
         {
             Echo "Error en la consulta:".mysqli_error($db);
             
         }
         else 
         {
             $filas=mysqli_fetch_all($resul,MYSQLI_ASSOC);
         
             $camposCad=implode(",", $campos); //Convertimos en cadena el array con los campos de búsqueda
             
             MostrarTabla($filas,$camposCad);  //Mostrmos una tabla con los resultados de la consulta
         
         }
        
        
         
   }
 
 
 
 
 mysqli_close($db);
 
 ?>
  
  
  
    
 </body> 
</html> 
