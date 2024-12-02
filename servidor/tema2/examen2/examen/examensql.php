<?php
//funciones


/* Funcion que autoincrementa el id de un producto */
function autoIncrementarId()
{
    $productos = array();
    $consultaProductos = "SELECT Id FROM producto ORDER BY Id DESC LIMIT 1";
    $productos = consultaDeDatos($consultaProductos);
    foreach ($productos as $producto) {
        $producto['Id'] += 1;
    }
    return $producto['Id'];
}


//importacion de funciones
require_once "libreria.php";
//declaracion de variables
$opc = isset($_POST['marca']) ? $_POST['marca'] : "";
$opciones = array();
$categorias  = array();
$id = autoIncrementarId();
$categoriaElegida = isset($_POST['categoriaElegida']) ? $_POST['categoriaElegida'] : [];
$nombreProducto = isset($_POST['nombreProducto']) ? $_POST['nombreProducto'] : "";
$modeloProducto = isset($_POST['modeloProducto']) ? $_POST['modeloProducto'] : "";
$precioProducto = isset($_POST['precioProducto']) ? $_POST['precioProducto'] : 0;
$operacionSQL = isset($_POST['operacionSQL']) ? $_POST['operacionSQL'] : "";
$busquedaId = isset($_POST['busquedaId']) ? $_POST['busquedaId'] : "";
//consulta de las marcas de los dipositivos
$consultaMarca = "SELECT Id, Nombre FROM marcas";
$opciones = consultaDeDatos($consultaMarca);
$consultaCategoria = "SELECT * FROM categoria";
$categorias = consultaDeDatos($consultaCategoria);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Examen ejericio tema 2</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="f1">
        <input type="radio" name="operacionSQL" value="1" onchange="f1.submit()" checked> Insertar
        <input type="radio" name="operacionSQL" value="2" onchange="f1.submit()"> Buscar
        <br>
        
        Nombre del producto: <input type="text" name="nombreProducto"><br>
        <?php 
        if ($operacionSQL == 2) {
            echo "Ingrese ID: <input type='number' name='busquedaId'><br>";
            echo "<input type='submit' value='Buscar' name='buscar'><br>";
        }
        
        ?>
        Modelo: <input type="text" name="modeloProducto"><br>
        Precio: <input type="number" name="precioProducto"><br>
        Marca: <select name="marca">
            <option value=""></option>

            <?php

            // despegable que da a elegir las marcas
            foreach ($opciones as $opcion) {
                echo "<option value='$opcion[Id]' ";

                if ($opc == $opcion['Id']) {
                    echo " selected ";
                }
                echo ">$opcion[Nombre]</option>";
            }
            ?>
        </select>
        <fieldset>

            <legend>Categorias</legend>
            <?php
            //Mostrar las categorias que hay
            foreach ($categorias as $categoria) {
                echo "<input type='checkbox' name='categoriaElegida[]' value='$categoria[Id]'> $categoria[Nombre]<br>";
            }

            ?>
        </fieldset>
        <input type="submit" value="Insertar" name="insertar">
        <?php
        //Hace la insercion si se ha pulsado el boton y esta elegida la opcion de insertar
        if (isset($_POST['insertar']) && $operacionSQL == 1) {
            // si hay algun campo vacio no inserta
            if ($nombreProducto == "" || $modeloProducto == "" || $precioProducto == 0) {
                echo "No puede haber campos vacios";
            } else {
                //inserta los datos
                $consultaInsertar = "INSERT INTO `producto` 
                (`Id`, `Nombre`, `Marca`, `Modelo`, `Precio`) VALUES 
                ($id, '$nombreProducto', $opc, '$modeloProducto' , $precioProducto);";
                consultaSimple($consultaInsertar);
                // Insertar los datos de los checkbox
                foreach ($categoriaElegida as $key => $value) {
                    $insert = "INSERT INTO prodcatego (IdPro, IdCat) VALUES (($id-1), $key);";
                    consultaSimple($insert);
                }
                echo "Datos introducidos correctamente";
            }
        }
        //TODO: sacar la id del producto en un array y colocar sus datos en los inputs
        if (isset($_POST['buscar']) && $busquedaId != "") {
            
        }

        ?>
    </form>
</body>

</html>