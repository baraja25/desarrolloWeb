<html>

<body>

<?php

//Recepción de los datos del formulario

 
$num1="";
$num2="";
$resultado2="";
 
if (isset($_GET['Calcular'] )  )            //Hemos pulsado el botón de submit
{
  //Recogemos los datos del formulario  

  $num1=$_GET['Num1']; 
  
  $num2=$_GET['Num2'];  
  
  $ope=$_GET['Operacion'];  

  $resultado =$num1.$ope.$num2; 
  
  eval("\$resultado2=$resultado;");
  
   $resultado2;
  

}

?>
 <fieldset> 
  <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    Num1<input type="number" name="Num1" value='<?php echo $num1 ?>'> 
    
    Operación<select name="Operacion">
                 <option value=""></option>
                 <option value='+'>Sumar</option> 
                 <option value='-' >Restar</option> 
                 <option value='*'>Multiplicar</option> 
                 <option value='/'>Dividir</option>      
    
    
              </select>
    
         
    Num2<input type="number" name="Num2" value='<?php echo $num2 ?>'> 
    
    Resultado<input type="text" name="Resul" value='<?php echo $resultado2 ?>'>  

    <input type="submit" name="Calcular" value="Calcular Operacion">

    

  </form>

 </fieldset>   


 



 
</body>

</html>