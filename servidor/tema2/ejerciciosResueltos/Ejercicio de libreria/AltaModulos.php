<html>
<?php 

require_once 'libreria.php';



function ObtenerCiclos()
{
   $consulta="select * from Ciclos";
   
   $filas=ConsultaDatos($consulta);
   
   $ciclos=array();
   
   foreach ($filas as $fila)
   {
       $ciclos[$fila['Id']]=$fila['Nombre'];
   }
    
  return $ciclos; 
}


$cur='';

if (isset($_GET['Curso'] ) )
{
    $cur=$_GET['Curso'];
}

$cicl='';

if (isset($_GET['Ciclo'] ) )
{
    $cicl=$_GET['Ciclo'];
}


?>

<body>

 <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'> 
     <fieldset><legend>Datos de Alumnos</legend>
            
           
            <label for='Nombre'>Nombre </label><input type='text' name='Nombre' ><br>
            
            <label for='Curso'>Curso:</label>
            <select name='Curso'>
               <option value=''></option>
             
               <?php 
               
               $curso=array(1,2);
               
               foreach ($curso as $clave=>$valor)
               {
                  echo "<option value='$valor' ";
                  
                  if (  $cur==$valor)
                  {
                      echo " selected ";
                  }
                      
                   
                  echo ">$valor</option>"; 
                   
               }
               
               ?>
            
            </select>
            
            <label for='Ciclo'>Ciclo:</label>
            <select name='Ciclo'>
               <option value=''></option>
             
               <?php 
               
               $ciclos=ObtenerCiclos();   //Obtenemos los paises
               
               foreach ($ciclos as $clave=>$valor)
               {
                  echo "<option value='$clave' ";
                  
                  if (  $cicl==$clave)
                  {
                      echo " selected ";
                  }
                      
                   
                  echo ">$valor</option>"; 
                   
               }
               
               ?>
            
            </select>
            
            
            <input type='submit' name='Guardar' value='Guardar'>
            
           </fieldset> 
     </form>  
  </body>   
  
<?php 

if (isset($_POST['Guardar']) )
{
   
    $nombre = ucfirst($_POST['Nombre']);
    
    $cur = $_POST['Curso'];
    
    $codCiclo = $_POST['Ciclo'];   //El valor que recibimos el el codigo del ciclo
    
    //Comprobamos que no inserte dos veces la misma fila
    
    $consulta="select count(*) as cuenta from Modulos where Nombre='$nombre' and Curso='$cur' and Ciclo=$codCiclo ";
    
    $filas=ConsultaDatos($consulta);
    
    $fila=$filas[0];  //Recogemos la fila que devuelve, solo puede devolver una la fila 0
    
    if ($fila['cuenta']==0)
    {
    
        $consulta="insert into Modulos values(NULL,'$nombre','$cur',$codCiclo)";
        
        ConsultaSimple($consulta);
        
    }
    else 
    {
       echo "<b>ERROR, ya existe ese módulo en ese curso y ciclo</b>"; 
    }
        
    
}







?>  
  
  
  
  
        
</html>           
           