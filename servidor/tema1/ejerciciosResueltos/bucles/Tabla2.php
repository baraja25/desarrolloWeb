<html>
<title>Tabla 1</title>

<body>
<form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

   <label for='Tipo'>Tipo</label>
    <select name='Tipo' >        
       <option value=''></option>      
       <option value='1'>Filas</option>
       <option value='2'>Columnas</option>   
    </select> 


   <label for='Tam'>Tamaño</label>
    <select name='Tam' >        
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
    
  <label for='Contenido'>Contenido</label><input type='text' name='Contenido'   >
  
 <input type='submit' name='Mostrar' value='Mostrar'>
   
 </form>
 
 <?php 
 
 
 if (isset( $_GET['Mostrar'] )  )      //Si Pulso el botón calcular
 {
     //mostramos la tabla
     
     
     $tipo=$_GET['Tipo']; 
     $tam=$_GET['Tam'];
     $conte=$_GET['Contenido'];
     
     if ($tipo==1)       //Me piden mostrarlo en varias filas
     {
         $fil=$tam;
         $col=1;
     }
     if ($tipo==2)      //Me piden mostrar varias columnas
     {
         $fil=1;
         $col=$tam;
         
     }
     
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

