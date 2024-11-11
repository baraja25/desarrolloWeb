<?php
//  SELECT COUNT(*) FROM alumnos WHERE NIF = '$nif' comprobar si un nif existe
function ObtenerAlumnos()
{
    $alumnos = array();   //Array con las lineas del archivo


    $fd = fopen("Alumnos.txt", "r") or die("Error al abrir el archivo");

    //Mostramos el contenido del archivo

    while (!feof($fd))     //Mientras No  llegado al fin del archivo
    {
        $linea = fgets($fd); //Extraemos una linea de ese archivo


        if (trim($linea) != "") {
            $campos = explode(":", $linea); //Separamos la linea en campos
            $alumnos[] = $campos;
        }
    }

    fclose($fd);

    return  $alumnos;
}

function existeNif($nif)
{
    global $db;

    $consulta = "SELECT count(*) as cuenta
    FROM alumnos WHERE NIF = '$nif'";


    $result = mysqli_query($db, $consulta);

    if ($result) {

        $fila = mysqli_fetch_assoc($result); //extraer la unica fila

    } else {
    }

    return $fila['cuenta'];
}


// conexion con base de datos
$host = "localhost";

$user = "root";

$pass = "";

$base = "tema2";

$db = mysqli_connect($host, $user, $pass, $base);

$alumnos = ObtenerAlumnos();

foreach ($alumnos as $alumno) {

    if (!existeNif($alumno[0])) {
        $consulta = "INSERT INTO alumnos (NIF, Nombre, Apellido1, Apellido2, edad, telefono) VALUES ('$alumno[0]', '$alumno[1]', '$alumno[2]', '$alumno[3]', $alumno[4], '$alumno[5]')";
        $resultado = mysqli_query($db, $consulta);
    } else {
        echo "<b>ERROR</b> El alumno con NIF $alumno[0] ya existe<br>";
    }
}



mysqli_close($db); //cerrar base de datos
