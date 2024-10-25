
<html>

<title>Ordenar Tres Numeros</title>
<body>




<form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

  
  
  <label for='Num1'>Numero 1</label><input type='number' name='Num1'>
  <label for='Num2'>Numero 2</label><input type='number' name='Num2'>
  <label for='Num3'>Numero 3</label><input type='number' name='Num3'>
   
  <select name='Orden'>
    <option value=''></option>
    <option value='1'>Ascendente</option>
    <option value='2'>Descendente</option>
    
  </select> 
     
 <input type='submit' name='Ordenar' value='Ordenar'>
   <br>
   
</form>

<?php 

if ( isset( $_GET['Ordenar'] )  )
{
    $primero='';
    $segundo='';
    $tercero='';
    
    $num1=$_GET['Num1'];
    $num2=$_GET['Num2'];
    $num3=$_GET['Num3'];
    
    $Orden=$_GET['Orden'];
    
    
    if (  ($num1>=$num2) && ($num1>=$num3  )  )
    {
        $primero=$num1;
        
        if ($num2>=$num3  )
        {
            $segundo=$num2;
            $tercero=$num3;
        }
        else
        {
            $segundo=$num3;
            $tercero=$num2;
            
        }
            
    }
    
    if (  ($num2>=$num1) && ($num2>=$num3  )  )
    {
        $primero=$num2;
        
        if ($num1>=$num3 )
        {
            $segundo=$num1;
            $tercero=$num3;
        }
        else
        {
            $segundo=$num3;
            $tercero=$num1;
            
        }
        
    }
    
    if (  ($num3>=$num1) && ($num3>=$num2  )  )
    {
        $primero=$num3;
        
        if ($num1>=$num2 )
        {
            $segundo=$num1;
            $tercero=$num2;
        }
        else
        {
            $segundo=$num2;
            $tercero=$num1;
            
        }
        
    }
    
    echo "<table border=2>";
    
    if ($Orden==1 )
    {
        echo "<tr><td>$tercero</td></tr>";
        echo "<tr><td>$segundo</td></tr>";
        echo "<tr><td>$primero</td></tr>";
           
    }
    if ($Orden==2 )
    {
        
        echo "<tr><td>$primero</td></tr>";
        echo "<tr><td>$segundo</td></tr>";
        echo "<tr><td>$tercero</td></tr>";
        
    }
    
    echo "</table>";
    
    
    
}





?>







</body>

</html>



