<html>
<?php 
require_once 'ProductoSesi.php';

session_start(); //Iniciamos sesión


if ( isset($_POST['Vaciar']) )
{
    unset($_SESSION['Productos']);   //Eliminamos todos los productos de la sesión
}
    
if ( isset($_POST['Borrar']) && isset($_POST['Selec']) )
{
    $selec=$_POST['Selec'];

    foreach ($selec as $clave=>$valor)
    {
        unset($_SESSION['Productos'][$clave]); 
    }
}
    
if (isset($_POST['Actualizar']) && isset($_POST['Selec']) )
{

    $selec=$_POST['Selec'];
    
    $nombres=$_POST['Nombres'];
    $marcas=$_POST['Marcas'];
    $precios=$_POST['Precios'];
   
    
    foreach ($selec as $clave=>$valor)   //Actualizamos las propiedaes de los objetos seleccionados
    {
        $_SESSION['Productos'][$clave]->__set("Nombre",$nombres[$clave]);
        $_SESSION['Productos'][$clave]->__set("Marca",$marcas[$clave] );
        $_SESSION['Productos'][$clave]->__set("Precio",$precios[$clave]);
        
    
    }
    
    
}
    

if (isset($_POST['Insertar']) )
{
   $id=$_POST['Id'];
   $nombre=$_POST['Nombre'];
   $marca=$_POST['Marca'];
   $precio=$_POST['Precio'];
    
   $pro= new ProductoSesi();  //Creamos un objeto producto sesión
   
   $pro->__set("Id", $id);
   $pro->__set("Nombre", $nombre);
   $pro->__set("Marca", $marca);
   $pro->__set("Precio", $precio);
   
   if ( isset($_SESSION['Productos'][$id]))
   {
     echo "<b>Error, el producto con ese Id ya existe en la sesión</b>";  
   }
   else 
   {
    $_SESSION['Productos'][$id]=$pro;   //Guardamos ese obejeto en la sesión
   }
     
}


?>



 <body>
    <form name='f1' method='post' action='<?php $_SERVER['PHP_SELF']; ?>'   >
       <fieldset><legend>Productos en Sesión</legend> 
        
          ID<input type='text' name='Id' size='4'>
          Nombre<input type='text' name='Nombre'>
          Marca <input type='text' name='Marca'>
          Precio<input type='number' name='Precio'>
                     
          <input type='submit' name='Insertar' value='Insertar'>
          <input type='submit' name='Mostrar' value='Mostrar'>
          <input type='submit' name='Borrar' value='Borrar'>
          <input type='submit' name='Vaciar' value='Vaciar'>
           
        
        
       </fieldset> 
  
  <?php 
   
  if (isset($_POST['Mostrar']) )
  {
       
      if (isset($_SESSION['Productos']) )   //Si hay productos en la sesión
      {  
              echo "<fieldset>"; 
              
              echo "<table border='2'>";
              echo "<th>Selec</th><th>Id</th><th>Nombre</th><th>Marca</th><th>Precio</th>";
              
              foreach ($_SESSION['Productos'] as $clave=>$pro)
              {
                echo "<tr>";
                  
                echo "<td><input type='checkbox' name=Selec[".$pro->__get("Id")."]></td>";
                echo "<td>".$pro->__get("Id")."</td>";
                echo "<td><input type='text' name=Nombres[".$pro->__get("Id")."] value='".$pro->__get("Nombre")."'></td>";
                echo "<td><input type='text' name=Marcas[".$pro->__get("Id")."] value='".$pro->__get("Marca")."'></td>";
                echo "<td><input type='text' name=Precios[".$pro->__get("Id")."] value='".$pro->__get("Precio")."'></td>";
                
                echo "</tr>";  
              }
              
              echo "</table>";
              
              echo "<input type='submit' name='Actualizar' value='Actualizar'>";
              
              echo "</fieldset>";
          }
    
  }
   
   
  ?>  
 
  <body>     
</html>       
