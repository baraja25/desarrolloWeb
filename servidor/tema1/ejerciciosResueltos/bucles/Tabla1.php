<html>
<title>Tabla 1</title>

<?php 

$fil='';
$col='';
$conte='';

if (isset($_GET['Filas'])  )
{
   $fil=$_GET['Filas'];
}
if (isset($_GET['Columnas'])  )
{
    $col=$_GET['Columnas'];
}
if (isset($_GET['Contenido'])  )
{
    $conte=$_GET['Contenido'];
}


?>



<body>
<form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

   <label for='Filas'>Filas</label>
    <select name='Filas' >        
       <option value=''></option>      
       <?php 
       
        for($i=1;$i<=10;$i++)
        {
          if ($i==$fil)  
          {
           echo "<option value='$i' selected>$i</option>";  
          }
          else 
          {
           echo "<option value='$i'>$i</option>";  
          }
          
        }
       
       
       ?>
         
    </select>
    <label for='Columnas'>Columnas</label>
    <select name='Columnas' >        
       <option value=''></option>      
       <?php 
       
        for($i=1;$i<=10;$i++)
        {
            if ($i==$col)
            {
                echo "<option value='$i' selected>$i</option>";
            }
            else
            {
                echo "<option value='$i'>$i</option>";
            }
            
        }
       
       
       ?>
         
    </select> 
     
  
  <label for='Contenido'>Contenido</label><input type='text' name='Contenido' value='<?php echo $conte  ?>'     >
  
 <input type='submit' name='Mostrar' value='Mostrar'>
   
 </form>
 
 <?php 
 
 
 if (isset( $_GET['Mostrar'] )  )      //Si Pulso el botón calcular
 {
     //mostramos la tabla
     
     echo "<table border='2'>";
     
     for($i=0;$i<$fil ;$i++)
     {
         echo "<tr>";
        
         for($j=0;$j<$col;$j++)
         {
          echo "<td>$conte</td>";
     
         }
             
         echo "</tr>";
             
     }
     
     echo "</table>";
    
 }
 
 
 
 
 ?>
 
 
 
 

</body>

</html>

