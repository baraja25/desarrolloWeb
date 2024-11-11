<html>

<body>

<?php 

function  NotaModulo($clave,$mod,$cur,$notasArchivo) 
{
  $nota="";
  
  if (isset($notasArchivo[$clave]))  //Si ese alumno tenia una nota
  {
      $linea=$notasArchivo[$clave];
        
      $campos=explode(":",$linea);
      
      if ( ($campos[1]==$mod)  &&  ($campos[2]==$cur)  )
      {
          $nota=$campos[3];
      }
      
  }
  
  return $nota;
}

function VolcarNotas($notas)
{
    $fd=fopen("Notas.txt","w") or die("Error al abrir el archivo");  //Abrimos el archivo con Sobre-escritura
    
    foreach ($notas as $clave=>$linea)
    {
      fputs($fd, $linea); //Volcamos esa linea en el archivo     
    }
    
    fclose($fd);
}

function ObtenerNotas()
{
    $notas=array();   //Array con las lineas del archivo
    
    if (file_exists("Notas.txt") )
    {
            $fd=fopen("Notas.txt","r") or die("Error al abrir el archivo");
            
            //Mostramos el contenido del archivo
            
            while(!feof($fd) )     //Mientras No  llegado al fin del archivo
            {
                $linea=fgets($fd); //Extraemos una linea de ese archivo
                
                $campos=explode(":",$linea); //Separamos la linea en campos
                
                if (count($campos)==4 )   //Solo queremos la lienas con los 6 campos del alumno
                {
                    $notas[$campos[0]]=$linea; //Guardamos ese linea en el array de alumnos
                }
            }
            
            fclose($fd);
            
    }
    
    return  $notas;
   
}

function PonerNota($clave,$mod,$cur,$nota)
{
    global $notasArchivo;
    
    $salto="\r\n";
         
    $linea="$clave:$mod:$cur:$nota".$salto;
        
    $notasArchivo[$clave]=$linea;     //Insertamos la linea con la nueva nota    
       
}


function ObtenerMatriculados($mod,$cur)
{
    $alumnosMatri=array();
    
    $alumnos=ObtenerAlumnos();   //Obtenemos los datos de todos los alumnos
    
    $fd=fopen("Matricula.txt","r") or die("Error al abrir el archivo");
    
    while(!feof($fd) )
    {
       $linea=fgets($fd);
        
       $campos=explode(":",$linea);
       
       if (count($campos)==3 )       //Filtramos posibles lineas con menos campos(con caracteres especiales)
       {
           if ( ( trim($mod)==trim($campos[1]) ) && (trim($cur)==trim($campos[2])  )  )    //Si en esa matricula conincie el curso y el modulo
           {
               $lineaAlu=$alumnos[$campos[0]];   //Recuperamos la linea con los datos de ese alumno
               
               $camposAlu=explode(":",$lineaAlu);
               
               $alumnosMatri[$campos[0]]="$camposAlu[2]:$camposAlu[3]:$camposAlu[1]:$camposAlu[4]:$camposAlu[5]";        ;  //Guardamos en el array de matriculados la linea del alumno con ese dni   
           }
          
       }
       
    }
    
    asort($alumnosMatri); //Ordenamos por valor manteniendo la clave
   
    fclose($fd);
   
    return  $alumnosMatri;
    
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



//Comprobamos los datos recibidos tras la recarga



$mod="";

if (isset($_POST['Modulo']) )   //Si tras la recarga recibimos un módulo
{
    $mod=$_POST['Modulo'];
}

$cur="";

if (isset($_POST['Curso']) )   //Si tras la recarga recibimos un módulo
{
    $cur=$_POST['Curso'];
}

if (isset($_POST['Calificar']) )   //Si hemos pulsado en calificar
{
    $notas=$_POST['Notas']; //Recogemos las notas de los alumnos
    
    $notasArchivo=ObtenerNotas(); //Funcion que vuelca los datos del archivo notas a un array
    
    foreach ($notas as $clave=>$nota)
    {
        if ($nota!="")  //Si la nota de ese campo no es vacia
        {
            PonerNota($clave,$mod,$cur,$nota);  //Ponemos esa nota al alumno
        }
        
    }
    
    VolcarNotas($notasArchivo);  //Vuelca las notas del array al archivo notas.txt
    
}


?>


 <fieldset><legend>Calificación de alumnos</legend> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        
         Modulo<select name='Modulo'>
                 <option value=''></option>
         
         <?php 
         
         //Recuperamos los datos los modulos
         
         $modulos=ObtenerModulos();  //Obtenemos los alumnos matriculados en ese modulo y curso
         
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
           
         ?>
        
         </select>
                 
         Curso<select name='Curso'>
                 <option value=''></option>
         <?php 
         
         $cursos=array('2020','2021','2022','2023','2024','2025');
         
         foreach ($cursos as $clave=>$curso)
         {
             echo "<option value='$clave'  ";
             
             if ($cur==$campos[0])
             {
                 echo " selected ";
             }
             echo ">$curso</option>";
           
         }
         
         ?>
         
         </select>
         
       <input type='submit' name='Mostrar' value='Mostrar Alumnos'>
    
      </fieldset>   
      
      <?php 
      
      if (isset($_POST['Mostrar']) )
      {
          
          echo "<fieldset><legend>Alumnos Calificables</legend>";
          
          echo "<table border='2'>";
          echo "<th>Apellido1</th><th>Apellido2</th><th>Nombre</th><th>Nota</th>";
          
          $alumnos=ObtenerMatriculados($mod,$cur);  //Obtenemos los alumnmos matriculados para ese curso y ese modulo
          
          $notasArchivo=ObtenerNotas(); //Funcion que vuelca los datos del archivo notas a un array
          
          foreach ($alumnos as $clave=>$linea)
          {
              $campos=explode(":",$linea);
              
               echo "<tr>";
                   
                  echo "<td>$campos[0]</td><td>$campos[1]</td><td>$campos[2]</td>";
                  
                  $notaAlu=NotaModulo($clave,$mod,$cur,$notasArchivo); 
                   
                  echo "<td><input type='text' name='Notas[$clave]'  size='3' value='$notaAlu'></td>";
                  
                  echo "</tr>";
                  
             
          }
          
          echo "</table>";
          
          echo "<input type='submit' name='Calificar' value='Calificar'>";
          
          echo "</fieldset>";
        
      }
      
      ?>
      
   </form>
    
 </body> 
</html> 
 