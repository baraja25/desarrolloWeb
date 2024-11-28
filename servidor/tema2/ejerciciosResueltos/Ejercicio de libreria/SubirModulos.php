
<!DOCTYPE html>
<html>

<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

        <fieldset>
            <legend>Vuelca en archivo Modulos en la BBDD</legend>
            <label for='Archivo'>Archivo</label>
            <input type='text' name='Archivo'> 
          
          
            <input type='submit' name='Volcar' value='Volcar'>
        </fieldset>

    </form>
</body>

<?php 

if (isset($_POST['Volcar']) )
{
    
    $archivo=$_POST['Archivo'];
    
    $archivo.=".txt";  //Añadimos la extensión del archivo
    
    if (file_exists($archivo) )
    {
        $fd=fopen($archivo,"r") or die("Error al abrir el archivo de Ciclos");   //Abrimos el archivo para lectura
        
        mysqli_report(MYSQLI_REPORT_OFF);   //Para desabilitar las excepciones en versiones posteriores a 8.1
        
        $db = mysqli_connect("localhost", "root", "", "Tema2");
        
        
        if (!$db)
        {
            echo("Error de conexión: ".mysqli_connect_error()."<br>");
            echo("Error numero: ".mysqli_connect_errno()."<br>");
            
            exit();
        }
        else //Si me he conectado correctamente
        {
            
            while(!feof($fd) )
            {
                $linea=fgets($fd);
                     
                $campos=explode(" ",$linea);
                
                if (count($campos)==4)
                {
                    $consulta="insert into Modulos values(NULL,'$campos[1]','$campos[2]',$campos[3]);";
                  
                    $resul=mysqli_query($db, $consulta);
            
                }
                            
            }
               
        }
        
        mysqli_close($db);
        
        fclose($fd);
       
        unlink($archivo);
        
    }
    else 
    {
      echo "<b>Error, nombre de archivo incorrecto</b>";
    }
        
    
}






?>



</html>




<?php









?>