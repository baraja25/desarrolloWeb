
<html>

<title>Prueba de ordenacion</title>
<body>

<?php 


$num=10;   // Variable va a recoger el numero que reciba en la recarga

if (isset( $_GET['Numero'] )  )   
{
    //Recogemos los datos 

    $num=$_GET['Numero'];
 
}


$orden='';

if (isset( $_GET['Orden'] )  )
{
    //Recogemos los datos
    
    $orden=$_GET['Orden'];
    
}



?>

  <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
  
    <label for='Numero'>Numeros</label>
      <select name='Numero' >        
          <option value=''></option>
         
         <?php 
         
         for ($i=5;$i<16;$i++)
         {
             echo "<option value='$i' ";

             if ($i==$num)
             {
              echo " selected ";
             }

             echo   ">$i</option>";
             
         }
        
         ?>
         
      </select>
  
      <input type='submit' name='Mostrar' value='Array Nuevo'>
        <br>
        
     <?php 
     
     function RellenarArray(&$numeros,$num)
     {
         for($i=0;$i<$num;$i++)
         {
             $numeros[]=rand(1,30);  //Rellenamos con numeros entre el 1 y el 30
             
         }
         
     }
     
     function Mostrar($numeros)
     {
         foreach ($numeros as $clave=>$valor)
         {
             echo "[$valor]";
         }
     }
     
     
     if ( (isset($_GET['Mostrar']) ) ||  ( isset($_GET['Ordenar'])     )   )
     {
          $numeros=array();
          
          if (isset($_GET['Mostrar']) )     //Tenemos que rellenar el array con nuevos numeros
          {
              RellenarArray($numeros,$num);
          }
          else //Le hemos dado a ordenar
          {
                                                       
              $arrayAnterior=$_GET['ArrayAnterior'];   //Recuperamos los datos del array anterior
                                       
              $numeros=explode(",", $arrayAnterior);   //volvemos a guardar en numeros sus datos anteriores                       
                        
              
          }
              
       
           echo "<fieldset>";   
              
           Mostrar($numeros);   // Mostramos el array de numeros
       
           echo "<br>"; 
           echo "<br>"; 
            
           echo "<label for='Orden'>Orden</label>";
           echo "<select name='Orden' >";
           echo "   <option value=''></option>";
           
               $ordenTipo=array(1=>'Ascendente',2=>'Descendente'); 
               
               foreach ($ordenTipo as $clave=>$valor)
               {
                 echo "<option value='$clave' ";
                 
                 if ($clave==$orden)     //Si la clave del array coindide con la del orden anterior
                 {
                   echo " selected ";  
                 }
                 
                 echo ">$valor</option>";
                   
               }
        
       
      
       echo "</select>";
       
       $Anterior=implode(",",$numeros);    //Convertimos el array de numeros a tipo cadena
       
       echo "<input type='hidden' name='ArrayAnterior' value='$Anterior'>";
        
       echo "<input type='submit' name='Ordenar' value='Ordenar'>";
       
       
       //Los ordenamos según el orden anteriormente indicado
       
       
       
       
       if ( isset($_GET['Ordenar'])    ) 
       {
           $tipo=$_GET['Orden']; //Recogemos el tipo de orden
           
           if ($tipo==1)     //El orden es ascendente
           {
            sort($numeros);
           } 
           if ($tipo==2)     //El orden es descendente
           {
            rsort($numeros);
           }
           
           echo "<br>";
           
           echo "<b>El array ordenado es:</b><br>";
           
           Mostrar($numeros);   // Mostramos el array de numeros ordenado
           
       }
       
       
       echo "</fieldset>";
      }
     
     ?>   
        
   </form>

 </body>


</html>

