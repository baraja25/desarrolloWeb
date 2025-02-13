
<html>
<?php 

require_once 'libreria2.php';

?>

 <body>
  <fieldset> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>" enctype='multipart/form-data'  >
        
       <?php 
       
       $consulta="select * from Marcas";
       
       $filas=ConsultaDatos($consulta);
       
       echo "<table border='2'>";
       echo "<th>Marca</th><th>Imagen</th>";
       
       foreach ($filas as $fila)
       {
          echo "<tr>"; 
           
          echo "<td>$fila[Nombre]</td>"; 
          
          $imagenConte=$fila['Imagen'];   //Extraemos el contenido de la imagen
          
          echo "<td><img src='data:image/jpg;base64,$imagenConte'   width='80' height='80'></td>"; 
          
          echo "</tr>";
       }
       
       
       echo "</table>";
       
       ?> 
        
        
        
        
      
      </form>

  </fieldset>  
 </body> 
</html> 