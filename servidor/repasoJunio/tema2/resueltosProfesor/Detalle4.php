<html>
<?php 

require_once 'libreria.php';


function FormDetalle($id)
{
    $consulta="select * from coche where id=$id";  //Obtenemos todos los datos de ese coche
    
    $filas=ConsultaDatos($consulta);
    
    if (count($filas)==1)   //Si me devuelve una sola fila
    {
        $fila=$filas[0];   //La recuperamos
    }
    
    echo "<fieldset>";
    
    echo "<form name='f1' method='post' action=''>";
    
    echo "Id<input type='text' name='id' value='$fila[id]'><br>";
    echo "Nombre<input type='text' name='nombre' value='$fila[nombre]'><br>";
    echo "Marca<input type='text' name='marca' value='$fila[marca]'><br>";
    echo "Modelo<input type='text' name='modelo' value='$fila[modelo]'><br>";
    echo "Matricula<input type='text' name='matricula' value='$fila[matricula]'><br>";
    echo "Año<input type='text' name='anio' value='$fila[anio]'><br>";
    echo "<img src='data:image/jpg;base64,$fila[foto]'  width='80' height='80'>";
                              
    echo "</form>";
    
    echo "</fieldset>";
}


$Ids=array();  //Array con los Id de los coches seleccionados

if (isset($_POST['Selec'] ) )  //Si recibimos Id seleccionados de la página anterior
{
    $Ids=$_POST['Selec'];   //Guardamos los Id en un array

    foreach ($Ids as $clave=>$valor)
    {
        FormDetalle($clave); //Mostramos un formulario de detalla para cada Id 
    }
    
    
    
}


?> 
  
 <body>
 
    
 
    
 
 </body>
 


</html>
