
<html>
 <body>

 <?php 
 
 
  function DatosAlumno($nif)    //Función que recibe un NIF y devuelve un array con los datos de ese alumno
  {
      global $db;
      
      $alumno=array();  //Array para devolver los datos de un alumno
      
      $consulta="select * from Alumnos where NIF='$nif'";
      
      $resul=mysqli_query($db, $consulta);
      
      if ($resul==FALSE)
      {
          Echo "Error en la consulta:".mysqli_error($db);
          
      }
      else
      {
          $alumno=mysqli_fetch_assoc($resul);  //Extraemos una fila(la única que devolveria)
      }
      
      return $alumno; 
      
  }
  
  
  function AntAlum($nif)    //Función para obtener el siguiente alumno al actual
  {
      global $db;
      
      $alumno=array();  //Array para devolver los datos de un alumno
      
      $consulta="SELECT * FROM Alumnos where NIF<'$nif' Order by NIF desc  limit 1;";
      
      $resul=mysqli_query($db, $consulta);
      
      if ($resul==FALSE)
      {
          Echo "Error en la consulta:".mysqli_error($db);
          
      }
      else
      {
          $alumno=mysqli_fetch_assoc($resul);  //Extraemos una fila(la única que devolveria)
      }
      
      if (empty($alumno))   //Si no había un alumno siguiente
      {
          $alumno=DatosAlumno($nif); //Devolvemos los datos del actual
      }
      
      return $alumno;
      
  }
  
  
  function SigAlum($nif)    //Función para obtener el siguiente alumno al actual
  {
      global $db;
      
      $alumno=array();  //Array para devolver los datos de un alumno
      
      $consulta="SELECT * FROM Alumnos where NIF>'$nif' limit 1;";
      
      $resul=mysqli_query($db, $consulta);
      
      if ($resul==FALSE)
      {
          Echo "Error en la consulta:".mysqli_error($db);
          
      }
      else
      {
          $alumno=mysqli_fetch_assoc($resul);  //Extraemos una fila(la única que devolveria)
      }
      
      if (empty($alumno))   //Si no había un alumno siguiente
      {
          $alumno=DatosAlumno($nif); //Devolvemos los datos del actual
      }
      
      return $alumno;
      
  }
  
  
  
  
  
  
  function UltimoAlum()    //Función para obtener el primer alumno de la tabla
  {
      global $db;
      
      $alumno=array();  //Array para devolver los datos de un alumno
      
      $consulta="select * from Alumnos order by NIF desc limit 1";
      
      $resul=mysqli_query($db, $consulta);
      
      if ($resul==FALSE)
      {
          Echo "Error en la consulta:".mysqli_error($db);
          
      }
      else
      {
          $alumno=mysqli_fetch_assoc($resul);  //Extraemos una fila(la única que devolveria)
      }
      
      return $alumno;
      
  }
 
  function PrimerAlum()    //Función para obtener el primer alumno de la tabla
  {
     global $db;
     
     $alumno=array();  //Array para devolver los datos de un alumno
     
     $consulta="select * from Alumnos limit 1";
     
     $resul=mysqli_query($db, $consulta);
     
     if ($resul==FALSE)
     {
         Echo "Error en la consulta:".mysqli_error($db);
         
     }
     else 
     {
            $alumno=mysqli_fetch_assoc($resul);  //Extraemos una fila(la única que devolveria)  
     }
      
    return $alumno; 
     
  }
     
  $host="localhost";
  
  $user="root";
  
  $pass="";
  
  $base="Prueba";
  
  $db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexion
  
  if (isset($_POST['Actualizar']) )
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
  
  if (isset($_POST['Borrar']) )
  {
      $nif=$_POST['NIF'];
     
      $consulta="delete from Alumnos where NIF='$nif' ";
      
      $resul=mysqli_query($db, $consulta);
      
      if ($resul)
      {
          echo "Registro borrado correctamente";
      }
      else
      {
          echo mysqli_error($db);
      }
      
  }
  
  
  
  if (isset($_GET['NIF']) )    //Si recibimos un NIF de alumno a mostrar       
  {
     $nif=$_GET['NIF'];
     
     $alumno=DatosAlumno($nif);  // Obtenemos todos sus datos
     
  }
  else  //En caso contrario hallamos el primer alumno
  {
 
     $alumno=PrimerAlum();
     
     $nif=$alumno['NIF'];
  }
         
  
  
  
  
  
 ?>

 
 <fieldset> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        
        NIF<input type="text" name="NIF"  value="<?php echo $alumno['NIF']; ?>" readonly='readonly' ><br>  
         Nombre<input type="text" name="Nombre" value="<?php echo $alumno['Nombre']; ?>"><br>          
        Apellido1<input type="text" name="Apellido1" value="<?php echo $alumno['Apellido1']; ?>"><br> 
        Apellido2<input type="text" name="Apellido2" value="<?php echo $alumno['Apellido2']; ?>"><br>   
    
        Telefono<input type="text" name="Telefono" value="<?php echo $alumno['Telefono']; ?>"><br> 
       
        <input type='submit' name='Actualizar' value='Actualizar'>  
        <input type='submit' name='Borrar' value='Borrar'>    <br> 
       
        <?php 
        
        //Tenemos que determinar los NIF del primer, último anterior y siguiente alumno
        
        $alumno=PrimerAlum();   //Obtenemos el primer alumno
        
        $primer=$alumno['NIF'];
        
        $alumno=UltimoAlum();   //Obtenemos el ultimo alumno
        
        $ultimo=$alumno['NIF']; 
        
        $alumno=SigAlum($nif);  //Obtenemos el siguiente alumno al nif actual
        
        $sig=$alumno['NIF'];
        
        $alumno=AntAlum($nif);  //Obtenemos el anterior alumno al nif actual
        
        $ant=$alumno['NIF'];
        
     
        echo "<a href='$_SERVER[PHP_SELF]?NIF=$primer'> << </a>&nbsp";
        echo "<a href='$_SERVER[PHP_SELF]?NIF=$ant'> < </a>&nbsp";
        echo "<a href='$_SERVER[PHP_SELF]?NIF=$sig'> > </a>&nbsp";
        echo "<a href='$_SERVER[PHP_SELF]?NIF=$ultimo'> >> </a>";
          
        
        
        mysqli_close($db);
        
        ?>
      
      </form>

  </fieldset>  
 </body> 
</html> 
