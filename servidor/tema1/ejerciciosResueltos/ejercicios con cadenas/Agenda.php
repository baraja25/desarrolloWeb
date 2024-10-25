<html>

<body>

<?php 

$agenda="";

if (isset($_GET['Agenda']))   //si me llegan datos del campo agenda
{
    $agenda=$_GET['Agenda']; //los recupero en la variable local
    
}

if (isset($_GET['Guardar']))
{  
    $nombre=$_GET['Nombre'];
    
    if ($agenda=="")
    {
       $agenda=$agenda.$nombre;
    }
    else 
    {
        $agenda=$agenda.",".$nombre;
    }
}
   
?>

 <fieldset> 
  <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
    Nombre<input type="text" name="Nombre">      
    
    <?php 
    
    echo "<input type='hidden' name='Agenda' value='$agenda'>";
    
    ?> 
    
    
    <input type="submit" name="Guardar" value="Guardar">

    <input type="submit" name="Mostrar" value="Mostrar">

  </form>

  <?php 
  
  if (isset($_GET['Mostrar']) )
  {
      $nombres=explode(",",$agenda);  //Convertimos el string en un array de nombres
          
      echo "<table border='2'>";
      echo "<th>Nombre</th>";
      
      foreach ($nombres as $clave=>$valor)
      {
          echo "<tr>";
          
          echo "<td>$valor</td>";
          
          echo "</tr>";
      }
      
      
      echo "</table>";
      
      
  }
  
  
  
  
  ?> 




 </fieldset>   