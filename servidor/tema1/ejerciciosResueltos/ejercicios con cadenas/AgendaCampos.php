<html>

<body>

<?php 

function LineasNif($agenda)
{
  $lineasNif=array();
  
  $lineas=explode(",",$agenda);
  
  foreach ($lineas as $clave=>$linea)
  {
      $campos=explode(":",$linea);
      
      $lineasNif[$campos[0]]=$linea;  //Insertamos esa fila en el array lineasNif pero con el Dni de su linea como clave
  }
      
  return $lineasNif;
}


function Actualizar($linea,$agenda)
{
    $lineasNif=LineasNif($agenda);   // Convertimos el string Agenda en un array cuyas claves son los NIF de cada linea
    
    $campos=explode(":",$linea);    //Obtenemos el Nif de esa linea
    
    $nif=$campos[0];
    
    $lineasNif[$nif]=$linea;   //Actualizamos para ese NIf con los valores de la linea 
    
    $agenda=implode(",",$lineasNif);  //Convertimos el array de lineasNif de nuevo en el String Agenda
    
    return $agenda;  //Retornamos la agenda modificada
}

function EstaAgenda($nif,$agenda)   //Funcion que comprueba si el NIF está en la agenda
{
    $lineas=explode(",",$agenda); // Convertimos el string Agenda en un array de lineas
    
    do
    {
        $clave=key($lineas);      //Cogemos la clave actual
        
        $linea=current($lineas);  //Cogemos el valor actual
        
        $campos=explode(":",$linea);   //Ahora convertirmos esa linea en un array de campos
        
        next($lineas);   //Avanzamos a la linea siguiente
        
    } while ( ($nif!=$campos[0] ) && ($linea!==FALSE)     ) ;  //Mientras no encontremos el Nif y haya mas lineas
    
    
    return ($nif==$campos[0] );  // si el bucle ha terminado por encontrar el Nif devolvemos true y a caso contrario false
    
}


/*

function EstaAgenda($nif,$agenda)   //Funcion que comprueba si el NIF está en la agenda
{
  $esta=FALSE;  //Suponemos que no está en la agenda   
    
  $lineas=explode(",",$agenda); // Convertimos el string Agenda en un array de lineas
  
  foreach ($lineas as $clave=>$linea)
  {    
    $campos=explode(":",$linea);   //Ahora convertirmos esa linea en un array de campos
      
    if ($nif==$campos[0] )    
    {
      $esta=TRUE;
      break;  
    }
  
  }
 
 return $esta; 
  
}

*/

function MostrarAgenda($agenda)    //Funcion que muestra en una tabla el contenido de la agenda
{
    $lineas=explode(",",$agenda); // Convertimos el string Agenda en un array de lineas
    
    echo "<table border='2'>";
    echo "<th>Selec</th>";
    echo "<th><a href='$_SERVER[PHP_SELF]?Campo=Dni&Agenda=$agenda'>DNI</a></th>";
    echo "<th><a href='$_SERVER[PHP_SELF]?Campo=Nombre&Agenda=$agenda'>Nombre</a></th>";
    echo "<th><a href='$_SERVER[PHP_SELF]?Campo=Apellido1&Agenda=$agenda'>Apellido1</a></th>";
    echo "<th><a href='$_SERVER[PHP_SELF]?Campo=Apellido2&Agenda=$agenda'>Apellido2</a></th>";
    
    foreach ($lineas as $clave=>$linea)
    {
        echo "<tr>";
        
        $campos=explode(":",$linea);   //Ahora convertirmos esa linea en un array de campos
        
        echo "<td><input type='checkbox' name=Selec[$campos[0]]></td>";
        
        foreach ($campos as $clave=>$campo)  //Mostramos cada campo en un celda diferente
        {
         echo "<td>$campo</td>";
        }
        
        echo "</tr>";
    }
    
    
    echo "</table>";
    
    
}

$agenda="";

