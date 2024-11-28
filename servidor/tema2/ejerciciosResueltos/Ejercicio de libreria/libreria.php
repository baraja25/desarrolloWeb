<?php

//Parámetros de conexión al servidor

$servidor="localhost";
$usu="root";
$pass="";
$base="Tema2";

//Conectar con la BBDD

function Conectar()
{
    global $servidor;
    global $usu;
    global $pass;
    global $base;
    
    
    mysqli_report(MYSQLI_REPORT_OFF);  //Desactivar el display de excepciones
    
    $db = mysqli_connect($servidor, $usu, $pass, $base);
   
    if (mysqli_connect_errno()) 
    {
        echo('mysqli connection error: ' . mysqli_connect_error());
        exit();
    }
    
    return $db;   
}


//Ejecutar consultas simples(no devuelven filas)

function ConsultaSimple($consulta)
{
    $db=Conectar();   //Nos conectamos con la BBDD
    
    $resul=mysqli_query($db, $consulta);
    
    if (!$resul)   //Si hay un resultado correcto
    {
        echo "Error en la consulta:".mysqli_error($db);
        
    }
    
    Cerrar($db);
    
}


//Ejecutar consultas devuelven datos(devuelven filas)


function ConsultaDatos($consulta)
{
    $db=Conectar();   //Nos conectamos con la BBDD
    
    $resul=mysqli_query($db, $consulta);
    
    $filas=array();  //Inicializamos el array de filas
    
    if (!$resul)   //Si hay un resultado correcto
    {
        echo "Error en la consulta:".mysqli_error($db);
        
    }
    else 
    {
        while ( ($fila=mysqli_fetch_assoc($resul))!=null  )
        {
            $filas[]=$fila;  //Guardos esa fila en el array
            
        }
          
    }
        
    Cerrar($db);
    
  return $filas;  
}





//Cerrar la conexión

function Cerrar($db)
{
    mysqli_close($db);
    
}







?>