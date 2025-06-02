<html>
<?php 

require_once 'libreria.php';

function Primero()
{
    $consulta="SELECT id FROM coche order by id limit 1";
    
    $filas=ConsultaDatos($consulta);
    
    if (count($filas)==1)   //Si me devuelve una sola fila
    {
        $fila=$filas[0];   //La recuperamos
    }
 
   return $fila['id'];    //Devolvemos el id de esa fila 
}

function Ultimo()
{
    $consulta="SELECT id FROM coche order by id desc limit 1";
    
    $filas=ConsultaDatos($consulta);
    
    if (count($filas)==1)   //Si me devuelve una sola fila
    {
        $fila=$filas[0];   //La recuperamos
    }
    
    return $fila['id'];    //Devolvemos el id de esa fila
}

function Siguiente($id)
{
    $sig=$id;
    
    $consulta="SELECT id FROM coche where id>$id limit 1;";
    
    $filas=ConsultaDatos($consulta);
    
    if (count($filas)==1)   //Si me devuelve una sola fila
    {
        $fila=$filas[0];   //La recuperamos
    
        $sig=$fila['id'];
    }
    
    return $sig;    //Devolvemos el id de esa fila
    
  
}

function Anterior($id)
{
    $ant=$id;
    
    $consulta="SELECT id 
               FROM coche 
               where id<$id
               order by id desc
               limit 1 ";
    
 
    $filas=ConsultaDatos($consulta);
    
    if (count($filas)==1)   //Si me devuelve una sola fila
    {
        $fila=$filas[0];   //La recuperamos
        
        $ant=$fila['id'];
    }
    
    return $ant;    //Devolvemos el id de esa fila
    
    
}


$id="";

if (isset($_GET['Id'] ) )  //Si recibimos un id por la URL
{
    $id=$_GET['Id'];

    $consulta="select * from coche where id=$id";  //Obtenemos todos los datos de ese coche  

    $filas=ConsultaDatos($consulta);
    
    if (count($filas)==1)   //Si me devuelve una sola fila
    {
      $fila=$filas[0];   //La recuperamos
    }
}


?> 
  
 <body>
 
    <form name='f1' method='post' action=<?php echo $_SERVER['PHP_SELF'];  ?> >
     Id<input type='text' name='id' value='<?php echo $fila['id'];  ?>'><br>
     Nombre<input type='text' name='nombre' value='<?php echo $fila['nombre'];  ?>'><br>
     Marca<input type='text' name='marca' value='<?php echo $fila['marca'];  ?>'><br>
     Modelo<input type='text' name='modelo' value='<?php echo $fila['modelo'];  ?>'><br>
     Matricula<input type='text' name='matricula' value='<?php echo $fila['matricula'];  ?>'><br>
     Año<input type='text' name='anio' value='<?php echo $fila['anio'];  ?>'><br>
    
     <img src='data:image/jpg;base64,<?php echo $fila['foto'];  ?>'  width='80' height='80'>
    
    
    </form>
 
    <?php 
    
    $primero=Primero();
    
    $ant=Anterior($id);
    
    $sig=Siguiente($id);
    
    $ultimo=Ultimo();
    
    echo "<a href='Detalle.php?Id=$primero'><<</a>&nbsp&nbsp";
    
    echo "<a href='Detalle.php?Id=$ant'><</a>&nbsp&nbsp";
    
    echo "<a href='Detalle.php?Id=$sig'>></a>&nbsp&nbsp";
    
    echo "<a href='Detalle.php?Id=$ultimo'>>></a>&nbsp";
    
    
    
    
    ?> 
 
 </body>
 


</html>
