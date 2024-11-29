<?php

//archivo de libreria para conectar a un ddbb

$host = "localhost";

$user = "root";

$pass = "";

$base = "examentema2";

function conectar()
{
    global $host, $user, $pass, $base;

    $db = mysqli_connect($host, $user, $pass, $base);

    if ($db == false) {
        echo "Error al conectar" . mysqli_connect_error();
        exit;
    }

    return $db;
}

function consultaSimple($consulta)
{ //funcion que no devuelve nada
    $db = conectar();

    $resultado = mysqli_query($db, $consulta);

    if (!$resultado) {
        echo mysqli_error($db);
    }

    cerrar($db);
}

//funcion que me devuelve los datos
function consultaDeDatos($consulta)
{
    $db = conectar();

    $filas = array();

    $resultado = mysqli_query($db, $consulta);

    if (!$resultado) {
        echo mysqli_error($db);
    } else { // si no hay error obtenemos todas las filas
        $filas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    cerrar($db);

    return $filas;
}


function cerrar($db)
{
    mysqli_close($db);
}
