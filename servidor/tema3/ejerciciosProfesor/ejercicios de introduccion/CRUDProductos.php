<html>

<?php

date_default_timezone_set('UTC'); // Aseguramos que use UTC

require_once 'LibreriaPDO.php';

$db= new DB("Tema3");

$Id='';

if (isset($_POST['Id']) )
{
    $Id=$_POST['Id'];
}


if (isset($_POST['Insertar']) )   //Para dar de alta un nuevo alumno
{
    //Recogemos del formulario de edición los datos del alumno
    
    $nif=$_POST['NIF'];
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
    
    
}






if ( isset($_POST['Borrar']) && (isset($_POST['Selec']))   )   //Si la acción solicitada era acutalizar y hemos marcado algún checkbox
{
    
    $selec=$_POST['Selec']; //Recogemos los checkbox marcados
  
    foreach ($selec as $clave=>$valor)
    {
        $consulta="Delete from Alumnos where NIF=:NIF ";
        
        $param=array();
        
        $param[":NIF"]=$clave;
        
        $sta=$pdo->prepare($consulta);
        
        $sta->execute($param);
         
    }
  
}

if ( isset($_POST['Actualizar']) && (isset($_POST['Selec']))   )   //Si la acción solicitada era acutalizar y hemos marcado algún checkbox
{
    $selec=$_POST['Selec']; //Recogemos los checkbox marcados
    
    //Recogemos los arrays con los datos de los alumnos
    
    $nombres=$_POST['Nombres'];
    $Apellido1s=$_POST['Apellido1s'];
    $Apellido2s=$_POST['Apellido2s'];
    $Telefonos=$_POST['Telefonos'];
    $Premioss=$_POST['Premioss'];
    $FechaNacs=$_POST['FechaNacs'];
    
    
    foreach ($selec as $clave=>$valor)
    {
        $nombre=$nombres[$clave];
        $Apellido1=$Apellido1s[$clave];
        $Apellido2=$Apellido2s[$clave];
        $Telefono=$Telefonos[$clave];
        $Premios=$Premioss[$clave];
        $FechaNac=$FechaNacs[$clave];
        
        $consulta=" Update Alumnos set Nombre=:Nombre,
                                  Apellido1=:Apellido1,
                                  Apellido2=:Apellido2,
                                  Telefono=:Telefono,
                                  Premios=:Premios,
                                  FechaNac=:FechaNac ";
        
        $param=array();
        
        //Incluimos los valores dentro del array de parámetros de sustitución
        
        $param[':NIF']=$clave;
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
        
        if ($_FILES['Fotos']['name'][$clave]!="" )
        {
            $nombreTemp=$_FILES['Fotos']['tmp_name'][$clave];
            
            $conteFoto=file_get_contents($nombreTemp);
            
            $conteFoto=base64_encode($conteFoto);
            
            $consulta.=",Foto=:Foto ";   //Añadimos el campo foto a la consulta de actualización
            
            $param[':Foto']=$conteFoto;   // Y su valor al array de parámetros de sustitución
            
        }
        
        
        $consulta.=" Where NIF=:NIF ";
        
        $sta=$pdo->prepare($consulta);
        
        $sta->execute($param);   //Ejecutamos la consulta de actualización
        
        
    }
    
    
}

//Obtenemos los datos de los alumnos

$consulta="select * from Productos  ";

$db->ConsultaDatos($consulta);

$productos=array();  //Declaramos un array para guardar las filas con los productos

$productos=$db->filas;


?>

 <body>
     
        <?php 
        
          
        echo "<fieldset>";
        
        echo "<form name='f1' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'  >";
        
        echo "<input type='submit' name='Actualizar' value='Actualizar'>";
        echo "<input type='submit' name='Borrar' value='Borrar'>";
        echo "<input type='submit' name='Insertar' value='Insertar'>";
        
        echo "<table border='2'>";
        echo "<thead>";
        echo "<tr>";
  
        echo "<th>Selec</th>";
        echo "<th>Id</th><th>Nombre</th><th>Precio</th><th>Marca</th><th>Modelo</th><th>Fotos</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
  
        echo "<tr>";
        echo "<td><b>+</b></td>";
        echo "<td><input type='text' name='Id' size='10'></td>";
        echo "<td><input type='text' name='Nombre' size='10'></td>";
        echo "<td><input type='text' name='Precio' size='10'></td>";
        echo "<td><input type='text' name='Marca' size='10'></td>";
        echo "<td><input type='text' name='Modelo' size='10'></td>";
        echo "<td></td>";
        
        
        echo "</tr>";
        
        foreach ($productos as $fila) 
        {
            echo "<tr>";
            
            echo "<td><input type='checkbox' name='Selec[".$fila['Id']."]'></td>";
            
            foreach($fila as $clave=>$valor) 
            { 
              
              if ($clave=="Id")
              {
                echo "<td><input type='text' name='".$clave.'s['.$fila['Id'].']'."' value='$valor' size='10' readonly='readonly'></td>";
              }
              else 
              {
                echo "<td><input type='text' name='".$clave.'s['.$fila['Id'].']'."' value='$valor' size='10'></td> ";
              }

            }    
                       
            //Mostramos las fotos de ese producto
            
            $consulta="SELECT IdFoto,Foto  FROM FotosProB Where IdPro=:IdPro ";
            
            $param=array(":IdPro"=>$fila['Id']);
            
            $db->ConsultaDatos($consulta,$param);
            
             echo "<td>";
            
             foreach ($db->filas as $fila)
             {
                 $imagenConte=$fila['Foto'];   //Extraemos el contenido de la imagen
                  
                 echo "<img src='data:image/jpg;base64,$imagenConte'   width='80' height='80'>";
              
                 echo "<input type='file' name='Fotos[$fila[IdFoto]]'>";
             }
             
             echo "</td>";
            
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";

        echo "</form>";  

        echo "</fieldset>"; 
            
        ?>
            
 </body>
</html>

