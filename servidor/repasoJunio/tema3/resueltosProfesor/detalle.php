<html>

 <?php 
  
 require_once 'DaoCoches.php';
 
 $base="repaso";
 
 $daoC=  new DaoCoches($base);  //Creamos una instancia de la clase DaoCoches
  
  
  
  //Inicializamos las variables
  
  $nombre="";
  $marca="";
  $modelo="";
  $precio="";
  $matricula="";
  $anio="";
  
  $conte="";
  
  if (isset($_GET['id']) ) //Hemos recibido el id de un coche a mostrar
  {
      $id= $_GET['id'];
      
     
                                            
  }
  else 
  {
      $id=$daoC->Primero();
  }
      

      $coche=$daoC->obtener($id);  //Recuperamos los datos de ese id
      
      $nombre=$coche->__get('nombre');
      $marca= $coche->__get('marca');
      $modelo=$coche->__get('modelo');
      $precio=$coche->__get('precio');
      $matricula=$coche->__get('matricula');
      $anio=$coche->__get('anio');
      
      $conte=$coche->__get('foto');
      
     
  
 ?>


 <body>
 
   <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data' > 
     <fieldset><legend>Detalle del coche</legend>
            
            
            <label for='nombre'>nombre </label><input type='text' name='nombre' value='<?php echo $nombre;  ?>'><br>
            <label for='marca'>marca </label><input type='text' name='marca'  value='<?php echo $marca;  ?>'><br>
            <label for='modelo'>modelo </label><input type='text' name='modelo'  value='<?php echo $modelo;  ?>'><br>
            <label for='precio'>precio </label><input type='text' name='precio'  value='<?php echo $precio;  ?>'><br>
            
            <label for='matricula'>matricula </label><input type='text' name='matricula'  value='<?php echo $matricula;  ?>'><br>
            <label for='anio'>anio </label><input type='text' name='anio'  value='<?php echo $anio;  ?>'><br>
            
            <img src='data:image/jpg;base64,<?php echo $conte;  ?>' width=70 height=70>
            
      </fieldset> 
      
     <?php 
     
     echo "<a href='detalle.php?id=".$daoC->Primero()."'> <<  </a> ";
     
     echo "<a href='detalle.php?id=".$daoC->Anterior($id)."'> <  </a> ";
     
     echo "<a href='detalle.php?id=".$daoC->Siguiente($id)."'> >  </a> ";
     
     echo "<a href='detalle.php?id=".$daoC->Ultimo()."'> >> </a> ";
     
     
     
     
     
     ?>
      
      
      
     </form> <br><br><br>
     
   
  </body>  
</html>  