if (isset($_GET['Agenda']) )   //si me llegan datos del campo agenda
{
    $agenda=$_GET['Agenda']; //los recupero en la variable local
}

if (  isset($_GET['Borrar']) && (isset($_GET['Selec']))  )  //Si le hemos dado a borrar y seleccionado alguna fila
{
    $selec=$_GET['Selec'];   //Recogemos las filas marcadas
    
    $filasDni=FilasDni($agenda);  //Convertimos la agenda en un array cuyos valores son las filas y claves el dni
    
    foreach ($selec as $clave=>$valor)
    {
        unset($filasDni[$clave]);
        
    }
    
}

if (isset($_GET['Campo']) )   //si me ha llegando un campo de ordenación
{
    //Ordenamos la agenda por ese campo
    
    $campo=$_GET['Campo'];  //Recuperamos el campo de ordenación
    
    $camposOrd=array("Dni","Nombre","Apellido1","Apellido2");
    
    $pos=array_search($campo, $camposOrd);  //Buscamos la posición de ese campo
    
    $filas=explode(",",$agenda);  //Convertimos el string en un array de filas
    
    $filasOrd=array();   //Array donde van a guardarse las filas ordenadas por ese campo 
    
    foreach ($filas as $clave=>$fila)
    {
         $campos=explode(":", $fila);      //Dividimos esa fila en campos   
        
         $filasOrd[$fila]=$campos[$pos];   //Insertamos en el array filas ordenadas una entrada cuya clave es el valor del campo de ordenacion
         
    }
    
    //Ordenar por clave el array creado
    
    asort($filasOrd);  // Ordenamos por clave ascendente
    
    $agenda=implode(",",array_keys($filasOrd));  //Restauramos la agenda con los datos ordenados
}

if (isset($_GET['Guardar']))
{  
    
    $nif=$_GET['NIF'];
    $nombre=$_GET['Nombre'];
    $apellido1=$_GET['Apellido1'];
    $apellido2=$_GET['Apellido2'];
    
    $linea=$nif.":".$nombre.":".$apellido1.":".$apellido2; //Variable que guarda la linea que vamos a insertar en la agenda
    
    if ($agenda=="")       //si la agenda estaba vacia simplemente insertamos la linea
    {
        $agenda=$agenda.$linea;
    }
    else 
    {
        
        if ( !EstaAgenda($nif,$agenda)  )   //Si el nif no esta en la agenda simplemente lo insertamos
        {
         $agenda=$agenda.",".$linea;
        }
        else  //Si el nif de esa linea ya estaba en la agenda
        {
            //echo "El NIF $nif ya existe en la agenda. NO se puede volver a insertar";
            
            $agenda=Actualizar($linea,$agenda);  //Toca actualizar la agenda 
        }
            
    }
}
   
?>

 <fieldset> 
  <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    NIF &nbsp &nbsp &nbsp &nbsp&nbsp<input type="text" name="NIF"><br>
    Nombre&nbsp<input type="text" name="Nombre"><br>      
    Apellido1<input type="text" name="Apellido1"><br>
    Apellido2<input type="text" name="Apellido2"><br>   
    <?php 
    
    echo "<input type='hidden' name='Agenda' value='$agenda'>";
    
    ?> 
    
    
    <input type="submit" name="Guardar" value="Guardar">

    <input type="submit" name="Mostrar" value="Mostrar">
     
    <input type="submit" name="Borrar" value="Borrar">

  </form>

  <?php 
  
  if (isset($_GET['Mostrar']) || ( isset($_GET['Campo'])   ) )   // Si le damos a mostrar u ordenar
  {
      
      $nombres=explode(",",$agenda);  //Convertimos el string en un array de nombres
          
     
      
      if (!empty($agenda)>0 )   //Mostramos cuando tenemos en la agenda algún nombre
      {
       MostrarAgenda($agenda);  
      }
      
  }
  
  
  
  
  ?> 




 </fieldset>   