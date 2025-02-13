<html> 

<?php 

require_once 'libreria2.php';  //Utilizamos la libreria sobre la BBDD Prueba2

if (isset($_POST['Guardar']) )
{
    $nombre=$_POST['Nombre'];
   
    //Procesamos el file
    
   
 
    if ( $_FILES['Imagen']['name']!=""  )   //Si hemos seleccionado un archivo
    {
        //$nombreOrig=$_FILES['Imagen']['name']; //Recogemos su nombre originnal
        
        $nombreTemp=$_FILES['Imagen']['tmp_name']; //Recogemos el nombre temporal desde esa ubicación temporal
        
        if ( $_FILES['Imagen']['size']< (16*1024*1024 ) )  //comprobamos que la imagen no excede al tamaño del campo mediumblob
        {
            $imagenConte=file_get_contents($nombreTemp);  //Extraemos el contenido del archivo temporal
           
            $imagenConte=base64_encode($imagenConte);  //Para formatear el contenido del archivo y evitar posibles problemas lo codificamos en base_64
            
        }
        else
        {
          echo "<b>ERROR, el tamaño de la imagen no puede exceder de 16MB </b>";  
        }
        
        $consulta="Insert into Marcas values(NULL,'$nombre','$imagenConte')";
        
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
