<?php

require_once 'libreria.php';
require_once 'Producto.php';

//Obtenemos los productos de la tabla y los guardamos en un array de objetos

$productos=array();  //Array de objetos producto

$consulta="select * from producto ";

$filas=ConsultaDatos($consulta);

//Pasar los datos del array filas al array de objetos producto

$pro = new Producto();

foreach ($filas as $fila)
{
    $pro = new Producto();
    
    $pro->__set("Id", $fila["Id"]);
    $pro->__set("Nombre",  $fila["Nombre"]);
    $pro->__set("Marca",  $fila["Marca"]);
    $pro->__set("Modelo",  $fila["Modelo"]);
    $pro->__set("Precio",  $fila["Precio"]);
    
    $productos[]=$pro;
    
}


//Mostramos los productos del array

foreach ($productos as $producto)
{
    echo $producto->__get("Nombre");
    
    echo "<br>";
    
}
    

?>