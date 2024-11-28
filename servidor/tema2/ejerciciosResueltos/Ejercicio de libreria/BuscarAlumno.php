<!DOCTYPE html>
<html>

<body>
            
  <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>          
            
     <fieldset><legend>Busqueda del alumno</legend>     
           
    <label for='Nombre'>Nombre </label><input type='text' name='Nombre'  >
    <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1' ><br>
    <label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2'  ><br>
    <label for='Telefono'>Telefono </label><input type='text' name='Telefono'  ><br>
    <label for='Premios'>Premios </label><input type='text' name='Premios'  ><br>
                 
            <input type='submit' name='Buscar' value='Buscar'>
        
           </fieldset>
<?php 

function ActualizarOrden($consulta,$campo)
{
   $pos=strpos($consulta,"ORDER"); 
    
   if ($pos!==false)   //La consulta no tenia la clausula order by
   {
       //Tenemos que coger la parte de la consulta que precede al order by
       
       $consulta=substr($consulta,0,$pos-1);
   }
     
   $consulta.=" ORDER BY $campo";
       
   
  return $consulta;     
   
}


$consulta="";  //Inicializamos la variable consulta

$campo="NIF"; //El campo de ordenación lo poenemos por defecto al NIF 

if (  isset($_POST['Buscar'])  )       //Estamos accediendo tras pulsar el botón buscar
{
   
    $consulta="select * from Alumnos where 1 ";
    
     //Recogemos los datos del formulario 
    
    if ( isset($_POST['Buscar'] ) )
    {
            $nombre = $_POST['Nombre'];
            $apellido1 = $_POST['Apellido1'];
            $apellido2 = $_POST['Apellido2'];
            $telefono = $_POST['Telefono'];
            $premios= $_POST['Premios'];
            
         
            if ($nombre!='')
            {
                $consulta.=" And Nombre='$nombre'";
            }
            if ($apellido1!='')
            {
                $consulta.=" AND  Apellido1='$apellido1'";
            }
            if ($apellido2!='')
            {
                $consulta.=" AND  Apellido2='$apellido2'";
            }
            if ($telefono!='')
            {
                $consulta.=" AND  Telefono='$telefono'";
            }
            if ($premios!='')   
            {
                $consulta.=" AND  Premios=$premios";
            }
            
    }
    
    
}

if (isset($_GET['Campo'] ) )  //Estamos accediendo a la página desde el enlace
{
 
    $campo=$_GET['Campo'];         //Recogemos el campo de ordenación
    
    $consulta=$_GET['Consulta'];  //Recogemos la consulta anterior
    
}
    

if ($consulta!="")         //Si hay consulta a ejecutar
{
    
    
    
    $consulta=ActualizarOrden($consulta,$campo);    //Actualizamos el campo de orden de la consulta
    
    
    
    
    //Mandamos la consulta al servidor
    
    mysqli_report(MYSQLI_REPORT_OFF);   //Para desabilitar las excepciones en versiones posteriores a 8.1
    
    $db = mysqli_connect("localhost", "root", "", "Tema2");
    
    
    if (!$db)
    {
        echo("Error de conexión: ".mysqli_connect_error()."<br>");
        echo("Error numero: ".mysqli_connect_errno()."<br>");
        
        exit();
    }
    else //Si me he conectado correctamente
    {
        $resul=mysqli_query($db, $consulta);
        
        //
       
        echo "Consulta para el enlace<br>";
       
        echo $consulta."<br>";
        
        echo "<table border='2'>";
        echo "<th><a href=".$_SERVER['PHP_SELF']."?Campo=NIF&Consulta=".urlencode($consulta).">NIF</a></th>";
        echo "<th><a href=".$_SERVER['PHP_SELF']."?Campo=Nombre&Consulta=".urlencode($consulta).">Nombre</a></th>";
        echo "<th><a href=".$_SERVER['PHP_SELF']."?Campo=Apellido1&Consulta=".urlencode($consulta).">Apellido1</a></th>";
        echo "<th><a href=".$_SERVER['PHP_SELF']."?Campo=Apellido2&Consulta=".urlencode($consulta).">Apellido2</a></th>";
        echo "<th><a href=".$_SERVER['PHP_SELF']."?Campo=Telefono&Consulta=".urlencode($consulta).">Telefono</a></th>";
        echo "<th><a href=".$_SERVER['PHP_SELF']."?Campo=Premios&Consulta=".urlencode($consulta).">Premios</a></th>";
        
        while ( ($fila=mysqli_fetch_assoc($resul))!=null  ) 
        {
            echo "<tr>";
           
            echo "<td>$fila[NIF]</td>";
            echo "<td>$fila[Nombre]</td>";
            echo "<td>$fila[Apellido1]</td>";
            echo "<td>$fila[Apellido2]</td>";
            echo "<td>$fila[Telefono]</td>";
            echo "<td>$fila[Premios]</td>";
            
  
            echo "</tr>";
        }
        
        echo "</table>";
    }
    
    mysqli_close($db);
    
}
       


?>


  </form>

</body>













</html>
