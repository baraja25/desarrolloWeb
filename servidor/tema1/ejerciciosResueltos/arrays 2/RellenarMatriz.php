<html>

<body>
<?php 

$fil=2;
$col=2;

$matriz=array();


function MostrarPosiciones($num,$matriz)
{
   global $fil,$col; 
    
   for($i=0;$i<$fil;$i++) 
   {
       for($j=0;$j<$col;$j++)
       {
           if ($matriz[$i][$j]==$num)
           {
             echo "<br>"; 
             echo "El numero $num esta en la posición fila;".($i+1)." columna: ".($j+1);  
             echo "<br>";  
             
           }
       }
       
   }
}

function DeSerializarMatriz($serializada)
{
    global $matriz,$fil,$col;
    
    $lineal=explode(",",$serializada);   //Convertimos la cadena con los elementos de la matriz original en un array lineal
    
    $cont=0;  //Contador para referenciar a los elementos del array lineal
    
    for($i=0;$i<$fil;$i++)
    {
        for($j=0;$j<$col;$j++)
        {
            $matriz[$i][$j]=$lineal[$cont];   //Asignamos a la matriz bidimensional su elemento correspondiente del array lineal
            $cont++;
            
        }
    }
}

function SeriarlizarMatriz($matriz)   //Funcion que recibe un matriz y la convierte en una cadena de texto
{
    $serializada="";  //Variable que va a guardar una cadena serializada
    
    foreach ($matriz as $clave=>$fila)
    {
        if ($serializada=="") 
        {
          $serializada=$serializada.implode(",",$fila);   
        }
        else 
        {
          $serializada=$serializada.",".implode(",",$fila); 
        }
    
    }
    
    return $serializada;
}

function RellenarMatriz(&$matriz,$fil,$col)
{
    for($i=0;$i<$fil;$i++)
    {
        for($j=0;$j<$col;$j++)
        {
            $matriz[$i][$j]=rand(1,50);
            
        }
        
    }
    
}

function MostrarMatriz($matriz,$fil,$col)
{
  echo "<table border='2'>";  
    
  for($i=0;$i<$fil;$i++)
  {
      echo "<tr>";
      
      for($j=0;$j<$col;$j++)
      {
          echo "<td>".$matriz[$i][$j]."</td>";
          
      }
      
      echo "</tr>";
      
  }
    
  echo "</table>";
}


if (isset($_GET['Filas']) )
{
    $fil=$_GET['Filas'];
}

if (isset($_GET['Columnas']) )
{
    $col=$_GET['Columnas'];
}


?>

 <fieldset> 
  <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    
    
    Filas<select name="Filas">
          <option value=''></option>
          <?php 
          
          for ($i=1;$i<10;$i++)
          {
             echo "<option value=$i ";
              
             if ($i==$fil)
             {
               echo " selected ";  
             }
             
             echo ">$i</option>";
           
          }
          
          ?>
          
        </select><br>
    Columnas<select name="Columnas">
               <option value=''></option>
          <?php 
          
          for ($i=1;$i<10;$i++)
          {
             echo "<option value=$i ";
              
             if ($i==$col)
             {
               echo " selected ";  
             }
             
             echo ">$i</option>";
             
             
          }
          
          
          ?>
   
        </select><br>       

    <input type="submit" name="Crear" value="CrearMatriz"><br>

    <?php 
    
    if (isset($_GET['Crear']) )
    {
        RellenarMatriz($matriz,$fil,$col);
        MostrarMatriz($matriz, $fil, $col);
    
        echo "<br><br>";
        
        //echo creamos el campo texto para guardar la matriz de busqueda
        
        $serializada=SeriarlizarMatriz($matriz);
        
        echo "<input type='hidden' name='MatrizAnt' value='$serializada'>";
        
        echo "<br><br>";
        
        //Mostramos el campo de texto de búsqueda de elementos
   
        echo "Numero a Buscar<input type='number' name='Numero'>";
        
        echo "<input type='submit' name='Buscar' value='Buscar'>";
        
    }
    
    if (isset($_GET['Buscar'])  )
    {
    
        //Recuperamos el número que ibamos a buscar
           
        $num=$_GET['Numero'];
         
        //Recuperar la matriz anterior
    
         $serializada=$_GET['MatrizAnt'];
         
         
         
         
         DeSerializarMatriz($serializada);

        //Mostrar la matriz

         MostrarMatriz($matriz, $fil, $col);
         
        //Mostrar el número a buscar en su campo de texto
        
        echo "Numero a Buscar<input type='number' name='Numero' value='$num'>";
        
        //Recorrer la matriz y mostrar la fila y la columna de las celdas que contengan ese número
        
        MostrarPosiciones($num,$matriz);   // Funcion que muestra las posiciones de este número en la matriz
        
        
        
        
    }
    
   
    ?>

  </form>
   
    

  </fieldset>   
 </body>
</html> 
 
 