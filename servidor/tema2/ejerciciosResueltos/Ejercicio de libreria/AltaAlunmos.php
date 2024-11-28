<html>
<?php 

require_once 'libreria.php';

?>

<body>

 <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'> 
     <fieldset><legend>Datos de Alumnos</legend>
            
            <label for='NIF'>NIF </label><input type='text' name='NIF' ><br>
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre' ><br>
            <label for='Apellido1'>Apellido1 </label><input type='text' name='Apellido1'  ><br>
            <label for='Apellido2'>Apellido2 </label><input type='text' name='Apellido2'  ><br>
            <label for='Telefono'>Telefono </label><input type='text' name='Telefono'  ><br>
            <label for='Premios'>Premios </label><input type='text' name='Premios'  ><br>
            
            <input type='submit' name='Guardar' value='Guardar'>
            
           </fieldset> 
     </form>  
  </body>   
  
<?php 

if (isset($_POST['Guardar']) )
{
    $nif = $_POST['NIF'];
    $nombre = $_POST['Nombre'];
    $apellido1 = $_POST['Apellido1'];
    $apellido2 = $_POST['Apellido2'];
    $telefono = $_POST['Telefono'];
    $premios = $_POST['Premios'];
    
    $consulta="select count(*) as cuenta from Alumnos where NIF='$nif' ";
    
    $filas=ConsultaDatos($consulta);
    
    $fila=$filas[0];  //Recogemos la fila que devuelve, solo puede devolver una la fila 0
    
    if ($fila['cuenta']==0)
    {
    
        $consulta="insert into Alumnos values('$nif','$nombre','$apellido1','$apellido2','$telefono',$premios)";
        
        $resul=ConsultaSimple($consulta);
        
    }
    else 
    {
       echo "<b>ERROR, ya hay un alumno para ese NIF</b>"; 
    }
        
    
}







?>  
  
  
  
  
        
</html>           
           