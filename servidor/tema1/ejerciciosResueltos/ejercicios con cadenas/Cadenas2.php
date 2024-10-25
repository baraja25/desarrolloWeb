<html>

<body>

<?php 

$ordenada="";
$cadena="";

function ConvArray($cadena)
{
   $cadArray=array();
   
   for($i=0;$i<strlen($cadena);$i++)
   {
       $cadArray[]=$cadena[$i];
   }
   
  return $cadArray; 
}

function ConArrayCad($cadArray)
{
    $cadena="";
    
    for($i=0;$i<count($cadArray);$i++)
    {
        $cadena.=$cadArray[$i];
    }
    
    return $cadena;
}

if (isset($_GET['Ordenar']) )
{
    $cadena=$_GET['Cadena'];
    
    $cadArray=ConvArray($cadena);
    
    sort($cadArray);  //Ordenamos el array de caractares por valor
    
    $ordenada=ConArrayCad($cadArray);
}



?>

 <fieldset> 
   <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    
    Cadena <input type="text" name="Cadena"  value='<?php echo $cadena; ?>'>      
   
    <input type="submit" name="Ordenar" value="Ordenar sus Letras">

    Cadena Ordenada<input type="text" name="CadOrdenada" value='<?php echo $ordenada; ?>'>

  </form>

 </fieldset>  
</body> 
  
</html>