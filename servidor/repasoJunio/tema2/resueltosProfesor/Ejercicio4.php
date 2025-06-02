<html>
<?php 

require_once 'libreria.php';

$consulta="select id,foto from coche ";

$filas=ConsultaDatos($consulta);

?> 
  
 <body>
 
  <form name='f1' method='post' action='Detalle4.php'>
   <input type='submit' name='Detalle' value='Detalle'>
    <table border='2'>
    <th>Selec</th><th>Foto</th>
     <?php 
     
     foreach ($filas as $fila)
     {
        echo "<tr>"; 
        
        echo "<td><input type='checkbox' name='Selec[$fila[id]]'></td>";
        
        $conte=$fila['foto'];
         
        echo "<td><img src='data:image/jpg;base64,$conte'  width='80' height='80'></td>"; 
        
        
        echo "</tr>";
     }
     
     ?>
    
    </table>
 
  </form>
 
 
 </body>
 


</html>
