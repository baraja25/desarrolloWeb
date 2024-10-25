
<html>

 <body>
  <?php

  
  $menor="";
  $lim=0;
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
     
     $menor=min($numeros);  //Inicializamos menor el primer elemento del array
     
     echo "[";
     
     for($i=0;$i<$tam;$i++)
     {
         echo $numeros[$i].",";
         /*
         if ($numeros[$i]<$menor)
         {
             $menor=$numeros[$i];
         }
         
         */
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
    
    Menor Elemento  <input type="text" name="Mayor" value="<?php echo $menor; ?>">

    <input type="submit" name="Enviar" value="Buscar Menor">

    

  </form>

 </fieldset>   
  
  
  
 </body>
</html>
