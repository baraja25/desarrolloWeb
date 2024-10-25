<html>

<?php

//Inicializamos las variables ini y fin

$ini=0;
$fin=0;

if (isset($_GET['Enviar'] )  )            //Hemos pulsado el botón de submit
{
    //Recepción de los datos del formulario
    
 $ini=$_GET['Inicial'];
   
 $fin=$_GET['Final'];

}

?>

<body>

 <fieldset><legend>Tablas de Multiplicar</legend> 
  <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    
    Tabla Inicial<select name="Inicial">
                   <option value=""></option>
                   <?php 
                   
                    for($i=1;$i<=10;$i++)
                    {
                        echo "<option value='$i' ";
                    
                         if($i==$ini)
                         {
                           echo " selected ";
                         }
                         
                         echo ">$i</option>"; 
                                    
                    }
    
                   ?>
                       
                 </select>
               Tabla Final <select name="Final">
                   <option value=""></option>
                   <?php 
                   
                   for($i=1;$i<=10;$i++)
                   {
                       echo "<option value='$i' ";
                       
                       if($i==$fin)
                       {
                           echo " selected ";
                       }
                       
                       echo ">$i</option>";
                       
                   }
    
                   ?>
                       
                 </select>  
    
    
    
    <input type="submit" name="Enviar" value="Mostrar Tablas">

    

  </form>

 </fieldset>   

 <?php 
 
  //Mostramos las tablas del intervalo pedido
  
 
 
 if ($ini>$fin)
 {
   echo "<b>Error, el valor inicial debe ser inferior al final</b>";       
 }

 
 
 
 if ( !empty($ini) &&  !empty($fin)  )
 {
  for($i=$ini;$i<=$fin;$i++) 
  {
      echo "<table border='2'>";
      echo "<th colspan='2'>Tabla del $i</th>";
      echo "<tr><td><b>Operación</b></td><td><b>Resultado</b></td></tr>";
      
      for($j=1;$j<=10;$j++)
      {
        echo "<tr>";  
        echo "<td> $i X $j = </td><td>".($i*$j)."</td>";         
         
        echo "</tr>";
      }
      
      echo "</table>";
   }
 }
 
 
 
 
 
 
 
 ?>


 



 
</body>

</html>