<!DOCTYPE html>
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

if (isset($_POST['Curso'] ) )
{
    $cur=$_POST['Curso'];
}

$cicl='';

if (isset($_POST['Ciclo'] ) )
{
    $cicl=$_POST['Ciclo'];
}


$opc='';

if (isset($_POST['Opcion'] ) )
{
    $opc=$_POST['Opcion'];
}




?>

<body>
<form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>


<fieldset><legend>Mostrar notas de un módulo</legend>
          
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
            
            <label for='Curso'>Curso </label>
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
          
          <?php
          
          $opciones=array(1=>"Mejor Alumno",2=>"Peor Alumno");
          
          foreach ($opciones as $clave=>$valor)
          {
              echo "<input type='radio' name='Opcion' value=$clave ";
              
              if ($clave==$opc)
              {
                  echo " checked ";
              }
              echo " >$valor";
              
          }
          
      
          ?>
          
             
          <input type='submit' name='Recargar' value='Recargar'>
         
        </fieldset>
                                                                  
    </form>
    
    <?php

     if (isset($_POST['Recargar']) ) //
     {
         echo "<fieldset>";
         
         //Recuperar los módulos de ese ciclo y curso 
         
         $consulta="select Id,Nombre from Modulos where Curso='$cur' and Ciclo=$cicl";
         
         $filas=ConsultaDatos($consulta);
         
         foreach ($filas as $fila)
         {
            echo "<a href='$_SERVER[PHP_SELF]?IdMod=$fila[Id]&Opc=$opc'>$fila[Nombre]</a>";
            echo "<br>";
             
         }
        
         
         echo "</fieldset>";
         
    
     }
    
     
     if (isset($_GET['IdMod']  ) )
     {
         $idmod=$_GET['IdMod'];
         
         $opc=$_GET['Opc'];
         
         echo "<fieldset>";
         
         //Recuperar los módulos de ese ciclo y curso
         
         $consulta="SELECT  a.Apellido1,a.Apellido2,a.Nombre,n.Nota
                    FROM  Notas n,Alumnos a
                    where n.NIF=a.NIF and n.CodMod=$idmod and n.nota in (select ";
                    
                    if ($opc==1)
                    {
                     $consulta.=" max(Nota) ";   
                        
                    }
                    else 
                    {
                     $consulta.=" min(Nota) ";  
                    }
                    
                    
                    $consulta.=" from Notas n2 where n2.CodMod=$idmod);   ";
         
         $filas=ConsultaDatos($consulta);
         
         foreach ($filas as $fila)
         {
             echo $fila['Nombre']." ".$fila['Apellido1']." ".$fila['Apellido2']." ".$fila['Nota'];
             
             echo "<br>";
             
         }
         
         
         echo "</fieldset>";
         
         
         
         
         
     }
     
     
     
    
    ?> 
    
 </body>


    

</html>








