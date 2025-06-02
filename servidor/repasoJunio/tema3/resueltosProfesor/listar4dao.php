
<html>
 <body>
   <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data' > 
 
 
    <?php
    
    require_once 'DaoCoches.php';
    
    $base="repaso";
    
    $daoC=  new DaoCoches($base);  //Creamos una instancia de la clase DaoCoches
    
    function MostrarFormDet($Id)
    {
        global $daoC;
        
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
        echo "<legend>Datos del coche con Id:$Id</legend>";
        
        echo "<label for='nombre'>nombre </label><input type='text' name='nombre' value='$nombre'><br>
                   <label for='marca'>marca </label><input type='text' name='marca'  value='$marca'><br>
                   <label for='modelo'>modelo </label><input type='text' name='modelo'  value='$modelo'><br>
                   <label for='precio'>precio </label><input type='text' name='precio'  value='$precio'><br>
                   
                   <label for='matricula'>matricula </label><input type='text' name='matricula'  value='$matricula'><br>
                   <label for='anio'>anio </label><input type='text' name='anio'  value='$anio'><br>
                   
                   <img src='data:image/jpg;base64,$conte' width=70 height=70>";
        
        echo "<br><br>";
         
        echo "</fieldset>";
               
    }
    
    
    $daoC->listar();
       
    echo "<table border='2'>";
    echo "<th>Selec</th><th>Foto</th>";
    
    foreach ($daoC->coches as $coche) 
    {
        echo "<tr>";
        
        
        echo "<td><input type='checkbox' name='Selec[".$coche->__get('id')."]'></td>";
        
        $conte=$coche->__get('foto');
        
        echo "<td><img src='data:image/jpg;base64,$conte' width=70 height=70></td>";
        
        echo "</tr>";
        
    }
    
    echo "</table>";
    
    ?>
    
   <input type='submit' name='Detalle' value='Detalle'> 
    
   <?php 
   
   if (isset($_POST['Detalle'])  && (isset($_POST['Selec'])) )
   {
      $selec=$_POST['Selec'];
       
      foreach ($selec as $clave=>$valor) 
      {
          MostrarFormDet($clave);  // Mostramos un formulario de detalle para cada Id marcado
      }
      
       
       
       
       
   }
  
   ?> 
    
   </fieldset> 
   </form> <br><br><br> 
 
 </body>

</html>
