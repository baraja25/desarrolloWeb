<html>


<?php 

function ObtenerAlumnos()
{
    $alumnos=array();   //Array con las lineas del archivo
    
    $fd=fopen("Alumnos.txt","r") or die("Error al abrir el archivo");
    
    //Mostramos el contenido del archivo
    
    while(!feof($fd) )     //Mientras No  llegado al fin del archivo
    {
        $linea=fgets($fd); //Extraemos una linea de ese archivo
        
        $campos=explode(":",$linea); //Separamos la linea en campos
        
        if (count($campos)==6 )   //Solo queremos la lienas con los 6 campos del alumno
        {
            $alumnos[$campos[0]]=$linea; //Guardamos ese linea en el array de alumnos
        }
    }
    
    fclose($fd);
    
    return  $alumnos;
}


function ObtenerModulos()
{
    $modulos=array();   //Array con las lineas del archivo
    
    $fd=fopen("Modulos.txt","r") or die("Error al abrir el archivo");
    
    //Mostramos el contenido del archivo
    
    while(!feof($fd) )     //Mientras No  llegado al fin del archivo
    {
        $linea=fgets($fd); //Extraemos una linea de ese archivo
        
        $campos=explode(":",$linea); //Separamos la linea en campos
        
        if (count($campos)==4 )   //Solo queremos la lienas con los 6 campos del alumno
        {
            $modulos[$campos[0]]=$linea; //Guardamos ese linea en el array de alumnos
        }
    }
    
    fclose($fd);
    
    return  $modulos;
}

?>



<body>

 <fieldset><legend>Consulta Notas</legend> 
      <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        
      <?php 
      
         $modulos=ObtenerModulos();  //Obtenemos los alumnos matriculados en ese modulo y curso
         
         foreach ($modulos as $clave=>$linea)
         {
            $campos=explode(":",$linea);
             
            echo "$campos[1]<input type='checkbox' name='Modulos[$clave]'><br>";
             
         }
           
         ?>
        
       <input type='submit' name='Consultar' value='Consultar Notas'>
    
      </fieldset>   
      
      <?php 
      
      if (isset($_GET['Consultar']) )
      {
          
          
      }
      
      ?>
      
   </form>
    
 </body> 
</html> 
 