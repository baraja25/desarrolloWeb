<html>

<body>

 <?php 
 
 function MostrarForm($lineaAlu)
 {
    $campos=explode(":",$lineaAlu);
    
       echo "<form name='f1' method='get' action='$_SERVER[PHP_SELF]' ";
        
       echo " NIF<input type='text' name='NIF' value='$campos[0]'><br>  ";
       echo " Nombre<input type='text' name='Nombre' value='$campos[1]'><br>";
       echo " Apellido1<input type='text' name='Apellido1' value='$campos[2]'><br>";
       echo " Apellido2<input type='text' name='Apellido2' value='$campos[3]'><br>";
       echo " Edad<input type='text' name='Edad' value='$campos[4]'><br>";
       echo " Telefono<input type='text' name='Telefono' value='$campos[5]'><br>"; 
    
       
       echo "<input type='submit' name='Actualizar' value='Actualizar'>";
       
     echo "</form>";
     
     
 }
 
 
 function ObtenerAlumnos()
 {
     $alumnos=array();   //Array con las lineas del archivo
     
     $fd=fopen("Alumnos.txt","r") or die("Error al abrir el archivo");
     
     //Mostramos el contenido del archivo
     
     while(!feof($fd) )     //Mientras No  llegado al fin del archivo
     {
         $linea=fgets($fd); //Extraemos una linea de ese archivo
         
         $campos=explode(":",$linea); //Separamos la linea en campos
         
         if (count($campos)==6 )   //Solo queremos la lienas con los 6 campos del alumno
         {
          $alumnos[$campos[0]]=$linea; //Guardamos ese linea en el array de alumnos
         }
     }
     
     fclose($fd); 
     
     return  $alumnos;
 }
 
 
 $alu='';
 
 if (isset($_GET['Alumno']) )
 {
     $alu=$_GET['Alumno'];
 }
 
 
 ?>


 <fieldset><legend>Seleccione un alumno para mostrar su ficha</legend> 
    
 
      <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        
        Alumno<select name="Alumno">
                <option value=''></option> 
               
                <?php 
                
                //Recuperamos los datos los alumnos
                
                $alumnos=ObtenerAlumnos();  //Obtenemos los alumnos del archivo
                
                foreach ($alumnos as $clave=>$alumno)
                {
                    $campos=explode(":",$alumno);
                    
                    echo "<option value='$campos[0]'  ";

                    if ($alu==$campos[0])
                    {
                      echo " selected ";  
                    }
                    echo ">$campos[2],$campos[1]</option>";
                    
                    
                }
                
                
                ?>
        
        
              </select>
       
        <input type="submit" name="Seleccionar" value="Seleccionar">
    
      </form>

  </fieldset>  
    
        <?php 
        
        if (isset($_GET['Seleccionar']) )
        {
           echo "<fieldset><legend>Ficha del alumno seleccionado</legend>";
           
           if ($alu!="")  // si el Dni el alumno no es vacio
           {
            MostrarForm($alumnos[$alu]);  //Función que muestra un formulario con los datos de ese alumno
           }
           echo "</fieldset>";   
        }
        
        
        
        
        
        
        
        
        
        
        ?>
    
    
        
    
    
 </body> 
</html> 
 