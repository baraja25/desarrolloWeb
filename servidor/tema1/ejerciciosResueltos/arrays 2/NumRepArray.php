
<html>

 <body>
  <?php

  
  $menor="";
  $tam=0;
  $repe="";
  
  if(isset($_GET['Enviar']) )
  {
     $tam=$_GET['Tam']; 
      
     $lim=$_GET['Limite']; 
     
     $repe=$_GET['Repe'];
     
     //Creamos el array de tamaño tam con ese límite de mayor elemento
      
     $numeros=array();
     
     for($i=0;$i<$tam;$i++)
     {
         $numeros[]=rand(1,$lim); //Rellenamos con un numero entre el 1 el limite
         
     }
     
     //Mostramos el array y buscamos el mayor
     
    $repeticiones=array(); //Array cuyas claves son los números del array y los valores sus repeticiones
     
     echo "[";
     
     for($i=0;$i<$tam;$i++)
     {
         echo $numeros[$i].",";
     
         if (!isset($repeticiones[$numeros[$i]]) )   //Si el número aún no había aparecido 
         {
             $repeticiones[$numeros[$i]]=1;  
         }
         else //Ese número ya había aparecido
         {
             $repeticiones[$numeros[$i]]=$repeticiones[$numeros[$i]]+1;    //Incrementamos en uno sus repeticiones  
         }
         
     }
  
     echo "]";
     
     //Mostramos del array repeticiones los que hayan aparecido mas veces que el numero de repeticiones
     
     foreach ($repeticiones as $clave=>$valor) 
     {
         
         //echo "El número $clave aparecer $valor veces <br>";
      
         if ($valor>=$repe) 
         {
           echo "El número $clave aparecer $valor veces ";
           echo "<br>";
         }
     
        
     }
     
     
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
    
    NumRep<select name="Repe">
            <option value=''>&nbsp</option>          
            <?php 
          
            for($i=1;$i<=5;$i++)
            {
              echo "<option value='$i' ";

              if ($i==$repe)
              {
                echo " selected ";  
              }
              echo  ">$i</option>";  
            }
          
          
          ?>  
    
    
          </select>
    

    <input type="submit" name="Enviar" value="Buscar Menor">

    

  </form>

 </fieldset>   
  
  
  
 </body>
</html>
