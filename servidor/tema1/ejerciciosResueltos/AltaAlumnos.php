<html>

<body>

 <?php 
 
 function Guardar($linea,$Archivo)
 {
     $fd=fopen($Archivo,"a+") or die("Error al abrir el archivo $Archivo");
     
     fputs($fd,$linea);
     
     fclose($fd);
     
 }
 
 
 if (isset($_GET['Guardar']) )
 {
     //Recogemos los valores de los campos
     
     $nif=$_GET['NIF'];
     $nombre=$_GET['Nombre'];
     $apellido1=$_GET['Apellido1'];
     $apellido2=$_GET['Apellido2'];
     $edad=$_GET['Edad'];
     $telefono=$_GET['Telefono'];
     
     //Construimos la linea a insertar
     
     $saltoLin="\r\n";
     
     $linea="$nif:$nombre:$apellido1:$apellido2:$edad:$telefono";
     
     $linea.=$saltoLin;  //Le añadimos el salto al final
     
     $Archivo="Alumnos.txt"; //Nombre del archivo donde guardaremos la información
     
     Guardar($linea,$Archivo);
     
     
     
 }
 
 
 
 ?>


 <fieldset> 
      <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        
        NIF<input type="text" name="NIF">      
        Nombre<input type="text" name="Nombre">      
        Apellido1<input type="text" name="Apellido1"><br> 
        Apellido2<input type="text" name="Apellido2">   
        Edad<input type="text" name="Edad"> 
        Telefono<input type="text" name="Telefono"> 
       
        <input type="submit" name="Guardar" value="Guardar">
    
        
    
      </form>

  </fieldset>  
 </body> 
</html> 
 