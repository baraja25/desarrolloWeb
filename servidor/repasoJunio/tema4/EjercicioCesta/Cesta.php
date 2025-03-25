<?php
session_start();

require_once 'DaoProductos.php';

$base="tiendadao";

$daoProd = new DaoProductos("$base");

function InsertaCesta($selec,$solic)
{
   foreach ($selec as $clave=>$valor)
   {
       if (isset($_SESSION['cesta'][$clave]))   //Si ese producto ya estaba en la cesta
       {
           $_SESSION['cesta'][$clave]=$_SESSION['cesta'][$clave]+$solic[$clave];  //Incrementar la cantidad de ese producto con la nueva cantidad pedida   
       }
       else
       {
           $_SESSION['cesta'][$clave]=$solic[$clave]; //Insertamos en la cesta una entrada para ese producto y valor la cantidad
       }
                    
   }
    
}

function MostrarCesta()   //Función que muestra el contenido de la cesta
{
  
   global $daoProd; 
    
   echo "---Contenido de la cesta---<br>";  
   echo "<img src='cesta.jpg' width='80' height='80' >";
    
   echo "<table border='2'>";
   echo "<th>Cod</th><th>Nombre</th><th>Cantidad</th><th>Precio</th>";
   
   foreach ($_SESSION['cesta'] as $clave=>$valor) 
   {
       $pro=$daoProd->obtener($clave);
       
       echo "<tr>";
      
       echo "<td>".$clave."</td>";
       echo "<td>".$pro->__get("nombre")."</td>";
       echo "<td>".$valor."</td>";
       echo "<td>".$pro->__get("PVP")."</td>";
       
       echo "</tr>";
   }
    
   echo "</table>";
   
   echo "<br><br>";
   
   echo "<a href='Pedidos.php'>Continuar Comprando</a>";
   
}

function CantidadesOk($selec,$solic)   //Comprobar que las cantidades de los producto pedidos son correctas
{
    foreach ($selec as $clave=>$valor )   //Para los códigos de los checkbox marcados comprobamos sus cantidades
    {
        if ( ( !is_numeric($solic[$clave] ) ) || ( $solic[$clave]<=0   )   )      
        {
          return false;  
        }
    }
    
    return true; 
      
}





if (isset($_POST['Selec']) )  //Si llegan códigos de productos
{
        $selec=$_POST['Selec'];        //Recogemos los códigos de los productos
        $solic=$_POST['Solicitados'];  //Y sus cantidades
        
        if (CantidadesOk($selec,$solic) )     //Comprobamos que en todos los productos hay alguna cantidad
        {
         InsertaCesta($selec,$solic);   //Insertamos en la cesta los productos marcados y sus cantidades       
        }
        else  //Lo redireccionamos a la página de pedidos 
        {
            
            echo "<b>Inserción no realizada!!!</b></br>";
            echo "<b>Revise las cantidades de los productos solicitados</b>";
            
            echo "<br><br>";
            
            header( "Refresh:3; url=Pedidos.php", true, 303);
            
        }
        
}
    
if (isset($_SESSION['cesta']) )   //Si existe la cesta es porque tiene productos insertados
{
   MostrarCesta(); 
    
}



?>