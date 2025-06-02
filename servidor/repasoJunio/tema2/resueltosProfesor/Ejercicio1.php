<html>
<?php 

require_once 'libreria.php';

$consulta="select id,foto from coche ";

$filas=ConsultaDatos($consulta);

?> 
  
 <body>
 
    <table border='2'>
    
     <?php 
     
     foreach ($filas as $fila)
     {
        echo "<tr>"; 
        
        $conte=$fila['foto'];
         
        echo "<td><a href='Detalle.php?Id=$fila[id]'><img src='data:image/jpg;base64,$conte'  width='80' height='80'></a></td>"; 
        
        
        echo "</tr>";
     }
     
     
     
     
     
     
     
     ?>
    
    
    
    
    
    
    </table>
 
 
 
 
 </body>
 


</html>
