<html> 

<?php 

require_once 'libreria.php';

if (isset($_POST['Guardar']) )
{
    $nombre=$_POST['Nombre'];
   
    //Procesamos el file
    
   
    
    if ( $_FILES['Imagen']['name']!=""  )   //Si hemos seleccionado un archivo
    {
        $nombreOrig=$_FILES['Imagen']['name']; //Recogemos su nombre originnal
        
        $nombreTemp=$_FILES['Imagen']['tmp_name']; //Recogemos el nombre temporal desde esa ubicación temporal
        
        copy($nombreTemp,"Imagenes/ $nombreOrig"); //Copiamos en archivo temporal desde su ubicación hasta la carpeta de imágenes con su nombre original
        
        $consulta="Insert into Marcas values(NULL,'$nombre','$nombreOrig')";
        
        ConsultaSimple($consulta);  
        
        
    }
}

?>

 <body>
  <fieldset> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>" enctype='multipart/form-data'  >
        
        
        Nombre<input type="text" name="Nombre"><br>      
     
        Imagen<input type='file' name="Imagen"><br>
        
            
    
        <input type="submit" name="Guardar" value="Guardar">
      
      </form>

  </fieldset>  
 </body> 
</html> 
