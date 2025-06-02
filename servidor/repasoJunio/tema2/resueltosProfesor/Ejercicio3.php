<html>
<?php 

require_once 'libreria.php';

$matricula="";

if (isset($_POST['Matricula']) )
{
    $matricula=$_POST['Matricula'];
}

if (isset($_POST['Actualizar']) )
{
   $id=$_POST['id'];
   $nombre=$_POST['nombre'];
   $marca=$_POST['marca'];
   $modelo=$_POST['modelo'];
   $precio=$_POST['precio'];
   $matricula=$_POST['matricula'];
   $anio=$_POST['anio'];
  
   $conteFoto=""; 
   
   if ( $_FILES['foto']['name']!="" ) 
   {
     
      $conteFoto=file_get_contents($_FILES['foto']['tmp_name']);
       
      $conteFoto=base64_encode($conteFoto);
   }
    
   $consulta="update coche set nombre='$nombre',marca='$marca',
                               modelo='$modelo',precio=$precio,
                               matricula='$matricula',anio=$anio ";
   
   if ($conteFoto!="")    //Si hemos seleccionado una foto que actualizar
   {
       $consulta.=",foto='$conteFoto' ";
   }
   
   $consulta.=" where id=$id ";
   

   ConsultaSimple($consulta);
    
}


?> 
  
 <body>
 
    <form name='f1' method='post' action=<?php echo $_SERVER['PHP_SELF'];  ?> enctype='multipart/form-data' >
     
    Matricula<select name='Matricula'>
                <option value=''></option>
       
               <?php 
               
                $consulta="select matricula from coche";      
               
                $filas=ConsultaDatos($consulta);
               
                foreach ($filas as $fila) 
                {
                  echo "<option value='$fila[matricula]' ";  
                    
                  if ($fila['matricula']==$matricula)  
                  {
                    echo " selected ";  
                  }
                  echo ">$fila[matricula]</option>";  
                }
                
                
                
               ?>
    
         
              </select>
    
              <input type='submit' name='Enviar' value='Enviar'><br><br>
    
              <?php 
              
              if ($matricula!="")   //Si la matricula que me ha llegado no es vacia
              {
                  $consulta="select * from coche where matricula='$matricula' ";  //Obtenemos todos los datos de ese coche
                  
                  $filas=ConsultaDatos($consulta);
                  
                  if (count($filas)==1)   //Si me devuelve una sola fila
                  {
                      $fila=$filas[0];   //La recuperamos
                  }
                  
                  
                  echo "<fieldset><legend>Editar datos del coche</legend>";
                  
                  echo "Id<input type='text' name='id' value='$fila[id]' readonly='readonly'><br>";
                  echo "Nombre<input type='text' name='nombre' value='$fila[nombre]'><br>";
                  echo "Marca<input type='text' name='marca' value='$fila[marca]'><br>";
                  echo "Modelo<input type='text' name='modelo' value='$fila[modelo] '><br>";
                  echo "Precio<input type='text' name='precio' value='$fila[precio] '><br>";
                  echo "Matricula<input type='text' name='matricula' value='$fila[matricula]'><br>";
                  echo "Año<input type='text' name='anio' value='$fila[anio]'><br>";
                  
                  echo "<img src='data:image/jpg;base64,$fila[foto]'  width='80' height='80'><br>";
                  
                  echo "<input type='file' name='foto'><br><br><br>";
                  
                  echo "<input type='submit' name='Actualizar' value='Actualizar' '>";
                  
                  echo "</fieldset>";
                  
              }
         
              
              ?>
    
    </form>
 
    
 
 </body>
 


</html>
