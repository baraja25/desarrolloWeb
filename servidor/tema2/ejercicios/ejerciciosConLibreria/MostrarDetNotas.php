<html>
<?php 

require_once 'libreria.php';  

function  ObtenerNotas($nif)    //Función que muestra una tabla con las notas de ese alumno  
{
   $consulta=" select m.Nombre,n.Nota
               from Notas n, Modulos m
               where n.IdAlum='$nif' and m.Id=n.IdMod
               order by 2 desc";
   
   $filas=ConsultaDatos($consulta);
    
   
   
  return $filas; 
   
}






$nif="";

if (isset($_GET['NIF']) )
{
    $nif=$_GET['NIF'];
}


?>

 <body>

 <fieldset><legend>Seleccione alumno</legend> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">
       
       <?php 
       
        $consulta="select NIF,Nombre,Apellido1,Apellido2  from Alumnos where 1 ";
    
        if ($nif!="")     
        {
            $consulta.=" AND NIF='$nif' ";
        }
            
        $consulta.=" order by 3,4,1";    
       
        $filas=ConsultaDatos($consulta);
       
        echo "<table border='2'>";
        echo "<th>Alumno</th>";
        
        foreach ($filas as $fila)
        {
            echo "<tr>";
            
            
            
            echo "<td><a href='$_SERVER[PHP_SELF]?NIF=$fila[NIF]'>$fila[Apellido1] $fila[Apellido2],$fila[Nombre]</a></td>";  
           
            echo "</tr>";
            
        }
       
        echo "</table>";
        
        //Mostramos las notas de ese alumno
         
        $filas=ObtenerNotas($nif);  
        
        echo "<table border='2'>";
        echo "<th>Modulo</th><th>Nota</th>";
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
        
                
        echo "<a href='$_SERVER[PHP_SELF]'>Volver</a>";
        
       ?>
     
    </fieldset>
</html>    
      