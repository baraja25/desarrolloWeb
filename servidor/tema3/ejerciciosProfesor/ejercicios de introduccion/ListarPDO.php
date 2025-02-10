<?php

date_default_timezone_set('UTC'); // Aseguramos que use UTC

$host="localhost";

$user="root";

$pass="";

$base="Tema3";

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

$consulta="select * from Alumnos ";

$sta=$pdo->prepare($consulta);

$sta->execute();

$filas=$sta->fetchAll(PDO::FETCH_ASSOC);

echo "<table border='2'>";
echo "<th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Telefono</th><th>Premio</th><th>Fecha Nac</th><th>Foto</th>";

foreach ($filas as $fila)
{
    
   echo "<tr>"; 
    
   foreach($fila as $clave=>$valor)
   {
       if ($clave=="FechaNac")  //Si es la fecha de nacimiento  
       {
          //Tenemos que pasar su valor Epoch a legible                      
           
         $campos=getdate($valor);
           
         echo "<td>$valor   $campos[mday]/$campos[mon]/$campos[year]</td>";
         
       }
       elseif ($clave=="Foto")
       {
           $imagenConte=$valor;   //Extraemos el contenido de la imagen
           
           echo "<td><img src='data:image/jpg;base64,$imagenConte'   width='80' height='80'></td>"; 
           
       }
       else //Si no es la foto ni la fecha de nacimiento
       {
           echo "<td>$valor</td>";
       }
       
   }
       
   echo "</tr>"; 
   
}


echo "</table>";




?>