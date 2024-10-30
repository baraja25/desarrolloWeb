<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>
    <?php
    function guardarProducto($lineaNueva, $proveedores)
    {


        $fd1 = fopen("Productos.txt", "a+") or die("Error al abrir el archivo de productos");

        $fd2 = fopen("ProveedorProducto.txt", "a+") or die("Error al abrir el archivo de relacion");

        $productoNuevo = explode(":", $lineaNueva);

        while (!feof($fd1)) {
            $lineaProductosViejos = fgets($fd1);


            $productosViejos = explode(":", $lineaProductosViejos);


            foreach ($productosViejos as $key => $value) {
                if ($productoNuevo[0] === $productosViejos[0]) {
                    echo "Ya existe el producto";
                } else {
                    fputs($fd1, $lineaNueva);
                }
            }

        }

        fclose($fd1);
        fclose($fd2);
    }

    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" name="f1">
        <h1>Registro del producto</h1>
        <label for="idproducto">Id del producto</label>
        <input type="number" name="idproducto" id="idproducto">
        <br>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <label for="marca">Marca: </label>
        <input type="text" name="marca" id="marca">
        <br>
        <label for="modelo">Modelo: </label>
        <input type="text" name="modelo" id="modelo">
        <br>
        <label for="precio">Precio: </label>
        <input type="number" name="precio" id="precio">
        <br>
        <h2>Proveedores: </h2>
        <?php
        function ObtenerProveedor()
        {
            $proveedor = array();   //Array con las lineas del archivo

            $fd = fopen("Proveedores.txt", "r") or die("Error al abrir el archivo");

            //Mostramos el contenido del archivo

            while (!feof($fd))     //Mientras No  llegado al fin del archivo
            {
                $linea = fgets($fd); //Extraemos una linea de ese archivo

                $campos = explode(":", $linea); //Separamos la linea en campos

                if (count($campos) == 2) {
                    $proveedor[$campos[0]] = $campos[1];
                }
            }

            fclose($fd);

            return $proveedor;
        }

        $proveedores = ObtenerProveedor();

        // Itera sobre el arreglo de aficiones para crear casillas de verificación
        foreach ($proveedores as $key => $value) {
            // Crea una casilla de verificación para cada proveedor
            echo "<input type='checkbox' name='proveedores[$key]'>$value<br>";
        }
        ?>

        <input type="submit" value="Guardar" name="guardar">
        <input type="submit" value="Mostrar Productos" name="mostrar">

        <?php
        if (isset($_GET['guardar']) && (isset($_GET['proveedores']))) {
            $id = $_GET['idproducto'];
            $nombre = $_GET['nombre'];
            $marca = $_GET['marca'];
            $modelo = $_GET['modelo'];
            $precio = $_GET['precio'];
            $proveedorescheck = $_GET['proveedores'];
            $linea = "$id:$nombre:$marca:$modelo:$precio";
            guardarProducto($linea, $proveedorescheck);
        }


        ?>

    </form>
</body>

</html>