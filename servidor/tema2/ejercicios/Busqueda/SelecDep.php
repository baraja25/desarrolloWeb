  <html>
  <?php 
   
  //require_once  ('libreria.php');
  
  
  
  function ObtenerLocalidades($pais,$prov)
  {
      global $db;
      
      $consulta="select * from Localidades where IdPais=$pais and IdProvincia=$prov ";
      
      $resul=mysqli_query($db,$consulta);
      
      if ($resul)
      {
          $filas=mysqli_fetch_all($resul,MYSQLI_ASSOC);  //Extraemos todas las filas del resultado como un array asociativo
      }
      else
      {
          echo mysqli_error($db);
      }
      
      
      return $filas;
  }
  
  
  
  
  function ObtenerProvincias($pais)
  {
      global $db;
      
      $consulta="select * from Provincias where IdPais='$pais'";
      
      $resul=mysqli_query($db,$consulta);
      
      if ($resul)
      {
          $filas=mysqli_fetch_all($resul,MYSQLI_ASSOC);  //Extraemos todas las filas del resultado como un array asociativo
      }
      else
      {
          echo mysqli_error($db);
      }
      
      
      return $filas;
  }
  
  
  
  function ObtenerPaises()
  {
    global $db;
    
    $consulta="select * from Paises";
    
    $resul=mysqli_query($db,$consulta);
    
    if ($resul)
    {
        $filas=mysqli_fetch_all($resul,MYSQLI_ASSOC);  //Extraemos todas las filas del resultado como un array asociativo
    }
    else
    {
        echo mysqli_error($db);
    }
      
      
    return $filas;  
  }
  
  $host="localhost";
  
  $user="root";
  
  $pass="";
  
  $base="Prueba";
  
  $db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexio
  
  
  
  $pais="";
  
  if (isset($_POST['Pais']) )
  {
      $pais=$_POST['Pais'];
  }
 
  $prov="";
  
  if (isset($_POST['Provincia']) )
  {
      $prov=$_POST['Provincia'];
  }
  
  $localid="";
  
  if (isset($_POST['Localidad']) )
  {
      $localid=$_POST['Localidad'];
  }
  
  
  
  ?>
  
    <body>
      <fieldset> 
          <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
            
            Pais<select name='Pais' onChange='f1.submit();'>
                <option value=''></option>
       
                <?php 
                
                $filas=ObtenerPaises();   //Obtenemos los datos de los paises
                
                foreach ($filas as $fila)
                {
                   echo "<option value='$fila[Id]' "; 
                    
                   if ($pais==$fila['Id'])
                   {
                     echo " selected ";  
                   }
                       
                   echo ">$fila[Nombre]</option>";
                   
                }
                 
                ?>
       
              </select>  
              
              
              <?php 
              
              if ($pais!="")      //Si hemos seleccionado un pais
              {
                  echo "Provincia<select name='Provincia' onChange='f1.submit();'>";
                  echo "<option value=''></option>";
                 
                  $filas=ObtenerProvincias($pais);   //Obtenemos los datos de las provincias de ese pais
                  
                  foreach ($filas as $fila)
                  {
                      echo "<option value='$fila[IdPro]' ";
                      
                      if ($prov==$fila['IdPro'])
                      {
                          echo " selected ";
                      }
                      
                      echo ">$fila[Nombre]</option>";
                      
                  }
                  
                  echo "</select>";  
                  
              }
              
              
              if ( $prov!="" && $pais!="")  //Si hemos seleccionado una provincia y pais
              {
                  echo "Localidad<select name='Localidad' onChange='f1.submit();'>";
                  echo "<option value=''></option>";
                  
                  $filas=ObtenerLocalidades($pais,$prov);   //Obtenemos los datos de las provincias de ese pais
                  
                  foreach ($filas as $fila)
                  {
                      echo "<option value='$fila[IdLoc]' ";
                      
                      if ($localid==$fila['IdLoc'])
                      {
                          echo " selected ";
                      }
                      
                      echo ">$fila[Nombre]</option>";
                      
                  }
                  
                  echo "</select>";  
                 
              }
              
              mysqli_close($db);
              
              
              ?>
       
     </body>
 </html>           
                   
                  
                  
             
              
              
              
              
 
            
   
    