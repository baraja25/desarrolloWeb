<html>

<body>

<?php 

$host="localhost";

$user="root";

$pass="";

$base="Prueba";

$db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexio


function ExisteNota($alu,$mod)
{
    global $db;
    
    $consulta="SELECT count(*) as cuenta
               FROM Notas
               where IdAlum='$alu' and IdMod=$mod";
    
    
    $resul=mysqli_query($db, $consulta);
    
    if ($resul)
    {
        $fila=mysqli_fetch_assoc($resul); //Extraemos una fila(lá unica posible) del resultado
        
        
    }
    else
    {
        echo mysqli_error($db);
    }
    
    return $fila['cuenta'];  //Devolvemos como valor de retorno la cuenta de esa fila
}


function InsertarNota($alu,$mod,$nota)  
{
    global $db;
    
    $consulta="insert into Notas values('$alu',$mod,$nota) ";
    
    $resul=mysqli_query($db, $consulta);
    
    if ($resul)
    {
        Echo "Nota insertada correctamente";
        
    }
    else
    {
        echo mysqli_error($db);
    }
    
    
}


function ActualizarNota($alu,$mod,$nota)
{
    global $db;
    
    $consulta="update Notas set Nota=$nota  where IdAlum='$alu' and IdMod=$mod ";
    
    $resul=mysqli_query($db, $consulta);
    
    if ($resul)
    {
        Echo "Nota actualizada correctamente";
        
    }
    else
    {
        echo mysqli_error($db);
    }
    
    
}

function ObtenerAlumnos()
{
    global $db;
    
    $alumnos=array();   //Array con las filas de alumnos
    
    $consulta="select * from Alumnos ";
    
    $resul=mysqli_query($db, $consulta);
    
    if ($resul)
    {
        $alumnos=mysqli_fetch_all($resul,MYSQLI_ASSOC); //Extraemos todas las filas en arrays asociativos 
        
    }
    else
    {
        echo mysqli_error($db);
    }
    
    return  $alumnos;
}


function ObtenerModulos()
{
    $modulos=array();   //Array con las lineas del archivo
    
    global $db;
    
    $consulta="select * from Modulos ";
    
    $resul=mysqli_query($db, $consulta);
    
    if ($resul)
    {
        $modulos=mysqli_fetch_all($resul, MYSQLI_ASSOC); //Extraemos todas las filas
        
    }
    else
    {
        echo mysqli_error($db);
    }
    
    return  $modulos;
}



//Comprobamos los datos recibidos tras la recarga


$alu="";

if (isset($_POST['Alumno']) )   //Si tras la recarga recibimos un módulo
{
    $alu=$_POST['Alumno'];
}


$mod="";

if (isset($_POST['Modulo']) )   //Si tras la recarga recibimos un módulo
{
    $mod=$_POST['Modulo'];
}

$nota="";

if (isset($_POST['Nota']) )   //Si tras la recarga recibimos un módulo
{
    $nota=$_POST['Nota'];
}



?>


 <fieldset><legend>Calificación de alumnos</legend> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        
        
         Alumnos<select name='Alumno'>
                 <option value=''></option>
         <?php 
         
         
         $alumnos=ObtenerAlumnos();  //Obtenemos los datos de los alumnos
         
         foreach ($alumnos as $clave=>$fila)
         {
             echo "<option value='$fila[NIF]'  ";
             
             if ($alu==$fila['NIF'])
             {
                 echo " selected ";
             }
             echo ">$fila[Apellido1] $fila[Apellido2], $fila[Nombre]</option>";
           
         }
         
         ?>
         
         </select>
        
         Modulo<select name='Modulo'>
                 <option value=''></option>
         
         <?php 
         
         //Recuperamos los datos los modulos
         
         $modulos=ObtenerModulos();  //Obtenemos los alumnos matriculados en ese modulo y curso
         
         foreach ($modulos as $clave=>$fila)
         {
            
             echo "<option value='$fila[Id]'  ";
             
             if ($mod==$fila['Id'])
             {
                 echo " selected ";
             }
             echo ">$fila[Nombre]</option>";
             
         }
           
         ?>
        
         </select>
                 
         Nota<select name='Nota'>
                 <option value=''></option>
         
         <?php 
         
         //Mostramos los valores permitidos de notas
         
         for($i=1;$i<=10;$i++)
         {
             echo "<option value='$i'  ";
             
             if ($nota==$i)
             {
                 echo " selected ";
             }
             echo ">$i</option>";
             
             
         }
         
         
           
        
         
         ?>
        
         </select>
         
         
         
       <input type='submit' name='Calificar' value='Calificar'>
    
    
     <?php 
     
     if (isset($_POST['Calificar']) )
     {
        
       if (!ExisteNota($alu,$mod) )  
       {
           InsertarNota($alu,$mod,$nota);  
       }
       else
       {
         ActualizarNota($alu,$mod,$nota);   
       }
         
         
         
         
     }
     
     
     
     
     
     
     mysqli_close($db);
     ?> 
    
    
    
    
    
      </fieldset>   
      
     
      
   </form>
    
 </body> 
</html> 
 