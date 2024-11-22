<?php
require_once "libreria.php";
require_once "misc.php";

function mostrarTablaConEnlace($datos, $titulos)
{
    // Comenzamos la tabla
    echo "<table border='2'>";

    // Agregamos los encabezados de la tabla
    echo "<tr>";
    foreach ($titulos as $titulo) {
        echo "<th>" . $titulo . "</th>";
    }
    echo "</tr>";

    // Agregamos los datos a la tabla
    foreach ($datos as $fila) {
        echo "<tr>";

        // Suponemos que $fila tiene 'NIF', 'nombre', 'apellido1', 'apellido2', 'edad', 'telefono'
        $nif = $fila['NIF'];
        $nombre = $fila['Nombre'];
        $apellido1 = $fila['Apellido1'];
        $apellido2 = $fila['Apellido2'];
        $edad = $fila['Edad'];
        $telefono = $fila['Telefono'];

        // Creamos un enlace para cada alumno que muestra su nombre y apellidos
        echo "<td><a href='?id=$nif'>$fila[NIF]</a></td>";
        echo "<td>$fila[Nombre]</td>";
        echo "<td>$fila[Apellido1]</td>";
        echo "<td>$fila[Apellido2]</td>";
        echo "<td>$fila[Edad]</td>";
        echo "<td>$fila[Telefono]</td>";
        echo "</tr>";
    }

    // Cerramos la tabla
    echo "</table>";
}



// Comprobamos si se ha enviado un ID de alumno
$idAlumno = isset($_GET['id']) ? $_GET['id'] : null;

if ($idAlumno) {
    // Si se ha seleccionado un alumno, obtenemos sus notas
    $consultaNotas = "SELECT m.Nombre, n.Nota 
                        FROM notas n, modulos m 
                        WHERE n.IdAlum = '$idAlumno' and m.Id = n.IdMod ";
    $notasAlumnos = consultaDeDatos($consultaNotas);
} else {
    $notasAlumnos = []; // Inicializamos como vacío si no hay alumno seleccionado
}

$consultaAlumnos = "SELECT * FROM alumnos ORDER BY 3,4,1";
$alumnos = consultaDeDatos($consultaAlumnos); // obtiene un array asociativo de los alumnos
$titulosAlumno = ['NIF', 'Nombre', 'Apellido 1', 'Apellido 2', 'Edad', 'Telefono']; // esta variable tiene los nombres de la cabecera de la tabla
$titulosNotas = ['modulo', 'Nota'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Alumnos</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" name="form1">
        <?php
        // Mostrar la tabla de alumnos
        mostrarTablaConEnlace($alumnos, $titulosAlumno);

        // Mostrar la tabla de notas solo si hay un alumno seleccionado
        if ($idAlumno) {
            mostrarTabla($notasAlumnos, $titulosNotas);
        }
        ?>
    </form>
</body>

</html>