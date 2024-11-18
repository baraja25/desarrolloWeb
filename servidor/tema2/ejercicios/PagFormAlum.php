<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginar alumno</title>
</head>

<body>
    <?php
    /* Conexion a base de datos */
    $host = "localhost";
    $user = "root";
    $pass = "";
    $base = "tema2";

    $db = mysqli_connect($host, $user, $pass, $base); // Conexion al servidor de base de datos y devuelve el decriptor de conexion

    $consulta = "SELECT * FROM alumnos";
    $resultado = mysqli_query($db, $consulta);

    if ($resultado == false) {
        echo "Error al hacer la consulta: " . mysqli_error($db);
    } else {
        $alumnos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    mysqli_close($db);

    // Paginación
    $totalAlumnos = count($alumnos);
    $alumnosPorPagina = 1; 
    $totalPaginas = ceil($totalAlumnos / $alumnosPorPagina);

    // Obtener el número de página actual
    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $paginaActual = max(1, min($paginaActual, $totalPaginas)); 

    // Calcular el índice del alumno a mostrar
    $indiceAlumno = ($paginaActual - 1) * $alumnosPorPagina;

    // Obtener el alumno correspondiente
    $alumnoActual = isset($alumnos[$indiceAlumno]) ? $alumnos[$indiceAlumno] : null;
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="nif">NIF: </label>
        <input type="text" name="nif" id="nif" value="<?php echo $alumnoActual['NIF'] ?? ''; ?>"><br>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $alumnoActual['Nombre'] ?? ''; ?>"><br>
        <label for="apellido1">Primer apellido: </label>
        <input type="text" name="apellido1" id="apellido1" value="<?php echo $alumnoActual['Apellido1'] ?? ''; ?>"><br>
        <label for="apellido2">Segundo apellido: </label>
        <input type="text" name="apellido2" id="apellido2" value="<?php echo $alumnoActual['Apellido2'] ?? ''; ?>"><br>
        <label for="telefono">Teléfono: </label>
        <input type="text" name="telefono" id="telefono" value="<?php echo $alumnoActual['telefono'] ?? ''; ?>"><br>

        <div>
            <a href="?pagina=1"><<</a>
            <a href="?pagina=<?php echo max(1, $paginaActual - 1); ?>"><</a>
            <a href="?pagina=<?php echo min($totalPaginas, $paginaActual + 1); ?>">></a>
            <a href="?pagina=<?php echo $totalPaginas; ?>">>></a>
        </div>
    </form>
</body>

</html>