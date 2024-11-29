
<html>
 <body>

 <?php 
  
 
 function CalcularNumpag($num)     //Calculamos el total de páginas en función del número de registros en cada una y los registros totales
 {
   global $db;  
     
   $consulta="select count(*) as total from Alumnos ";
   
   $resul=mysqli_query($db, $consulta);
   
   if ($resul==FALSE)
   {
       Echo "Error en la consulta:".mysqli_error($db);
       
   }
   else
   {
       $fila=mysqli_fetch_assoc($resul);  //Recogemos una fila(la única)
       
       $NumPag=ceil($fila['total']/$num);
       
   }
   
   return  $NumPag;
     
 }
 
function MostrarTabla($filas)
{
   
    
   echo "<table border='2'>";
   echo "<th>NIF</th>";
   echo "<th>Nombre</th>";
   echo "<th>Apellido1</th>";
   echo "<th>Apellido2</th>";
   echo "<th>Edad</th>";
   echo "<th>Telefono</th>"; 
   
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
   
   
}
 
 
 $host="localhost";
 
 $user="root";
 
 $pass="";
 
 $base="tema2";
 
 $db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexion
 

$Pag=1; //Por defecto mostramos la información de la página 1

if (isset($_GET['Pag']) )
{
    $Pag=$_GET['Pag'];
}
 
$num=5;  //Fijamos por defecto a 5 el número de registros por página

if (isset($_POST['Numero']) )
{
    $num=$_POST['Numero'];
       
}

if (isset($_GET['Numero']) )
{
    $num=$_GET['Numero'];
    
}


 
?>
 
 <fieldset><legend>Paginación de Alumnos</legend> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
      
        Num Filas<select name="Numero" onChange="f1.submit();">
                  <option value=""></option> 
                  <?php 
                  
                  for($i=1;$i<=10;$i++)
                  {
                     echo "<option value='$i' "; 
                      
                     if ($i==$num)
                     {
                      echo " selected ";   
                     }
                        
                     echo ">$i</option>"; 
                        
                  }
                  
                  ?>
         
                 </select> <br>
             
      <?php      
               
                 //Determinar el registro inicial en función del número de página y el número de registros a mostrar
                 
                 $ini=($Pag-1)*$num;
      
                 $consulta="select * from Alumnos where 1 Limit $ini,$num";
                      
                 $resul=mysqli_query($db, $consulta);
                 
                 if ($resul==FALSE)
                 {
                     Echo "Error en la consulta:".mysqli_error($db);
                     
                 }
                 else 
                 {
                     $filas=mysqli_fetch_all($resul,MYSQLI_ASSOC);
                      
                     MostrarTabla($filas);  //Mostrmos una tabla con los resultados de la consulta
                 
                 }
                
             //Calculamos el número de páginas que tenemos que mostrar
                 
             $NumPag=CalcularNumpag($num);    
                 
             
             
             for($i=1;$i<=$NumPag;$i++)    
             {
               echo "<a href='$_SERVER[PHP_SELF]?Numero=$num&Pag=$i'>$i</a>  ";  
                 
             }
         
              mysqli_close($db);
 
      ?>
      
      
    </form>
  
  </fieldset>
  
</body> 

</html> 
