<?php

//Parámetros de conexión al servidor

$servidor="localhost";
$usu="root";
$pass="";
$base="Tema2Blobs";

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mover Productos</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
        <table>
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $file = fopen("Productos.txt", "r");
                while (($line = fgets($file)) !== false) {
                    list($producto, $descripcion, $precio) = explode(" :", trim($line));
                    echo "<tr>
                            <td><input type='checkbox' name='productos[]' value='$line'></td>
                            <td>$producto</td>
                            <td>$descripcion</td>
                            <td>$precio</td>
                          </tr>";
                }
                fclose($file);
                ?>
            </tbody>
        </table>
        <br>
        <input type="radio" name="area" value="Area1" required> Area1
        <input type="radio" name="area" value="Area2"> Area2
        <input type="radio" name="area" value="Area3"> Area3
        <br><br>
        <button type="submit" name="mover">Mover</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mover'])) {
        $selectedProducts = $_POST['productos'];
        $selectedArea = $_POST['area'];

        echo "<h2>$selectedArea</h2>";
        echo "<textarea rows='10' cols='50'>";
        foreach ($selectedProducts as $product) {
            echo $product;
        }
        echo "</textarea>";
    }
    ?>
</body>
</html>
?>