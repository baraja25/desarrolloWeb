<?php
// conexion con base de datos
$host = "localhost";

$user = "root";

$pass = "";

$base = "tema2";

$db = mysqli_connect($host, $user, $pass, $base);

/* Funciones */
function obtenerPaises()
{
    global $db;

    $consulta = "select * from paises";

    $resultado = mysqli_query($db, $consulta);

    if ($resultado) {
        $filas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        echo mysqli_error($db);
    }

    return $filas;
}

function obtenerProvincias($pais)
{
    global $db;

    $consulta = "select * from provincias where IdPais = '$pais'";

    $resultado = mysqli_query($db, $consulta);

    if ($resultado) {
        $filas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        echo mysqli_error($db);
    }

    return $filas;
}

function obtenerLocalidades($pais, $provincia)
{
    global $db;

    $consulta = "select * from localidades where IdPais = $pais and IdProvincia = $provincia";

    $resultado = mysqli_query($db, $consulta);

    if ($resultado) {
        $filas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    } else {
        echo mysqli_error($db);
    }

    return $filas;
}

//inicializacion
$pais = "";

//obtener paises 
if (isset($_POST['pais'])) {

    $pais = $_POST['pais'];
}

$provincia = "";

//obtener provincia
if (isset($_POST['provincia'])) {

    $provincia = $_POST['provincia'];
}

$localidad = "";

//obtener localidad
if (isset($_POST['localidad'])) {

    $localidad = $_POST['localidad'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="f1">
        pais: <select name="pais" onchange='f1.submit();'>
            <option value=''></option>

            <?php
            $filas = obtenerPaises();


            foreach ($filas as $fila) {

                echo "<option value='$fila[Id]'  ";

                if ($pais == $fila['Id']) {
                    echo " selected ";
                }
                echo ">$fila[Nombre]</option>";
            }


            ?>


        </select>


        <?php


        if ($pais != "") {
            echo  " provincia: <select name='provincia' onchange='f1.submit();'>";
            echo " <option value=''></option>";


            $filas = obtenerProvincias($pais);


            foreach ($filas as $fila) {

                echo "<option value='$fila[IdPro]'  ";

                if ($provincia == $fila['IdPro']) {
                    echo " selected ";
                }
                echo ">$fila[Nombre]</option>";
            }

            echo "</select>";
        }


        if ($provincia != "" && $pais != "") {
            echo  " localidad: <select name='provincia' onchange='f1.submit();'>";
            echo " <option value=''></option>";


            $filas = obtenerLocalidades($pais, $provincia);


            foreach ($filas as $fila) {

                echo "<option value='$fila[IdLoc]'  ";

                if ($localidad == $fila['IdLoc']) {
                    echo " selected ";
                }
                echo ">$fila[Nombre]</option>";
            }

            echo "</select>";
        }


        ?>

    </form>
    <?php
    mysqli_close($db); //cerrar base de datos
    ?>
</body>

</html>