<!DOCTYPE html>
<html>

<?php 

require_once 'libreria.php';


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

function ObtenerModulos()
{
    
    $modulos=array();
   
    $consulta="select * from Modulos";
    
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
          
          <label for='Modulo'>Módulo </label>
          <select name='Modulo'>
            <option value=''></option>
            <?php 
          
            
            $modulos=ObtenerModulos();   //Obtenemos los paises
            
            foreach ($modulos as $clave=>$fila)
            {
                echo "<option value='$clave' ";
                
                if (  $mod==$clave)
                {
                    echo " selected ";
                }
                
             
                echo "> $fila[Nombre] </option>";
                
            }
            
            ?>
              
          </select>
          
          
          <label for='Nota'>Nota </label>
          <select name='Nota'>
            <option value=''></option>
            <?php 
          
            
            for ($i=0;$i<11;$i++ )
            {
                echo "<option value='$i' ";
                
                if (  $nota==$i)
                {
                    echo " selected ";
                }
                
                echo "> $i </option>";
                
            }
            
            ?>
              
          </select>
          
          <input type='submit' name='Calificar' value='Calificar'>
         
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
