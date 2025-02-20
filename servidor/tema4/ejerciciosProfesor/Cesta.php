<?php
session_start();

require_once 'DaoProductos.php';

$base="tienda";

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





if (!isset($_SESSION['cesta']) )  //Si todavia no se ha creado la variable cesta
{
    if (isset($_POST['Selec']) )  //Si llegan códigos de productos
    {
        $selec=$_POST['Selec'];        //Recogemos los códigos de los productos
        $solic=$_POST['Solicitados'];  //Y sus cantidades
        
        InsertaCesta($selec,$solic);   //Insertamos en la cesta los productos marcados y sus cantidades       
    }
    
    
    


    
    
    
}





?>