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


function ObtenerAlumnos()
{
   
        $consulta="select * from Alumnos";
        
        $alumnos=array();
        
        $filas=ConsultaDatos($consulta);
        
        foreach ($filas as $fila)
        {
                $alumnos[$fila['NIF']]=$fila;
                
        }
            
    return $alumnos;
    
}

function ObtenerModulos($cur,$cicl)
{
    
    $modulos=array();
   
    $consulta="select * from Modulos where Curso=$cur and Ciclo=$cicl";
    
    $filas=ConsultaDatos($consulta);
    
    foreach ($filas as $fila)
    {
        $modulos[$fila['Id']]=$fila;
        
    }
    
    return $modulos;
    
}


$alu='';

if (isset($_POST['Alumno']) )
{
    $alu=$_POST['Alumno'];   
}

$mod='';

if (isset($_POST['Modulo']) )
{
    $mod=$_POST['Modulo'];
}

$nota='';

if (isset($_POST['Nota']) )
{
    $nota=$_POST['Nota'];
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

        
        <fieldset><legend>Poner notas a un alumno</legend>
        
          <label for='Alumno'>Alumno </label>
          <select name='Alumno'>
            <option value=''></option>
            <?php 
          
            
            $alumnos=ObtenerAlumnos();   //Obtenemos los paises
            
            foreach ($alumnos as $clave=>$fila)
            {
                echo "<option value='$clave' ";
                
                if (  $alu==$clave)
                {
                    echo " selected ";
                }
                
             
                echo ">$fila[Apellido1] $fila[Nombre] </option>";
                
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
            
            <?php 
            
             if ($cur!='' && $cicl!='')        //Si hay seleccinado un ciclo y un curso
             {
                 //Mostramos los módulos para ese ciclo
                 
                echo "<br>"; 
                 
                echo "<label for='Modulo'>Módulo </label>";
                echo    "<select name='Modulo'>";
                echo     " <option value=''></option>";
                  
                 $modulos=ObtenerModulos($cur,$cicl);   //Obtenemos los paises
                 
                 foreach ($modulos as $clave=>$fila)
                 {
                     echo "<option value='$clave' ";
                     
                     if (  $mod==$clave)
                     {
                         echo " selected ";
                     }
                     
                     
                     echo "> $fila[Nombre] </option>";
                     
                 }
                 
                 echo "</select>";   
                 
                 echo "<label for='Nota'>Nota </label>";
                 echo    "<select name='Nota'>";
                 echo       "<option value=''></option>";
           
                         for ($i=0;$i<11;$i++ )
                         {
                             echo "<option value='$i' ";
                             
                             if (  $nota==$i)
                             {
                                 echo " selected ";
                             }
                             
                             echo "> $i </option>";
                             
                         }
                 
                 echo  "</select>";
 
                 echo "<input type='submit' name='Calificar' value='Calificar'>";
             
             }
                     
            ?>
            
          <input type='submit' name='Recargar' value='Recargar'>
         
        </fieldset>
                                                                  
    </form>
</body>

<?php

if (isset($_POST['Calificar']) ) //
{
 
       $consulta="select count(*) as cuenta from Notas where NIF='$alu' and CodMod=$mod "; 
        
       $filas=ConsultaDatos($consulta);
       
       $fila=$filas[0];  //Recogemos la fila que devuelve, solo puede devolver una la fila 0
       
       
       if ($fila['cuenta']==1)    //Ya había una nota para ese alumno en ese módulo y hay que actualirla
       {
           
         $consulta="update Notas set Nota=$nota   where NIF='$alu' and CodMod=$mod";  
           
       }
       else //NO había una nota para ese alumno en ese módulo y hay que insertar
       {
          
          $consulta="insert into Notas values('$alu',$mod,$nota) ";   ;  
       }
           
       
       ConsultaSimple($consulta);
       
          
}

?>




</html>
