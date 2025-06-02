<html>

 <?php 
  
  require_once 'DaoCoches.php';
  
  $base="repaso";
  
  $daoC=  new DaoCoches($base);  //Creamos una instancia de la clase DaoCoches
  
  $Id="";
  
  if (isset($_POST['Coche']) )       //Si me llega el Id de un coche
  {  
      $Id=$_POST['Coche'];
  }
  
  
  if (isset($_POST['Actualizar']) )
  {
      $nombre=$_POST['nombre'];
      $marca=$_POST['marca'];
      $modelo=$_POST['modelo'];
      $precio=$_POST['precio'];
      $matricula=$_POST['matricula'];
      $anio=$_POST['anio'];
      
      //comprobamos si me llega una imagen
      
      
      
      if ($_FILES['foto']['name']!="" )      // Si hemos seleccionado alguna foto
      {
          $temp=$_FILES['foto']['tmp_name'];  //Recogemos el nombre temporal del archivo subido
          
          $conte=file_get_contents($temp);  //Extraemos el contenido de ese archivo temporal
          
          $conte=base64_encode($conte);     //Codificamos ese contenido en formato base_64
          
      }
      else // sino hemos seleccionado ninguna foto, recuperamos el valor de la foro anterior
      {
          $coche=$daoC->obtener($Id);
          
          $conte=$coche->__get('foto');
      }
          
      
      //Creamos una instancia de la clase coche
      
      $coche1 = new Coche();
      
      $coche1->__set("id", $Id);
      $coche1->__set("nombre", $nombre);
      $coche1->__set("marca", $marca);
      $coche1->__set("modelo", $modelo);
      $coche1->__set("precio", $precio);
      $coche1->__set("matricula", $matricula);
      $coche1->__set("anio", $anio);
      $coche1->__set("foto", $conte);
      
      //Actualizamos los datos de este coche
      
      $daoC->actualizar($coche1);
  }
  
 ?>


 <body>
 
   <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data' > 
     <fieldset><legend>Introduzca la matrícula del coche</legend>
          
            Coche<select name='Coche'>
            <option></option>
            <?php 
            
            $daoC->listar();
            
            foreach ($daoC->coches as $coche)
            {
                echo "<option value='".$coche->__get('id')."' ";

                if ($coche->__get('id')==$Id)
                {
                  echo " selected ";  
                }
                    
                    
                echo ">".$coche->__get('matricula')."</option>";
                
            }
            
           
            ?>
          
            </select><input type='submit' name='Buscar' value='Buscar'>
                     
      </fieldset> 
      
      
      <?php 
      
      if (isset($_POST['Buscar']) && ($Id!="")   )
      {
              $nombre="";
              $marca="";
              $modelo="";
              $precio="";
              $matricula="";
              $anio="";
              
              $conte="";
              
              //Recuperamos los datos de ese id
              
              $coche=$daoC->obtener($Id);
                  
                  $nombre= $coche->__get('nombre');
                  $marca=$coche->__get('marca');
                  $modelo=$coche->__get('modelo');
                  $precio=$coche->__get('precio');
                  $matricula=$coche->__get('matricula');
                  $anio=$coche->__get('anio');
                  
                  $conte=$coche->__get('foto');
                  
            
             echo "<fieldset>";
             echo "<legend>Datos del coche. Modifique los que desee actualizar</legend>";
              
             echo "<label for='nombre'>nombre </label><input type='text' name='nombre' value='$nombre'><br>
                   <label for='marca'>marca </label><input type='text' name='marca'  value='$marca'><br>
                   <label for='modelo'>modelo </label><input type='text' name='modelo'  value='$modelo'><br>
                   <label for='precio'>precio </label><input type='text' name='precio'  value='$precio'><br>
              
                   <label for='matricula'>matricula </label><input type='text' name='matricula'  value='$matricula'><br>
                   <label for='anio'>anio </label><input type='text' name='anio'  value='$anio'><br>
              
                   <img src='data:image/jpg;base64,$conte' width=70 height=70>";
             
              echo "<input type='file' name='foto'><br>";
              
              echo "<input type='submit' name='Actualizar' value='Actualizar'>";
     
      }
              
      ?>
       
      </fieldset>
     
     </form> <br><br><br>
     
 
     
     
  </body>  
</html>  
  
  