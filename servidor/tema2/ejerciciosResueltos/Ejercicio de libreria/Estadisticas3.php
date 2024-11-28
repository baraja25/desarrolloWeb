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
     <fieldset><legend>Estadísticas de Alumnos III</legend>
     <label for='Curso'>Opción:</label>
       
        <?php 
        
        $opciones=array(1=>"Aprobado",2=>"Suspendido");
        
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
      
     
     
       <input type='submit' name='Filtrar' value='Filtrar'>
     
     
      </fieldset> 
      
      <?php 
      
      if (isset($_POST['Filtrar']) )
      {
         
          $consulta=" SELECT n.NIF,a.Apellido1,a.Apellido2,a.Nombre,COUNT(*) as cuenta
                     from Notas n, Alumnos a
                     where n.Nota ";
               
          if ($opc==1)
          {
             $consulta.=" >= ";
          }
          else
          {
             $consulta.=" < ";
          }
      
        $consulta.=" 5 and n.NIF=a.NIF
                       GROUP by NIF
                       HAVING cuenta in (select COUNT(*) as total from Modulos) ";  
      
        //echo $consulta;
        
        $filas=ConsultaDatos($consulta);  
          
        echo "<fieldset><legend>Resultado de la consulta</legend>";  
        
        echo "<table border='2'>";
        echo "<th>NIF</th><th>Apellido1</th><th>Apellido2</th><th>Nombre</th>";
        
        if ($opc==1)
        {
           echo "<th>Numero Aprobados</th>";
        }
        else
        {
            echo "<th>Numero Suspensos</th>";
        }
        
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