
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
 
 
 //Comprobamos si recibimos datos posteados anteriormente
 
 $modelo='';
 
 if (isset($_POST['Modelo']) )
 {
     $modelo=$_POST['Modelo'];
 }
 
 $precio='';
 
 if (isset($_POST['Precio']) )
 {
     $precio=$_POST['Precio'];
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
 
 $NumFotos='';
 
 if (isset($_POST['NumFotos']) )
 {
     $NumFotos=$_POST['NumFotos'];
 }
 

 if (isset($_POST['Guardar']) ) 
 {
     $ConteFoto=""; //Inicializamos a vacio el nombre de la foto de portada del ese coche
        
     if ( isset($_FILES['Foto']) && $_FILES['Foto']['name']!='' )    //si hemos seleccionado un archivo
     {
         $nombreTemp=$_FILES['Foto']['tmp_name'];
         
         $ConteFoto=file_get_contents($nombreTemp);
         
         $ConteFoto=base64_encode($ConteFoto);
         
     }
     
     $consulta="Insert into Coches values(NULL,'$nombre',$marca,'$modelo',$precio,'$ConteFoto')";
     
     ConsultaSimple($consulta);  //Ejecutamos la consulta de insercción para dar de alta ese coche en la tabla coches
     
     //Necesitamos recuperar el Id autoincrementado que ha sido asignado a ese coche
     
     $consulta="select Max(Id) as Id from Coches "; //Recuperamos el ID del coche usando la foto como referencia
     
     $filas=ConsultaDatos($consulta);
     
     $IdCoche=$filas[0]['Id'];   //Recuperamos el Id de ese coche
     
     for ($i=1;$i<=$NumFotos;$i++)     //Para cada una de los campos file complementarios
     {
         
         $ConteFotoComple=""; //Inicializamos a vacio el nombre de la foto de portada del ese coche
         
         if (  $_FILES['Complems']['name'][$i]!='' )    //si hemos seleccionado un archivo
         {
                          
             $nombreTemp=$_FILES['Complems']['tmp_name'][$i]; //Cogemos el nombre de su archivo temporal
             
             $ConteFotoComple=file_get_contents($nombreTemp);
            
             $ConteFotoComple=base64_encode($ConteFotoComple);
             
         }
         
         $consulta="insert into ImagenCoche values($IdCoche,$i,'$ConteFotoComple')";   //Insertamos en la tabla fotos coche el IdCoche el IdIamgen y el nombre de esa foto
      
         //echo $consulta;
         
         ConsultaSimple($consulta);
     }
     
     
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
             
              echo "<img src='data:image/jpg;base64,$imagenConte'   width='70' height='70'><br>";
              
              ?>
             
            
            
            <br>
        
        Modelo<input type="text" name="Modelo" value='<?php echo $modelo; ?>'><br>   
    
        Precio<input type="number" name="Precio" value='<?php echo $precio; ?>'><br> 
       
       
        
        Num Fotos<select name='NumFotos' onChange='f1.submit();'>
                       <option value=''></option>
              
                              <?php 
                              
                              for ($i=1;$i<4;$i++)
                              {
                                 echo "<option value='$i' "; 
                                  
                                 if ($NumFotos==$i)   //Si el Id de esa imagen coincide con el seleccionado previamente
                                 {
                                   echo " selected ";    //Marcamos esa imagen como seleccionada
                                   
                                   $imagen=$fila['Imagen']; //Guardamos en una variable el nombre de esa imagen
                                 }
                              
                                 echo ">$i</option>"; 
                              }
                                    
                              ?>
             
                    </select> <br><br>
       
         Foto Principal<input type='file' name='Foto' ><br> 
       
        <fieldset><legend>Fotos Complentarias</legend>
        
        <?php 
        
        //Crear un campo file para cada foto complementaria
        
        for($i=1;$i<=$NumFotos;$i++)
        {
           echo "Foto Complementaria$i <input type='file' name='Complems[$i]'><br>"; 
            
            
        }
        
        
        ?>
        
        
        
        </fieldset>
        
        
       
        <input type="submit" name="Guardar" value="Guardar">
      
      </form>

  </fieldset>  
 </body> 
</html> 
