
<html>

<?php 

function DentroCadena($cad,$pos)   //Funcion que indica si esa posicion esta dentro de los límites de la cadena
{
    return ( ($pos>=0) && ($pos<strlen($cad) ) ) ;
    
}

function QuitarCad($cad,$ini,$fin)    //Extrae de una cadena los caracteres delimitados por las posiciones indicadas
{
    $sub="";
    
    if ( DentroCadena($cad,$ini) && DentroCadena($cad,$fin)   )
    {
        if ($ini>$fin)
        {
            echo "<B>Error</B> Ha introducido un valor inicial mayor que el final";
        }
        else
        {     //Extraemos de la cadena principal el segmento pedido
            
            for($i=0;$i<strlen($cad);$i++)
            {
                if ( ($i<$ini) || ($i>$fin) )
                {
                    $sub.=$cad[$i];
                }
            }
        }
        
        
    }
    else  //Error los limites introducidos no estan dentro de la cadena
    {
        echo "<B>Error los limites introducidos no estan dentro de la cadena</B>";
    }
    
    return $sub;
    
}


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

$opc=2;  // Por defecto indicamos que no la quite varias veces


if (isset($_GET['Opcion']) )  //Y actualizamos con la nueva opcion
{
    $opc=$_GET['Opcion'];
}

if (isset($_GET['Principal']))
{
 $princi=$_GET['Principal'];
}
if (isset($_GET['Contenida']))
{
 $conte=$_GET['Contenida'];
}

?>



 <fieldset> 
  <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    
    Principal<input type="text" name="Principal" value='<?php echo $princi;  ?>'> 
           
    Contenida<input type="text" name="Contenida" value='<?php echo $conte;  ?>'> 
    
    
    Varias Veces:
    
    <?php   
    
    $opciones=array(1=>"Si",2=>"No");
    
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

   <?php 
   
   if (isset($_GET['Quitar']) )   //Si pulsamos en quitar
   {
     
       $PrinciAux=$princi;  //Guardamos la cadena principal en una auxiliar
       
       $pos=EstaContenida($conte,$PrinciAux);
       
       $Extraida="";
       
       while ( $pos>=0 )      //La cadena estaba contenida dentro de la principal
       {
           $Extraida=QuitarCad($PrinciAux, $pos, ($pos+strlen($conte))-1  );
           
           if ($opc==1)    //Si hemos marcado que la quite varias veces
           {
               $pos=EstaContenida($conte,$Extraida);  //Volvemos a buscar otra ocurrencia de la cadena conte dentro de la principal
               
               $PrinciAux=$Extraida;  //Hay que actualizar el valor PrinciAux para que le quitemos la parte extraida
           }
           else //Si habiamos marcado que no la quite varias veces
           {
               $pos=-1;  //Fijamos el valor de pos para que salga
           }
           
       }
       
       echo "<br>";
       
       echo "La cadena extraida seria: $Extraida";
       
       
   }
   
   
   
   
   
   
   
   
   
   ?>




  </fieldset>  
</html> 
 
 
  
