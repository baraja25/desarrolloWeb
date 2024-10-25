<html>

<body>
<?php 


function EstaEnArchivo($linea)
{
    $encontrada=FALSE; // Por defecto suponemos que no esta
    
    $fd=fopen("Matricula.txt","r") or die("Error al abrir el archivo de matricula");
    
    while ( !feof($fd) && !$encontrada  )
    {
       $lineaArchi=fgets($fd);  
        
       if ( trim($linea)==trim($lineaArchi) )  //si la linea recibida coincide con la linea del archivo
       {
           $encontrada=TRUE;
       }
       
    }
    
    fclose($fd);
    
    return $encontrada;
}


function Matricular($clave,$mod,$curso)
{
    $fd=fopen("Matricula.txt","a+") or die("Error al abrir el archivo de matricula");
    
    $linea="$clave:$mod:$curso"."\r\n";   //Construimos la linea que vamos a insertar en el archivo
  
    if (!EstaEnArchivo($linea) )
    {
     fputs($fd, $linea);
    }
    else
    {
      echo "Error, el alumno con DNI:$clave ya esta matriculado en ese módulo y curso<br> ";   
    }
    
    fclose($fd);
    
}

function PasaFiltro($campos,$filtro)
{
  $pasa=TRUE;
  
  for($i=1;$i<=5;$i++)
  {
       $pasa=$pasa && ( ($filtro[$i]=="") || ( trim($filtro[$i])==trim($campos[$i]) )   );   
      
  }
    
  return $pasa;   
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



$alumnos=ObtenerAlumnos();   //Recogemos los alumnos del archivo en un array

if ( (isset($_GET['Borrar']) )  &&  (isset($_GET['Selec']))   )   //Si hemos marcado borrar y seleccionado algun check
{
    $selec=$_GET['Selec'];  //Recogemos el array de filas seleccionadas
    
    Borrar($selec,$alumnos);  //Eliminamos los alumnos seleccionados del array alumnos

}

//Comprobamos los datos recibidos tras la recarga

$mod="";

if (isset($_GET['Modulo']) )   //Si tras la recarga recibimos un módulo
{
    $mod=$_GET['Modulo'];
}

$curso="";

if (isset($_GET['Curso']) )   //Si tras la recarga recibimos un módulo
{
    $curso=$_GET['Curso'];
}


if ( isset($_GET['Matricular']) && (isset($_GET['Selec'])) )    //Si hemos pulsado matricular y seleccionado algun alumno 
{
    $selec=$_GET['Selec']; //Recuperamos el array con los Dni de los alumnos seleccionados
    
    foreach ($selec as $clave=>$valor)
    {
       Matricular($clave,$mod,$curso);   //Matriculamos ese alumno en ese modulo y curso
    }
    
    
    
    
}


?>


 <fieldset><legend>Busqueda de alumnos</legend> 
      <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        
        Nombre<input type="text" name="Nombre"><br>      
        Apellido1<input type="text" name="Apellido1"><br> 
        Apellido2<input type="text" name="Apellido2"> <br>  
        Edad<input type="number" name="Edad"> <br>
        Telefono<input type="text" name="Telefono"> <br>
       
        <input type="submit" name="Buscar" value="Buscar">
    
  </fieldset>   
  
  <?php 
 
 
     if (isset($_GET['Buscar']) )
     {
         //Recogemos los valores de los campos
         
         $nombre=$_GET['Nombre'];
         $apellido1=$_GET['Apellido1'];
         $apellido2=$_GET['Apellido2'];
         $edad=$_GET['Edad'];
         $telefono=$_GET['Telefono'];
         
         $filtro=array(); //Array con los valores del campos a filtrar
         
         $filtro[1]=$nombre;
         $filtro[2]=$apellido1;
         $filtro[3]=$apellido2;
         $filtro[4]=$edad;
         $filtro[5]=$telefono;
         
         $alumnos=ObtenerAlumnos();   //Recogemos los alumnos del archivo en un array
         
         
         
         echo "<fieldset><legend>Alumnos para matricular</legend>";
         
         //Mostramos el desplegable con los modulos
         
         echo "Modulos<select name='Modulo'>";
         echo "   <option value=''></option>";
         
         //Recuperamos los datos los modulos
         
         $modulos=ObtenerModulos();
         
         foreach ($modulos as $clave=>$modulo)
         {
             $campos=explode(":",$modulo);
             
             echo "<option value='$campos[0]'  ";
             
             if ($mod==$campos[0])
             {
                 echo " selected ";
             }
             echo ">$campos[1]</option>";
             
             
         }
            
         echo "</select>";
         
         //Mostramos el desplegable con los cursos
         
         $cursos=array('2020','2021','2022','2023','2024','2025');
         
         echo "Curso<select name='Curso'>";
         echo "   <option value=''></option>";
         
         
         foreach ($cursos as $clave=>$curso)
         {
             echo "<option value='$clave'  ";
             
             if ($curso==$campos[0])
             {
                 echo " selected ";
             }
             echo ">$curso</option>";
             
             
         }
         
         echo "</select>";
         
         echo "<input type='submit' name='Matricular' value='Matricular'>";
        
         echo "<br>";
         
         echo "<br>";
         
         
         echo "<table border='2'>";
         echo "<th>Selec</th><th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Edad</th><th>Telefono</th>";
         
         foreach ($alumnos as $clave=>$linea)
         {
           $campos=explode(":",$linea);
          
           if ( PasaFiltro($campos,$filtro)  )       //Si la fila de esos campos pasa el filro
           {
               echo "<tr>";
               
               echo "<td><input type='checkbox' name='Selec[$campos[0]]'></td>";
               
               foreach ($campos as $clave=>$campo)
               {
                  echo "<td>$campo</td>"; 
               }
                 
               echo "</tr>";
            
           }
         }
         
         echo "</table>";
      
       echo "</fieldset>";  
         
     }

 ?>
  
  
   </form>

     
 </body> 
</html> 
 