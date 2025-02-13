
<html>
 <body>

 <?php 
 
 require_once 'libreria2.php';
 
 function ObtenerMarcas()
 {
    $consulta="select * from Marcas "; 
     
    $filas=ConsultaDatos($consulta);
    
    return $filas; 
     
 }
 
 
 $nombre='';
 
 if (isset($_POST['Nombre']) )
 {
     $nombre=$_POST['Nombre'];
 }
 
 
 
 $marca='';
 
 if (isset($_POST['Marcas']) )
 {
     $marca=$_POST['Marcas'];
 }
 
 if (isset($_POST['Guardar']) ) 
 {
     
     $modelo=$_POST['Modelo'];
     $precio=$_POST['Precio'];
     
     $ConteFoto=""; //Inicializamos a vacio el nombre de la foto de portada del ese coche
     
     if ( $_FILES['Foto']['name']!="" )    //si hemos seleccionado un archivo
     {
         // $nombreFoto=$_FILES['Foto']['name']; 
         
         $nombreTemp=$_FILES['Foto']['tmp_name'];
         
         $ConteFoto=file_get_contents($nombreTemp);
         
         $ConteFoto=base64_encode($ConteFoto);
         
     }
         
     $consulta="Insert into Coches values(NULL,'$nombre',$marca,'$modelo',$precio,'$ConteFoto')";
     
     //echo $consulta;
     
     ConsultaSimple($consulta);  //Ejecutamos la consulta de insercción
     
 }
 

 ?>

 
 <fieldset> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>" enctype="multipart/form-data">
        
        Nombre<input type="text" name="Nombre" value='<?php echo $nombre; ?>'><br>      
        
        Marca<select name='Marcas' onChange='f1.submit();'>
              <option value=''></option>
              
              <?php 
              
              $filas=ObtenerMarcas();
              
              $imagenConte="";
              
              foreach ($filas as $clave=>$fila)
              {
                 echo "<option value='$fila[Id]' "; 
                  
                 if ($marca==$fila['Id'])   //Si el Id de esa imagen coincide con el seleccionado previamente
                 {
                   echo " selected ";    //Marcamos esa imagen como seleccionada
                   
                   $imagenConte=$fila['Imagen']; //Guardamos en una variable el nombre de esa imagen
                 }
              
                 echo ">$fila[Nombre]</option>"; 
              }
                   
              echo "</select>";
              
              echo "<img src='data:image/jpg;base64,$imagenConte'   width='80' height='80'>";
              
              ?>
             
            
            
            
            
            
            
            <br>
        
        Modelo<input type="text" name="Modelo"><br>   
    
        Precio<input type="number" name="Precio"><br> 
       
        Foto<input type='file' name='Foto'><br>
       
        <input type="submit" name="Guardar" value="Guardar">
      
      </form>

  </fieldset>  
 </body> 
</html> 
