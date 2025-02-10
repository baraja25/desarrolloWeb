<html>

<?php

date_default_timezone_set('UTC'); // Aseguramos que use UTC

$host="localhost";

$user="root";

$pass="";

$base="tema3";

try
{
    $pdo=new PDO("mysql:host=$host;dbname=$base",$user,$pass);
    
    //Para que genere excepciones a la hora de reportar errores.
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

$consulta="select * from Alumnos  ";

$param=array();

$sta=$pdo->prepare($consulta);

$sta->execute();

$filas=$sta->fetchAll(PDO::FETCH_ASSOC);

?>

 <body>
   
     
        <?php 
        
        echo "<fieldset><legend>Alta de Nuevo Alumno</legend>";
        
        echo "<form name='f1' method='post' action='Acciones.php' enctype='multipart/form-data'  >";
        
        echo "NIF<input type='NIF' name='NIF'>";
        echo "Nombre<input type='Nombre' name='Nombre'>";
        echo "Apellido1<input type='Nombre' name='Apellido1'>";
        echo "Apellido2<input type='Nombre' name='Apellido2'><br>";
        echo "Telefono<input type='Nombre' name='Telefono'>";
        echo "Premios<input type='Nombre' name='Premios'>";
        echo "FechaNac<input type='Nombre' name='FechaNac'><br>";
               
        echo "<input type='file' name='Foto'><br>"; 
        
        echo "<input type='submit' name='Alta' value='Alta'>";
        
        
        echo "</form>";  
        
        
        echo "</fieldset>";        
        
        
        echo "<fieldset>";
        
        echo "<table border='2'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Telefono</th><th>Premio</th><th>Fecha Nac</th><th>Foto</th><th>Acciones</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        foreach ($filas as $fila) 
        {
            echo "<tr>";
            
            foreach($fila as $clave=>$valor) 
            { 
              if ($clave=="FechaNac")   
              {
                $campos=getdate($valor); 

                $valor=$campos['mday']."/".$campos['mon']."/".$campos['year'];

                echo "<td>$valor</td>";

              }
              elseif ($clave=="Foto") 
              {
                $imagenConte=$fila['Foto'];   //Extraemos el contenido de la imagen
          
                echo "<td><img src='data:image/jpg;base64,$imagenConte'   width='80' height='80'></td>";


              }
              else
              {
                echo "<td>$valor</td>";
              } 



            }    
            echo "<td>";

               echo "<form name='f$fila[NIF]' method='post' action='Acciones.php' enctype='multipart/form-data'  >";
             
                echo "<input type='submit' name='Actualizar' value='Actualizar'>";
                echo "<input type='submit' name='Borrar' value='Borrar'>";
                echo "<input  type='hidden' name='NIF' value='$fila[NIF]'>";

              echo "</form>";  
            
            echo "</td>";
            

            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";


        echo "</fieldset>"; 
            
            ?>
            
           
   
 </body>
</html>

