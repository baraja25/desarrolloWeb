<html>
 <body>

 <?php 
  
 require_once 'libreria.php';
 
 function EstaMatriculado($IdAlum,$IdMod,$cur)
 {
      $consulta=" select count(*) as num  
                  from Matricula 
                  where IdCurso=$cur and IdAlum='$IdAlum' and IdMod=$IdMod "; 
        
      $filas=ConsultaDatos($consulta);
      
    return $filas[0]['num']; 
 }
 
 
 function NumeroMatriSig($IdAlum,$IdMod)
 {
   $consulta=" SELECT Max(Numero) as mayor,count(*) as cuenta 
               FROM Matricula
               where IdAlum='$IdAlum' and IdMod=$IdMod ";    
     
   $filas=ConsultaDatos($consulta);
   
   $fila=$filas[0];  //Al ser un consullta de agrupamiento solo devuelve una fila
 
   if ($fila['cuenta']==0)  //Si no hay matrículas previas
   {
     $numero=1;  
   }
   else   //En caso contrario obtenemos el mayor número de matrícula y sumamos 1
   {
       $numero=$fila['mayor']+1;
   }
   
   return $numero;
 }
 
 
 function Matricular($selec,$modulos,$cur)
 {
    $fd=fopen("Errores.txt","a+") or die("Abrimos el archivo de errores");
     
    foreach ($selec as $IdAlum=>$valorAlu )    //Para cada uno de los alumnmos seleccionados
    { 
        foreach ($modulos as $IdMod=>$valorMod )    //Para cada uno de los alumnmos seleccionados
        {
            
            if (!EstaMatriculado($IdAlum,$IdMod,$cur) )   //Si ese alumno no esta matriculado en ese módulo
            {
                $NumeroMatri=NumeroMatriSig($IdAlum,$IdMod);  //Obtenemos el número de matrícula
                
                //Guardar esa matrícula en la BBDD
                
                $consulta="insert into Matricula values($cur,'$IdAlum',$IdMod,$NumeroMatri)";
                
                ConsultaSimple($consulta);
                
            }
            else  //Si ya estaba matriculado en ese módulo y curso 
            {
                $linea="$cur:$IdAlum:$IdMod"."\r\n";    //Insertamos esa linea en el archivo de errores
                
                fputs($fd, $linea);
                
            }
           
        }
        
        echo "</br>";
    }
     
    fclose($fd);
 }
 
 
 
 function MostrarModulos()        //Funcion que muestra tabla con los módulos
 {
     $consulta="select * from Modulos ";
     
     $filas=ConsultaDatos($consulta);
     
     echo "<table border='2'>";
     echo "<th>Selec</th>";
     echo "<th>Nombre</th>";
     echo "<th>Curso</th>";
     echo "<th>Horas</th>";
     
     
     foreach($filas as $fila)
     {
         echo "<tr>";
         
         foreach ($fila as $clave=>$campo)
         {
             if($clave=="Id")
             {
                 echo "<td><input type='checkbox' name='Modulos[$campo]' ></td>";
             }
             else
             {
                 echo "<td>$campo</td>";
             }
             
         }
         
         echo "</tr>";
         
     }
     
     echo "</table>";
     
     
     
 }
 
 function CalcularNumpag($num)     //Calculamos el total de páginas en función del número de registros en cada una y los registros totales
 {
   global $db;  
     
   $consulta="select count(*) as total from Alumnos ";
   
   $resul=mysqli_query($db, $consulta);
   
   if ($resul==FALSE)
   {
       Echo "Error en la consulta:".mysqli_error($db);
       
   }
   else
   {
       $fila=mysqli_fetch_assoc($resul);  //Recogemos una fila(la única)
       
       $NumPag=ceil($fila['total']/$num);
       
   }
   
   return  $NumPag;
     
 }
 
