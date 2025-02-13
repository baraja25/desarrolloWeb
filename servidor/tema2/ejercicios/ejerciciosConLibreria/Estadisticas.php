
<html>

<?php 

require_once 'libreria.php';  

function MostrarTabla($filas)
{
    echo "<fieldset><legend>Resultado de la búsqueda</legend></fieldset>";
    
    echo "<table border='2'>";
    echo "<th>NIF</th>";
    echo "<th>Apellido1</th>";
    echo "<th>Apellido2</th>";
    echo "<th>Nombre</th>";
    echo "<th>Suma Notas</th>";
   
    
    foreach($filas as $fila)
    {
        echo "<tr>";
        
        foreach ($fila as $campo)
        {
            echo "<td>$campo</td>";
        }
        
        echo "</tr>";
        
    }
    
    echo "</table>";
    
    echo "</fieldset>";
}






$opc="";

if (isset($_POST['Opcion']) )
{
    $opc=$_POST['Opcion'];
}

$num="";

if (isset($_POST['Numero']) )
{
    $num=$_POST['Numero'];
}

$susp=1;  //Por defecto indicamos que no muestre los alumnos que NO tengan algún suspenso

if (isset($_POST['Suspensos']) )
{
    $susp=$_POST['Suspensos'];
}




?>


 <fieldset><legend>Seleccione criterios</legend> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
      
      Opcion<select name='Opcion'>
            <option value=''></option>
      
            <?php 
            
            $opciones=array(1=>'Mejores',2=>'Peores');
            
            foreach ($opciones as $clave=>$valor)
            {
              echo "<option value='$clave'  "; 
                
              if ($opc==$clave)
              {
               echo " selected ";   
              }
              
              echo ">$valor</option>";
            }
                
                
            ?>
     
      </select>
      
      Numero<select name='Numero'>
            <option value=''></option>
      
            <?php 
            
            for($i=0;$i<11;$i++)
            {
              echo "<option value='$i'  "; 
                
              if ($num==$i)
              {
               echo " selected ";   
              }
              
              echo ">$i</option>";
            }
                
            ?>
     
      </select>
      
      <b>Con suspensos:</b> 
          <?php 
    
            $opciones=array(1=>'SI',0=>'No');
         
            foreach ($opciones as $clave=>$valor)
            {
              echo "$valor<input type='radio' name='Suspensos' value='$clave' ";
    
              if ($susp==$clave)
              {
                echo " checked ";  
              }
                  
              echo   ">";  
            }
            
            
      
          ?>
                            
                            
      <input type='submit' name='Mostrar' value='Mostrar'>
      
      <?php 
      
      if (isset($_POST['Mostrar']) )
      {
          $consulta="SELECT IdAlum,a.Apellido1,a.Apellido2,a.nombre,sum(Nota) as sumanota
                     FROM Notas n,Alumnos a
                     Where n.IdAlum=a.NIF ";

          if  ($susp==0)  //si tenemos que quitar los que tengan alguna suspenso
          {
            $consulta.=" AND a.NIF NOT IN (select DISTINCT(n2.IdAlum) from Notas n2 where Nota<5) ";   
          }

              
          $consulta.=" GROUP by 1
                     order by sumanota ";
                     
                     if ($opc==1)                   //Si la opción era los mejores
                     {
                        $consulta.=" desc ";        //El orden de la consulta debe ser descendente
                     }
                         
          $consulta.=" limit $num ";
    
          
       
      $filas=ConsultaDatos($consulta);   //Ejecutmamos la consulta
      
      MostrarTabla($filas);              //Mostramos la tabla con los resultados
     
      
      
      }
      
      ?>
          
      
      
       
      </form>    
      
</html>      