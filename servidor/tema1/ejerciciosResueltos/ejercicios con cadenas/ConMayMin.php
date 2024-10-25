<html>

<body>

<?php 

$convertida=""; //Cadena convertida

$ope=1;  //Variable que representa la operación a realizar. Por defecto 1 a Mayúsculas

$cadena="";  //Cadena Original

$Letras=array();

$Letras['a']="A";
$Letras['b']="B";
$Letras['c']="C";
$Letras['d']="D";
$Letras['e']="E";
$Letras['f']="F";
$Letras['g']="G";
$Letras['h']="H";
$Letras['i']="I";
$Letras['j']="J";
$Letras['k']="K";
$Letras['l']="L";
$Letras['m']="M";
$Letras['n']="N";
$Letras['o']="O";
$Letras['p']="P";
$Letras['q']="Q";
$Letras['r']="R";
$Letras['s']="S";
$Letras['t']="T";
$Letras['u']="U";
$Letras['v']="V";
$Letras['w']="W";
$Letras['x']="X";
$Letras['y']="Y";
$Letras['z']="Z";

function ConvMay($cadena)
{
    global $convertida,$Letras;
    
    for($i=0;$i<strlen($cadena);$i++)
    {
            if (array_key_exists($cadena[$i],$Letras) )   //Si esta como clave en el array es que en un minúscula
            {
                $convertida.=$Letras[$cadena[$i]];   //Accedemos al valor de esa posición y concatenamos su valor
            }
            else //Si no es min la dejamos como está
            {
                $convertida.=$cadena[$i];
            }
        
    }
   
}

function ConvMin($cadena)
{
    global $convertida,$Letras;
    
    for($i=0;$i<strlen($cadena);$i++)
    {
         $clave=array_search($cadena[$i],$Letras);
        
         if (  $clave===FALSE )   //Si no es MAY la dejamos como está
         {
            $convertida.=$cadena[$i];       
         }
        else 
        {
            $convertida.=$clave     ;   //Accedemos al valor de esa posición y concatenamos su valor
        }
        
    }
    
    
    
}

if (isset($_GET['Convertir']) )
{
    $cadena=$_GET['Cadena'];
    
    $ope=$_GET['Operacion'];  //Recogemos la operación
 
    if ($ope==1)
    {
       ConvMay($cadena);   //Convertimos toda la candena a May
    }
    if ($ope==2)
    {
        ConvMin($cadena);   //Convertimos toda la candena a May
    }
    
}



?>

 <fieldset> 
   <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    
    Cadena <input type="text" name="Cadena"  value='<?php echo $cadena; ?>'> 
    <?php 
     
        $opciones=array(1=>"Mayusculas",2=>"Minusculas"); 

        foreach ($opciones as $clave=>$valor)
        {
         echo "$valor<input type='radio' name='Operacion' value='$clave' ";

         if($clave==$ope)
         {
          echo " checked ";
         }
         echo " >";    
        }
   
    ?>
    
    <input type="submit" name="Convertir" value="Convertir la cadena">

    Cadena Convertida<input type="text" name="CadConvertida" value='<?php echo $convertida; ?>'>

  </form>

 </fieldset>  
</body> 
  
</html>