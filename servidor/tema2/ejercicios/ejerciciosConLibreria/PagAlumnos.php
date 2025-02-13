<html>

 <body>

 <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'> 
 <fieldset><legend>Paginación de Registros</legend>

<?php

   require_once 'libreria.php';

   function HallarPaginas($numreg)
   {
     $consulta="select count(*) as total from Alumnos";
       
     $filas=ConsultaDatos($consulta);
     
     $fila=$filas[0];
       
     $total=$fila['total'];  //Contamos el total de registros en la tabla
     
     $numpag=ceil($total/$numreg);  //Calculamos el numero de páginas
          
     return $numpag; 
   }
   
   
   $numreg=5;  //Por defecto fijamos el número de registros a 5
   
   if (isset($_POST['NumReg']) ) 
   {
     $numreg=$_POST['NumReg'];
  
   }

   if (isset($_GET['NumReg']) )
   {
       $numreg=$_GET['NumReg'];
       
   }
   
   
   $pag=1;  //Empezamos por defecto mostrando la página 1 
   
   if (isset($_GET['NumPag'] ) )
   {
       $pag=$_GET['NumPag'];
       
   }
   
   //Calculamos cuantas páginas tenemos que mostrar   
   
   $numpag=HallarPaginas($numreg);
   
   $ini=($pag-1)*$numreg ;
  
   $consulta="select * from Alumnos limit $ini,$numreg";
   
   $filas=ConsultaDatos($consulta);
   
   echo "<table border='2'>";
   echo "<th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Telefono</th><th>Premios</th>";
   
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

   echo "<label for='NumReg'>Registros a mostrar:</label>";
   echo "<select name='NumReg' onChange='document.f1.submit()'>";
      
   for($i=1;$i<11;$i++)
   {
       echo "<option value=$i ";
       
       if ($numreg==$i)
       {
           echo " selected ";
       }
       
       echo ">$i</option>";
   }
   
   
   echo "</select>";

   echo "<br>";
   
   for($i=1;$i<=$numpag;$i++)
   {
       echo "<a href='$_SERVER[PHP_SELF]?NumPag=$i&NumReg=$numreg'>$i</a>&nbsp&nbsp";
   }
   
   
?>

 </fieldset>
 </form>

 </body>
</html>
