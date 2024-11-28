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
            echo "<a href='$_SERVER[PHP_SELF]?IdMod=$fila[Id]'>$fila[Nombre]</a>";
            echo "<br>";
             
         }
        
         
         echo "</fieldset>";
         
    
     }
    
     
     if (isset($_GET['IdMod']  ) )
     {
         $idmod=$_GET['IdMod'];
         
         echo "<fieldset>";
         
         //Recuperar los módulos de ese ciclo y curso
         
         $consulta="select a.Nombre,a.Apellido1,a.Apellido2,n.Nota
                    from Notas n, Alumnos a
                    where CodMod=$idmod and n.NIF=a.NIF
                    order by Apellido1,Apellido2  ";
         
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








