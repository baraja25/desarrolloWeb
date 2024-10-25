<html>

<body>


 <fieldset> 
  <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    Nombre<input type="text" name="Nombre">      
    Apellido1<input type="text" name="Apellido1"> 
    Apellido2<input type="text" name="Apellido2"> 
    
    Pais<select name="Pais">
          <option value=""></option>
          <option value='E'>España</option> 
          <option value='F'>Francia</option> 
          <option value='P'>Portugal</option> 
          <option value='A'>Alemania</option>      
    
    
        </select>
    

    <input type="submit" name="Enviar" value="Para Enviar Pulse">

    

  </form>

 </fieldset>   


 <?php

//Recepción de los datos del formulario

if (isset($_GET['Enviar'] )  )            //Hemos pulsado el botón de submit
{
 $nom=$_GET['Nombre'];

 $ape1=$_GET['Apellido1'];

 $ape2=$_GET['Apellido2'];

echo "Hola $nom $ape1 $ape2";

echo "<br>";

$pais=$_GET['Pais'];

echo "Tu pais es: ";

switch($pais)
{
    case "E":
        echo "España";
        break;
    case "F":
        echo "Francia";
        break;
    case "P":
        echo "Portugal";
        break;
    case "A":
        echo "Alemania";
}  



}

?>



 
</body>

</html>