function MostrarTabla($filas)
{
   
    
   echo "<table border='2'>";
   echo "<th>Selec</th>";
   echo "<th>Nombre</th>";
   echo "<th>Apellido1</th>";
   echo "<th>Apellido2</th>";
   echo "<th>Edad</th>";
   echo "<th>Telefono</th>"; 
   
   foreach($filas as $fila) 
   {
      echo "<tr>";
      
      foreach ($fila as $clave=>$campo)
      {
          if($clave=="NIF")
          {
           echo "<td><input type='checkbox' name='Selec[$campo]' ></td>";  
          }
          else 
          {
           echo "<td>$campo</td>";
          }
              
      }
      
      echo "</tr>";
       
   }
   
   echo "</table>";
   
   
}
 
 
 $host="localhost";
 
 $user="root";
 
 $pass="";
 
 $base="Prueba";
 
 $db=mysqli_connect($host,$user,$pass,$base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexion
 

$Pag=1; //Por defecto mostramos la información de la página 1

if (isset($_GET['Pag']) )
{
    $Pag=$_GET['Pag'];
}
 
$num=5;  //Fijamos por defecto a 5 el número de registros por página

if (isset($_POST['Numero']) )
{
    $num=$_POST['Numero'];
       
}

if (isset($_GET['Numero']) )
{
    $num=$_GET['Numero'];
    
}

$cur="";

if (isset($_POST['Curso']) )
{
    $cur=$_POST['Curso'];
    
}



if ( isset($_POST['Matricular']) && isset($_POST['Selec']) && isset($_POST['Modulos']) )    //Matriculamos los alumnos seleccionados en los módulos marcados
{
   //Recogemos los módulos y los alumnos marcados
    
    $selec=$_POST['Selec'];
    $modulos=$_POST['Modulos'];
    
    Matricular($selec,$modulos,$cur);  //Matriculamos los alumnos seleccionados en esos módulos y ese curso
    
    
}


 
?>
 
 <fieldset><legend>Paginación de Alumnos</legend> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
      
        Num Filas<select name="Numero" onChange="f1.submit();"'>
                  <option value=""></option> 
                  <?php 
                  
                  for($i=1;$i<=10;$i++)
                  {
                     echo "<option value='$i' "; 
                      
                     if ($i==$num)
                     {
                      echo " selected ";   
                     }
                        
                     echo ">$i</option>"; 
                        
                  }
                  
                  ?>
         
                 </select> <br>
             
      <?php      
               
                 //Determinar el registro inicial en función del número de página y el número de registros a mostrar
                 
                 $ini=($Pag-1)*$num;
      
                 $consulta="select * from Alumnos where 1 Limit $ini,$num";
                      
                 $resul=mysqli_query($db, $consulta);
                 
                 if ($resul==FALSE)
                 {
                     Echo "Error en la consulta:".mysqli_error($db);
                     
                 }
                 else 
                 {
                     $filas=mysqli_fetch_all($resul,MYSQLI_ASSOC);
                      
                     MostrarTabla($filas);  //Mostrmos una tabla con los resultados de la consulta
                 
                 }
                
           
             echo "<br>";          
   
             //Mostramos la tabla con los módulos
             
             MostrarModulos();  
             
             
             //Mostramos el desplegable con los cursos
             
             echo "Curso Académico<select name='Curso'>";
             echo "<option value=''></option>";
                  
             $consulta="select * from Curso ";
       
             $filas=ConsultaDatos($consulta);
             
             foreach ($filas as $fila)
             {
                 echo "<option value='$fila[Id]' ";
                 
                 if ($cur==$fila['Id'])
                 {
                     echo " selected ";
                 }
                 
                 echo ">$fila[Curso]</option>";
           
             }
           
             echo "</select> <br>";
             
            
             echo "<input type='submit' name='Matricular' value='Matricular'>";
             
             echo "<br>";
             echo "<br>";
             
                   
             //Calculamos el número de páginas que tenemos que mostrar
                 
             $NumPag=CalcularNumpag($num);    
                 
             
             for($i=1;$i<=$NumPag;$i++)    
             {
               echo "<a href='$_SERVER[PHP_SELF]?Numero=$num&Pag=$i'>$i</a>  ";  
                 
             }
         
              mysqli_close($db);
 
      ?>
      
      
    </form>
  
  </fieldset>
  
</body> 

</html> 