<html>
<?php 

require_once 'libreria.php';


$num=1;

if (isset($_POST['Numero']) )
{
   $num=$_POST['Numero'];
}

$opc=1;

if (isset($_POST['Opcion']) )
{
    $opc=$_POST['Opcion'];
}



?>


<body>

 <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'> 
     <fieldset><legend>Estadísticas de Alumno</legend>
     <label for='Curso'>Opción:</label>
       
        <?php 
        
        $opciones=array(1=>"Mejores",2=>"Peores");
        
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
     
        
      <br>
      
      <label for='Numero'>Numero </label>
          <select name='Numero'>
            <?php 
          
            
            for ($i=0;$i<21;$i++ )
            {
                echo "<option value='$i' ";
                
                if (  $num==$i)
                {
                    echo " selected ";
                }
                
                echo "> $i </option>";
                
            }
            
            ?>
              
          </select>
     
       <input type='submit' name='Filtrar' value='Filtrar'>
     
     
      </fieldset> 
      
      <?php 
      
      if (isset($_POST['Filtrar']) )
      {
         
          $consulta="SELECT n.NIF,a.Apellido1,a.Apellido2,a.Nombre,sum(Nota) as suma
                     from Notas n, Alumnos a
                     where n.NIF=a.NIF
                     group by NIF
                     order by suma ";
               
          if ($opc==1)
          {
             $consulta.=" DESC ";
          }
          
      
        $consulta.=" limit $num";  
      
       
        $filas=ConsultaDatos($consulta);  
          
        echo "<fieldset><legend>Resultado de la consulta</legend>";  
        
        echo "<table border='2'>";
        echo "<th>NIF</th><th>Apellido1</th><th>Apellido2</th><th>Nombre</th><th>Suma Notas</th>";
        
        foreach ($filas as $fila)
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
       
      ?>
       
     </form>  
  </body>  
</html>  