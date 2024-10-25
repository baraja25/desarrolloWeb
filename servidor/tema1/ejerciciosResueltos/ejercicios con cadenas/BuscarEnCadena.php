
<html>

<?php 

function EstaContenida($conte,$princi) //Devuelve -1 si no esta contenida y en caso contrario la posición de comienzo
{
   $i=0;  //Inidice de la cadena principal
   
   $j=0;  //Indice de la cadena contenida
    
   $pos=-1;   // Por defecto suponemos que no está contenida
   
   //Hallamos la longitud de las dos cadenas
   
   $longPrinci=strlen($princi); 
   
   $longConte=strlen($conte);
   
   if( $longPrinci>=$longConte )   //Solo tenemos que buscar cuando la caden conte es igual o mas pequeña que la principal
   {
      $encontrado=FALSE;   //Aún no hemos encontrado la cadena
       
      while( ( $i<$longPrinci ) && !( $encontrado )   )    //Mientras estemos dentro de la cadena principal y no hayamos encontrado nada
      {
          $iAux=$i;  //Guardamos la posicion del indice exterior
          
          while ( ($j<$longConte ) && ( $i<$longPrinci ) && ( $conte[$j]==$princi[$iAux] )  )
          {
            $j++;
            $iAux++;  
          }
          // Hemos salido del bucle interior
          
          if ($j==$longConte)   //Si la j avanza hasta el final de la cadena conte es que esta dentro
          {
              $encontrado=TRUE;
              
              $pos=$i;   //Si lo hemos encontrado retornamos la posicion desde la que hemos hecho los avances 
          }
          else  //Hemos encotrado una letra que no coincide en las dos cadenas 
          {
            $j=0;
            $i++; //Incrementamos el indice principal
          }
              
      }
      
   }

   
   return $pos;
}



//Inicializamos las valores para las cadenas

$princi="";

$conte="";

$opc=1;  // Por defecto indicamos que no la quite varias veces




if (isset($_GET['Opcion']) )  //Y actualizamos con la nueva opcion
{
    $opc=$_GET['Opcion'];
}

if (isset($_GET['Quitar']) )   //Si pulsamos en quitar
{
    $princi=$_GET['Principal'];
    
    $conte=$_GET['Contenida'];
    
    $pos=EstaContenida($conte,$princi);
    
    if ($pos==-1  )
    {
       echo "La cadena $conte NO esta contenida dentro de $princi";
        
    }
    else 
    {
        echo "La cadena $conte esta contenida dentro de $princi en la posición $pos";
    }
        
    
    
}



?>



 <fieldset> 
  <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    
    Principal<input type="text" name="Principal" value='<?php echo $princi;  ?>'> 
           
    Contenida<input type="text" name="Contenida" value='<?php echo $conte;  ?>'> 
    
    
    Varias Veces:
    
    <?php   
    
    $opciones=array(0=>"Si",1=>"No");
    
    foreach ($opciones as $clave=>$valor )
    {
       echo  "$valor<input type='radio' name='Opcion' value='$clave' ";   
  
       if ($clave==$opc)  
       {
         echo " checked ";  
       }
       echo   ">";
    
    
    }
    ?>
   
     <input type="submit" name="Quitar" value="Quitar de Cadena">
   
    </form>

  </fieldset>  
</html> 
 
 
  
