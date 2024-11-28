<html>

<?php 

$host="localhost";

$user="root";

$pass="";

$base="Prueba";

$db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexio

if (isset($_POST['Actualizar']) )  //si le hemos dado a actualizar alumno
{
    $nif=$_POST['NIF'];
    $nombre=$_POST['Nombre'];
    $apellido1=$_POST['Apellido1'];
    $apellido2=$_POST['Apellido2'];
    $telefono=$_POST['Telefono'];
    
    $consulta="update Alumnos set Nombre='$nombre',
                                  Apellido1='$apellido1',
                                  Apellido2='$apellido2',
                                  Telefono='$telefono'
                              where NIF='$nif' ";
    
    
    $resul=mysqli_query($db, $consulta);
    
    if ($resul)
    {
        echo "Registro actualizado correctamente";
    }
    else
    {
        echo mysqli_error($db);
    }
    
}

//Obtenemos los alumos para el desplegable


$alumnos=array();

$consulta="select * from Alumnos";

$resul=mysqli_query($db, $consulta);

if ($resul)  //Si ha resultado
{
   while($alumno=mysqli_fetch_assoc($resul) ) 
   {
       $alumnos[$alumno['NIF']]=$alumno;    
   }
    
}
else 
{
  echo "Error:".mysqli_error($db);  
}

$alu="";  //Inicilizamos la variable alu para el NIF del alumno seleccionado

if (isset($_POST['Alumno']) )  //Comprobamos si hay un alumnos previamente seleccionado
{
    $alu=$_POST['Alumno'];
}




mysqli_close($db);  

?>

 <body>

 <fieldset><legend>Seleccione alumno</legend> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
       
       Alumno<select name='Alumno'>
                <option value=''></option>
       
                <?php 
                
                foreach ($alumnos as $alumno)
                {
                   echo "<option value='$alumno[NIF]' "; 
                    
                   if ($alu==$alumno['NIF'])
                   {
                     echo " selected ";  
                   }
                       
                   echo ">$alumno[Apellido1],$alumno[Nombre]</option>";
                   
                }
                
                ?>
       
              </select> 
       
       
        <input type="submit" name="Mostrar" value="Mostrar">
      
    </fieldset>  
      
        <?php 
        
        
        if (isset($_POST['Mostrar']) )  //Comprobamos si hay un alumnos previamente seleccionado
        {
           echo "<fieldset><legend>Datos del alumno</legend> ";
        
           echo "NIF<input type='text' name='NIF' value='$alu' readonly='readonly'><br>";
           
           $fila=$alumnos[$alu];
           
           echo "Nombre<input type='text' name='Nombre' value='$fila[Nombre]'><br>";
           echo "Apellido1<input type='text' name='Apellido1' value='$fila[Apellido1]'><br>";
           echo "Apellido2<input type='text' name='Apellido2' value='$fila[Apellido2]'><br>";
           
           echo "Telefono<input type='text' name='Telefono' value='$fila[Telefono]'><br>";
           
           echo "<input type='submit' name='Actualizar' value='Actualizar'>";
          
           echo "</fieldset>";
        }
        
     
        ?>
         
   </form>
 </body> 
</html> 