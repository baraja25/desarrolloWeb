<?php
require_once("libreria.php");
//funciones
function obtenerMarcas()
{
    $datosObtenidos = array();
    $consulta = "SELECT * FROM marcas";
    $datosObtenidos = consultaDatos($consulta);
    return $datosObtenidos;
}

//inicializacion de variables
$marca = isset($_POST['marcas']) ? $_POST['marcas'] : "";
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <form name="f1" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        Nombre<input type="text" name="nombre"><br>
        Marcas <select name="marcas" onchange="f1.submit();">
            <option value=""></option>
            <?php
            $marcasObtenidas = obtenerMarcas();
            foreach ($marcasObtenidas as $key => $value) {
                echo "<option value='$value[id]' ";
                if ($marca === $marcasObtenidas[0]['id']) {
                    echo " selected ";
                    $imagen = $value['Imagen'];
                }
                echo " >$value[Nombre]</option>";
            }

            ?>
        </select>
        <img src='img/marcas/<?php echo $imagen ?>' width="70" height="70">
        <br>
        Modelo<input type="text" name="modelo"><br>
        Precio<input type="number" name="precio"><br>
        Foto<input type="file" name="foto"><br>
        <?php
        if (isset($_POST['guardar'])) {
            $modelo = $_POST['modelo'];
            $precio = $_POST['precio'];


            if ($_FILES['foto']['name'] != "") {
                $nombreFoto = $_FILES['foto']['name'];
                $nombreTemp = $_FILES['foto']['tmp_name'];

                copy($nombreTemp, "img/vehiculos/$nombreFoto");
            }

            $consulta = "INSERT INTO coches VALUES(null, $nombre, $marca, $modelo, $nombreFoto)";
            consultaSimple($consulta);
        }

        ?>
        <input type="submit" value="Guardar" name="guardar">
    </form>
</body>

</html>