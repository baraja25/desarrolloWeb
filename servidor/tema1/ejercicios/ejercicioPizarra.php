<?php
// ir añadiendo nombres con un boton guardar y mostrar los nombres en una tabla. 
?>

<?php

function mostrarAgenda($agenda)
{
    $lineas = explode(",", $agenda);
    echo "<table border='2'>";
    echo "<tr>";
    echo "<th>DNI</th>";
    echo "<th>Nombre</th>";
    echo "<th>apellido 1</th>";
    echo "<th>apellido 2</th>";
    echo "</tr>";

    foreach ($lineas as $key => $linea) {
        echo "<tr>";

        $campos = explode(":", $linea);

        foreach ($campos as $key => $campo) {

            echo "<td>$campo</td>";
        }

        echo "</tr>";
    }
}

function lineasNif($agenda) {

    $lineasnif = array();

    $lineas=explode(",", $agenda);

    foreach ($lineas as $key => $linea) {
        
        $campos = explode(":", $linea);

        $linea = $lineasnif($campos[0]) ;

    }
    return $lineasnif;

}


function actualizar($linea, $agenda) {
    $lineasDni = lineasNif($agenda);

    $campos = explode(":",$linea);

    $nif = $campos[0];

    $lineasNif[$nif] = $linea;

    $agenda = implode(",", $lineasNif);

    return $agenda;
}

function estaAgenda($nif, $agenda)
{
    $encontrado = false;

    $lineas = explode(",", $agenda);

    foreach ($lineas as $key => $linea) {


        $campos = explode(":", $linea);

        if ($nif == $campos[0]) {
            $encontrado = true;
            break;
        }
    }
    return $encontrado;
}


$agenda = "";

if (isset($_GET['agenda'])) {
    $agenda = $_GET['agenda'];
}

if (isset($_GET['guardarNombre'])) {

    $nif = $_GET['nif'];
    $nombre = $_GET['nombre'];
    $apellido1 = $_GET['apellido1'];
    $apellido2 = $_GET['apellido2'];
    $linea = $nif . ":" . $nombre . ":" . $apellido1 . ":" . $apellido2; //variable que guarda la linea que vamos a insertar 

    if ($agenda == "") {
        $agenda = $agenda . $linea;
    } else {

        if (!estaAgenda($nif, $agenda)) {

            $agenda = $agenda . "," . $linea;
        } else {

            //echo "El nif $nif ya existe en la agenda. No se puede volver a insertar";

           $agenda =  actualizar($linea, $linea);
        }
    }
}




?>

<html>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="nif">NIF: </label>
        <input type="text" name="nif" id="nif">
        <br>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <label for="apellido1">Apellido: </label>
        <input type="text" name="apellido1" id="apellido1">
        <br>
        <label for="apellido2">Segundo apellido: </label>
        <input type="text" name="apellido2" id="apellido2">
        <br>
        <?php
        echo "<input type='hidden' name='agenda' value=$agenda>";
        ?>
        <input type="submit" value="Guardar" name="guardarNombre">
        <input type="submit" value="Mostrar" name="MostrarTabla">

    </form>
    <?php
    if (isset($_GET['MostrarTabla'])) {
        mostrarAgenda($agenda);
    }

    ?>



</body>

</html>