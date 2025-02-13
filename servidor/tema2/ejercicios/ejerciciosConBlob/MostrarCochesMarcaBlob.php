
<html>

<?php 

require_once 'libreria2.php';

function FotosComplem($IdCoche)      //Funcion que muestra las fotos complementarias de un coche 
{
    $salida="";
    
    $consulta=" SELECT IdImagen,Imagen
                FROM ImagenCoche
                Where IdCoche=$IdCoche";
    
    $filas=ConsultaDatos($consulta);
    
    foreach ($filas as $fila)
    {
        $imagenConte=$fila['Imagen'];
        
        $salida.="<img src='data:image/jpg;base64,$imagenConte'   width='80' height='80'>"; 
    }
    
   return $salida; 
}


?>


 <body>
  <fieldset> 
      <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>" enctype='multipart/form-data'  >
        
       <?php 
       
       $consulta="select * from Marcas";
       
       $filas=ConsultaDatos($consulta);
       
       echo "<table border='2'>";
     
       echo "<tr>"; 
       
       foreach ($filas as $fila)
       {
          $imagenConte=$fila['Imagen'];
           
          echo "<td><a href='$_SERVER[PHP_SELF]?Marca=$fila[Id]'><img src='data:image/jpg;base64,$imagenConte'   width='80' height='80'> </a></td>"; 
          
       }
       
       echo "</tr>";
       
       echo "</table>";
       
       
       if (isset( $_GET['Marca']) )   //Si recibimos por la URL un Id de marca
       {
           $IdMarca=$_GET['Marca'];
           
           $consulta=" SELECT c.Id,c.Nombre,m.Nombre as Marca,c.Modelo,c.Precio,c.Foto
                       FROM Coches c,Marcas m 
                       where c.Marca=m.Id AND c.Marca=$IdMarca ";
           
           $filas=ConsultaDatos($consulta);
           
           echo "<table border='2'>";
           echo "<th>Id</th><th>Nombre</th><th>Marca</th><th>Modelo</th><th>Precio</th><th>Imagen</th>";
           
           foreach ($filas as $fila)
           {
             echo "<tr>";  
               
             foreach ($fila as $clave=>$campo)
             {
                 if ($clave=="Foto")  //La clave corresponde al nombre del campo
                 {
                  echo "<td>";
                  
                  $imagenConte=$fila['Foto'];
                  
                  echo "<img src='data:image/jpg;base64,$imagenConte'   width='80' height='80'> ";
                 
                  $salida=FotosComplem($fila['Id']);
                  
                  echo $salida;
                  
                  echo "</td>";
                 
                 }
                 else 
                 {
                     echo "<td>$campo</td>";
                 }
             }
             
             echo "</tr>";
           }
           
           echo "</table>";
           
       }
       
       ?> 
       
      </form>

  </fieldset>  
 </body> 
</html> 