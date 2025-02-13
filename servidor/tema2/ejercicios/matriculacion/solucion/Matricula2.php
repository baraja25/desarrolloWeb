<html>
 <body>

 <?php 
  
 require_once 'libreria.php';
 

 function QuitarFilaMatricula($cur,$IdMod,$IdAlum)    //Eliminamos la fila con esa matrícula
 {
     $consulta="Delete from Matricula where IdCurso=$cur and IdAlum='$IdAlum' and IdMod=$IdMod ";
     
     ConsultaSimple($consulta);
 }
 
 function DecrementarValoresNumero($num,$IdAlum,$IdMod)   //Funcion que decrementa los valore en una unidad para número de matricula posterior al que hay que elminar
 {
     $consulta=" Update Matricula 
                 set Numero=(Numero-1) 
                 where Numero>$num AND IdAlum='$IdAlum' and IdMod=$IdMod ";
     
     ConsultaSimple($consulta);
 }
 
 
 function ActualizarNumMatricula($IdMod,$IdAlum,$cur)  //Actualizamos el número de matrícula 
 {
    $consulta="select Numero from Matricula where IdCurso=$cur and IdAlum='$IdAlum' and IdMod=$IdMod  "; 
     
    $filas=ConsultaDatos($consulta); 
     
    $num=$filas[0]['Numero'];  //Obtenemos el número de matricula de la fila a borrar
 
    $consulta="select max(Numero) as maximo from Matricula where IdAlum='$IdAlum' and IdMod=$IdMod  "; //Obtenemos el número máximo de matricula
 
    $filas=ConsultaDatos($consulta); 
    
    $max=$filas[0]['maximo'];
    
    if ($num<$max)   //Si no es el máximo hay que decrementar los valores de los número posteriors en una unidad
    {
        DecrementarValoresNumero($num,$IdAlum,$IdMod);
    }
    
 }
 
 
 function DesMatricular($modulos,$cur)
 {
     foreach ($modulos as $IdMod=>$valorMod )    //Para cada uno de los Modulos Marcados  pEra ver sus alumnos
     { 
        
         $nombreCla='Selec'.$IdMod;
           
         if ( isset($_POST[$nombreCla]) )   //Si hay alumnos seleccionados en la tabla de ese módulo para desmatricular
         {
           $selec=$_POST[$nombreCla];
         
           foreach ($selec as $IdAlum=>$valorAlum)
           {
               ActualizarNumMatricula($IdMod,$IdAlum,$cur);
               
               QuitarFilaMatricula($cur,$IdMod,$IdAlum);
               
           }
         }
                 
    }
     
 }
 
 
 
 function MostrarModulos($modulos)        //Funcion que muestra tabla con los módulos
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
                 echo "<td><input type='checkbox' name='Modulos[$campo]' ";

                 if ( array_key_exists($campo, $modulos) )
                 {
                  echo " checked ";
                 }
                 
                 echo "></td>";
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
 
function MostrarAlum($IdMod,$cur)   //Muestra una tabla con los alumnos matriculados en un módulo concreto
{
    $consulta="select Nombre from Modulos where Id=$IdMod ";   
    
    $filas=ConsultaDatos($consulta);
    
    echo "<b>Alumnos matriculados en el módulo ".$filas[0]['Nombre']."</b>";
    
    $consulta=" SELECT a.NIF,a.Apellido1,a.Apellido2,a.Nombre 
                FROM Matricula m,Alumnos a
                Where m.IdAlum=a.NIF and m.IdMod=$IdMod and IdCurso=$cur 
                order by 2,3,4 ";
    
   $filas=ConsultaDatos($consulta);
    
   echo "<table border='2'>";
   echo "<th>Selec</th>";
   echo "<th>Nombre</th>";
   echo "<th>Apellido1</th>";
   echo "<th>Apellido2</th>";
   
   foreach($filas as $fila) 
   {
      echo "<tr>";
      
      foreach ($fila as $clave=>$campo)
      {
          if($clave=="NIF")
          {
              $nombre="Selec".$IdMod; //Nombre de los checkbox con el Id del módulo asociado
              
           echo "<td><input type='checkbox' name='".$nombre."[$campo]' ></td>";  
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
 


$cur="";

if (isset($_POST['Curso']) )
{
    $cur=$_POST['Curso'];
    
}

$modulos=array();  //Array con los datos del los módulos marcados previamente

if (isset($_POST['Modulos']) )
{
    $modulos=$_POST['Modulos'];
}


if ( isset($_POST['DesMatricular'])  && isset($_POST['Modulos']) )    //Si hemos seleccionado desmatricular recogemos los modulos
{   //Recogemos los módulos y los alumnos marcados
    
   
    $modulos=$_POST['Modulos'];
    
    DesMatricular($modulos,$cur);
    
    
}
 
?>
 
 <fieldset><legend>Desmatriculación de Alumnos</legend> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
      
       <?php
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
      
             //Mostramos la tabla con los módulos
             
             MostrarModulos($modulos);  
             
             echo "<input type='submit' name='Mostrar' value='Mostrar Alum Matriculados'>";
             
             echo "<br><br>";
             
             if ( isset($_POST['Mostrar']) && !empty($modulos) )   //si queremos mostrar los alumnos matriculados en esos módulos
             { 
                 if ($cur!="")
                 {
                         foreach ($modulos as $IdMod=>$valor)  //Para cada uno de los módulos checkeados
                         {
                             MostrarAlum($IdMod,$cur);   //Mostramos una tabla con los alumnos matriculados en ese módulo
                          
                             echo "<br>";
                         }
                         
                         echo "<input type='submit' name='DesMatricular' value='Desmatricular Alumnos'>";
                 }
                 else 
                 {
                   echo "<B>ERROR. Debe seleccionar un curso para mostrar alumnmos matriculados</B>";  
                 }
                 
             }
             
             
      ?>
      
    </form>
  
  </fieldset>
  
</body> 

</html> 