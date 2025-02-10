
<html>
 </body> 

<?php

function  MostrarForm($nif) 
{
   global $pdo; 
    
   //Recuperamos los datos el alumno
   
   $consulta="select * from Alumnos where NIF=:NIF";  
    
   $param=array();
   
   $param[":NIF"]=$nif;
   
   $sta=$pdo->prepare($consulta);
   
   $sta->execute($param);
   
   $fila=$sta->fetch(PDO::FETCH_ASSOC);  //Extraemos la fila con los datos de ese alumno
    
   echo "<fieldset>";
   
   echo "<form name='f1' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'  >";
   
   foreach($fila as $clave=>$valor)
   {
       if ($clave=="FechaNac")
       {
           $campos=getdate($valor);
           
           $valor=$campos['mday']."/".$campos['mon']."/".$campos['year'];
           
           echo "$clave<input type='text' name='$clave' value='$valor'>";
           echo "<br>";
       }
       elseif ($clave=="Foto")
       {
           $imagenConte=$fila['Foto'];   //Extraemos el contenido de la imagen
           
           echo "<img src='data:image/jpg;base64,$imagenConte'   width='80' height='80'>";
           echo "<input type='file' name='$clave'>";    
           echo "<br>";
       }
       else
       {
           echo "$clave<input type='text' name='$clave' value='$valor' ";

           if ($clave=='NIF')
           {
             echo " readonly='readonly'";   
           }
           
           echo ">";
           echo "<br>";
       } 
    
   }
       
   echo "<input type='submit' name='Modificar' value='Modificar'>";
   
   
   echo "</form>";  
   
   echo "<br>";
   
   echo "<a href='CRUDAlumnos.php'>Volver</Volver>";
   
   echo "</fieldset>";
   
}



//Incluimos el código necesario para conectar

$host="localhost";

$user="root";

$pass="";

$base="Tema3";

try
{
    $pdo=new PDO("mysql:host=$host;dbname=$base",$user,$pass);
    
    //Para que genere excepciones a la hora de reportar errores.
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e)
{
    echo $e->getMessage();
}



$nif="";   //Comprobamos si recibimos un NIF

if (isset($_POST['NIF']) )
{
    $nif=$_POST['NIF'];
}

if (isset($_POST['Alta']) )   //Para dar de alta un nuevo alumno
{
    //Recogemos del formulario de edición los datos del alumno
    
    $nombre=$_POST['Nombre'];
    $Apellido1=$_POST['Apellido1'];
    $Apellido2=$_POST['Apellido2'];
    $Telefono=$_POST['Telefono'];
    $Premios=$_POST['Premios'];
    $FechaNac=$_POST['FechaNac'];
   
    $param=array();
    
    //Incluimos los valores dentro del array de parámetros de sustitución
    
    $param[':NIF']=$nif;
    $param[':Nombre']=$nombre;
    $param[':Apellido1']=$Apellido1;
    $param[':Apellido2']=$Apellido2;
    $param[':Telefono']=$Telefono;
    $param[':Premios']=$Premios;
    
    //La fecha hay que convertirla a Epoch
    
    $campos=explode("/",$FechaNac);
    
    $fecha=mktime(0,0,0,$campos[1],$campos[0],$campos[2]);
    
    $param[':FechaNac']=$fecha;
    
    //Comprobamos si hemos introducido una imagen a modificar
    
    $conteFoto="";
    
    if ($_FILES['Foto']['name']!="" )
    {
        $nombreTemp=$_FILES['Foto']['tmp_name'];
        
        $conteFoto=file_get_contents($nombreTemp);
        
        $conteFoto=base64_encode($conteFoto);
        
        $param[':Foto']=$conteFoto;   // Y su valor al array de parámetros de sustitución
        
    }
    
    $consulta="insert into Alumnos values(:NIF,:Nombre,:Apellido1,:Apellido2,:Telefono,:Premios,:FechaNac,:Foto)";
    
    $sta=$pdo->prepare($consulta);
    
    $sta->execute($param);   //Ejecutamos la consulta de actualización
    
    MostrarForm($nif);   //Que muestre el formulario con los datos nuevos que hemos insertado
   
}


if (isset($_POST['Modificar']) )   //Si queremos modificar los datos del formulario
{
   //Recogemos del formulario de edición los datos del alumno
    
   $nombre=$_POST['Nombre'];
   $Apellido1=$_POST['Apellido1'];
   $Apellido2=$_POST['Apellido2'];
   $Telefono=$_POST['Telefono'];
   $Premios=$_POST['Premios'];
   $FechaNac=$_POST['FechaNac'];
   
   $consulta=" Update Alumnos set Nombre=:Nombre,
                                  Apellido1=:Apellido1,
                                  Apellido2=:Apellido2,
                                  Telefono=:Telefono,
                                  Premios=:Premios,
                                  FechaNac=:FechaNac "; 
    
   $param=array();
  
   //Incluimos los valores dentro del array de parámetros de sustitución
   
   $param[':NIF']=$nif;
   $param[':Nombre']=$nombre;
   $param[':Apellido1']=$Apellido1;
   $param[':Apellido2']=$Apellido2;
   $param[':Telefono']=$Telefono;
   $param[':Premios']=$Premios;
   
   //La fecha hay que convertirla a Epoch
   
   $campos=explode("/",$FechaNac);
   
   $fecha=mktime(0,0,0,$campos[1],$campos[0],$campos[2]);
   
   $param[':FechaNac']=$fecha;
  
   //Comprobamos si hemos introducido una imagen a modificar 
   
   if ($_FILES['Foto']['name']!="" )
   {
       $nombreTemp=$_FILES['Foto']['tmp_name'];
       
       $conteFoto=file_get_contents($nombreTemp);
       
       $conteFoto=base64_encode($conteFoto);
       
       $consulta.=",Foto=:Foto ";   //Añadimos el campo foto a la consulta de actualización
       
       $param[':Foto']=$conteFoto;   // Y su valor al array de parámetros de sustitución
       
   }
   
   
   $consulta.=" Where NIF=:NIF ";
   
   $sta=$pdo->prepare($consulta);
   
   $sta->execute($param);   //Ejecutamos la consulta de actualización
   
   MostrarForm($nif);   //Que muestre el formulario con los datos actualizados  
}
    
//Página que ejecuta las acciones del CRUD

if (isset($_POST['Borrar']) )   //Si la acción solicitada era borrar
{   
  $consulta="Delete from Alumnos where NIF=:NIF ";  
  
  $param=array();
    
  $param[":NIF"]=$nif;  

  $sta=$pdo->prepare($consulta);

  $sta->execute($param);

}

if (isset($_POST['Actualizar']) )   //Si la acción solicitada era borrar
{   
   MostrarForm($nif);   //Mostramos un formulario de edición con los datos de ese NIF
    
}



$pdo=null;  //Cerramos la conexión



?>



 </body> 
</html>


