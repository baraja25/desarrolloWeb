
<html>
 <body>

 <?php 
 
 function DatosValidos($campos)
 {
       $Validos=TRUE;  //Variable lógica para indicar si los campos introducidos son válidos
       
    
        if (strlen($campos[0])!=9)
        {
              echo "<b>ERROR: El campo NIF debe tener 9 caracteres</b><br>"; 
               
              $Validos=$Validos && FALSE;
        }
      
        
        if ( (strlen($campos[1])>25) || (strlen($campos[1])==0)       )
        {
            echo "<b>ERROR: El campo Nombre no debe mas de 25 caracteres ni ser vacio</b><br>";
            
            $Validos=$Validos && FALSE;
        }
       
        if ( (strlen($campos[2])>25) ||  (strlen($campos[2])==0)     )
        {
            echo "<b>ERROR: El campo Apellido1 no debe mas de 25 caracteres ni ser vacio</b><br>";
            $Validos=$Validos && FALSE;
        }
        
        if ( (strlen($campos[3])>25) ||   (strlen($campos[3])==0)   )
        {
            echo "<b>ERROR: El campo Apellido2 no debe mas de 25 caracteres ni ser vacio</b><br>";
            $Validos=$Validos && FALSE;
        }
        
        if (strlen($campos[4])!=9)
        {
            echo "<b>ERROR: El campo teléfono debe tener 9 caracteres</b><br>";
            
            $Validos=$Validos && FALSE;
        } 
        
        
    return $Validos;    
    
 }
 
 
 if (isset($_POST['Guardar']) ) 
 {
     $campos=array();
     
     $campos[]=$_POST['NIF'];
     $campos[]=$_POST['Nombre'];
     $campos[]=$_POST['Apellido1'];
     $campos[]=$_POST['Apellido2'];
     $campos[]=$_POST['Telefono'];
     
     if (DatosValidos($campos) )      //Si los datos son válidos procedemos a la inserción
     {
         $host="localhost";
         
         $user="root";
         
         $pass="";
         
         $base="Prueba";
         
         $db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexion
         
         $consulta="insert into Alumnos values('$campos[0]','$campos[1]','$campos[2]','$campos[3]','$campos[4]')";
         
         $resul=mysqli_query($db, $consulta);
         
         if ($resul==FALSE)
         {
             Echo "Error en la consulta:".mysqli_error($db);
             
         }
         
         mysqli_close($db);
         

     }
     
     
     
 }
 
 
 
 
 ?>

 
 <fieldset> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        
        NIF<input type="text" name="NIF"><br>      
        Nombre<input type="text" name="Nombre"><br>      
        Apellido1<input type="text" name="Apellido1"><br> 
        Apellido2<input type="text" name="Apellido2"><br>   
    
        Telefono<input type="text" name="Telefono"><br> 
       
        <input type="submit" name="Guardar" value="Guardar">
      
      </form>

  </fieldset>  
 </body> 
</html> 
