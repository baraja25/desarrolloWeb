<html>
<?php 

require_once 'libreria.php';

?>   
 <body>
 
  <fieldset><legend>Busqueda de Coches</legend>
    
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']?>'>
    
       
        Marca<input type='text' name='Marca' value=''>
        Modelo<input type='text' name='Modelo' value=''>
        Precio Min<input type='text' name='Min' value='' size='7'>
        Precio Max<input type='text' name='Max' value='' size='7'>
        
     <input type='submit' name='Buscar' value='Buscar'>              
                              
   </form>
    
 </fieldset>
 
 <?php 
 
 if (isset($_POST['Buscar']) )
 {
     $marca=$_POST['Marca'];
     $modelo=$_POST['Modelo'];
     $min=$_POST['Min'];
     $max=$_POST['Max'];
     
     $consulta="select * from coche where 1 ";
     
     if ($marca!="")
     {
         $consulta.=" and marca='$marca'";
     }
     
     if ($modelo!="")
     {
         $consulta.=" and modelo='$modelo'";
     }
     
     if ($min!="")
     {
         $consulta.=" and precio>=$min";
     }
     
     if ($max!="")
     {
         $consulta.=" and precio<=$max";
     }
     
     echo $consulta;
     
     $filas=ConsultaDatos($consulta);
     
     
     echo "<table border='2'>";
     echo "<th>Id</th><th>Nombre</th><th>Marca</th><th>Modelo</th><th>Precio</th><th>Matricula</th><th>Año</th><th>Foto</th>";
     foreach ($filas as $fila)
     {
         echo "<tr>";
         
         foreach ($fila as $clave=>$valor)
         {
             
             if ($clave=='foto')
             {
                 $conte=$fila['foto'];
                 
                 echo "<td><a href='Detalle.php?Id=$fila[id]'><img src='data:image/jpg;base64,$conte'  width='80' height='80'></a></td>";
                 
             }
             else
             {
                 echo "<td>$valor</td>";
             }
             
         }
         
         echo "</tr>";
         
     }
     
     echo "</table>";
     
 }
 
 
 
 
 
 
 
 
 
 
 
 ?>
 
 
 </body>
 


</html>
