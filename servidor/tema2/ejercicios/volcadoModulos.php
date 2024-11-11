<?php
//  SELECT COUNT(*) FROM alumnos WHERE NIF = '$nif' comprobar si un nif existe
function ObtenerModulos()
{
    $alumnos = array();   //Array con las lineas del archivo


    $fd = fopen("Modulos.txt", "r") or die("Error al abrir el archivo");

    //Mostramos el contenido del archivo

    while (!feof($fd))     //Mientras No  llegado al fin del archivo
    {
        $linea = fgets($fd); //Extraemos una linea de ese archivo


        if (trim($linea) != "") {
            $campos = explode(":", $linea); //Separamos la linea en campos
            $modulos[] = $campos;
        }
    }

    fclose($fd);

    return  $modulos;
}

function existeID($id)
{
    global $db;

    $consulta = "SELECT count(*) as cuenta
    FROM modulos WHERE id = '$id'";


    $result = mysqli_query($db, $consulta);

    if ($result) {

        $fila = mysqli_fetch_assoc($result); //extraer la unica fila

    }

    return $fila['cuenta'];
}


// conexion con base de datos
$host = "localhost";

$user = "root";

$pass = "";

$base = "tema2";

$db = mysqli_connect($host, $user, $pass, $base);

$modulos = ObtenerModulos();

foreach ($modulos as $modulo) {

    if (!existeID($modulo[0])) {
        $consulta = "INSERT INTO modulos (id, Nombre, curso, horas) VALUES ($modulo[0], '$modulo[1]', '$modulo[2]', $modulo[3])";
        $resultado = mysqli_query($db, $consulta);
    } else {
        echo "<b>ERROR</b> El modulo con id $modulo[0] ya existe<br>";
    }
}



mysqli_close($db); //cerrar base de datos
