
<html>

<?php 

function EsPalindroma($princi) 
{
  $pal=FALSE;
 
  $i=0; //Puntero al inicio de la cadena
  
  $j=strlen($princi)-1; //Puntero al final 
  
  while( ( $j>$i)  && ($princi[$i]==$princi[$j]) )
  {
     $i++;  //Avanzamos el puntero inicial 
     $j--;  //Retrocedemos el puntero final     
  }
  
  if ($j<=$i)   //Si termina por que el puntero final es menor o igual que inicial
  {
      $pal=TRUE;
  }
 
  return $pal;
 
}



if (isset($_GET['Buscar']) )
{
    $princi=$_GET['Principal'];
    
   
    $pal=EsPalindroma($princi);
    
    if ( $pal==TRUE  )
    {
       echo "La cadena $princi es palíndroma";
        
    }
    else 
    {
        echo "La cadena $princi NO es palíndroma";
    }
        
    
    
}



?>



 <fieldset> 
  <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    
    Principal<input type="text" name="Principal" value=''> 
           
   
    
    <input type="submit" name="Buscar" value="Buscar en Principal">

    

    </form>

  </fieldset>  
</html> 
 
 
  
