<html>

<body>


 <fieldset> 
  <form name="f1" method="get" action="Form1.php">
    Nombre<input type="text" name="Nombre">      
    Apellido1<input type="text" name="Apellido1"> 
    Apellido2<input type="text" name="Apellido2"> 

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

}

?>



 
</body>

</html>