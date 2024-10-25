
<html>

 <body>
  <?php

  
  $mayor=0;
  $lim="";
  $tam="";
  
  if(isset($_GET['Enviar']) )
  {
     $tam=$_GET['Tam']; 
      
     $lim=$_GET['Limite']; 
     
     //Creamos el array de tamaño tam con ese límite de mayor elemento
      
     $numeros=array();
     
     for($i=0;$i<$tam;$i++)
     {
         $numeros[]=rand(1,$lim); //Rellenamos con un numero entre el 1 el limite
         
     }
     
     //Mostramos el array y buscamos el mayor
     
     echo "[";
     
     for($i=0;$i<$tam;$i++)
     {
         echo $numeros[$i].",";
         
         if ($numeros[$i]>$mayor)
         {
             $mayor=$numeros[$i];
         }
     }
  
     echo "]";
     
  }
    
  ?>
  
  <fieldset> 
  <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
       
   
    Tamaño<select name="Tam">
            <option value=''>&nbsp</option>          
          <?php 
          
          for($i=10;$i<=20;$i++)
          {
            echo "<option value='$i' ";

            if ($i==$tam)
            {
              echo " selected ";  
            }
            echo  ">$i</option>";  
          }
          
          
          ?>  
    
    
          </select>
    
    Limite Superior <input type="number" placeholder="1-30" name="Limite" value="<?php echo $lim; ?>">   
    
    Mayor Elemento  <input type="text" name="Mayor" value="<?php echo $mayor; ?>">

    <input type="submit" name="Enviar" value="Buscar Mayor">

    

  </form>

 </fieldset>   
  
  
  
 </body>
</html>
