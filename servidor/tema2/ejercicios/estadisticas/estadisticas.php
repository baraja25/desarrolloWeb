<!DOCTYPE html>
<html lang="en">
<?php
//import librerias
require_once "misc.php";
require_once "libreria.php";
//inicializacion de variables
$opc = "";
$cantidadAlumno = "";
$radioOpcion = "";
$tituloMejores = ["NIF Alumno", "Segundo Apellido", "Primer Apellido", "Nombre", "Suma total notas"];
$alumnos = array();
//comprobacion si las variables tienen valor
// mejores o peores
if (isset($_POST['opcion'])) {
    $opc = $_POST['opcion'];
}

// el numero de alumnos del despegable
if (isset($_POST['cantidadAlumnos'])) {
    $cantidadAlumno = $_POST['cantidadAlumnos'];
}

// opcion elegida en el boton radio
if (isset($_POST['elegirSuspenso'])) {
    $radioOpcion = $_POST['elegirSuspenso'];
}
// muestra los alumnos segun los criterios
if (isset($_POST['mostrarResultado'])) {
    $consultaAlumnos = "SELECT * FROM alumnos";
    $alumnos = consultaDeDatos($consultaAlumnos);

    //si el usuario elige mejores y sin suspensos
    if ($opc == 1 && $radioOpcion == 2) {
        // consulta que filtra los suspensos
        $consultaMejores = "SELECT a.NIF, a.Apellido2,a.Apellido1,a.Nombre, SUM(nota) as notasSinSuspenso 
        FROM notas n, alumnos a
        WHERE n.IdAlum = a.NIF and n.Nota > 4
        GROUP BY n.IdAlum
        ORDER by 5
        DESC 
        LIMIT $cantidadAlumno";;
        $mejoresAlumnos = consultaDeDatos($consultaMejores);
        mostrarTabla($mejoresAlumnos, $tituloMejores);
    }
    // si al usuario no le importa los suspensos
    if ($opc == 1 && $radioOpcion == 1) {
        // consulta que filtra los suspensos
        $consultaMejores = "SELECT a.NIF, a.Apellido2,a.Apellido1,a.Nombre, SUM(nota) as notasSinSuspenso 
        FROM notas n, alumnos a
        WHERE n.IdAlum = a.NIF and n.Nota > 0
        GROUP BY n.IdAlum
        ORDER by 5
        DESC 
        LIMIT $cantidadAlumno";
        $mejoresAlumnos = consultaDeDatos($consultaMejores);
        mostrarTabla($mejoresAlumnos, $tituloMejores);
    }
    //si elige con suspensos
    if ($opc == 2 && $radioOpcion == 1) {
        $consultaPeores = "SELECT a.NIF, a.Apellido2,a.Apellido1,a.Nombre, SUM(nota) as notasSinSuspenso 
        FROM notas n, alumnos a
        WHERE n.IdAlum = a.NIF and n.Nota > 0
        GROUP BY n.IdAlum
        ORDER by 5 
        LIMIT $cantidadAlumno";;
        $peoresAlumnos = consultaDeDatos($consultaPeores);
        mostrarTabla($peoresAlumnos, $tituloMejores);
    }

    //si el usuario elige la opcion de sin suspensos
    if ($opc == 2 && $radioOpcion == 2) {
        $consultaPeores = "SELECT a.NIF, a.Apellido2,a.Apellido1,a.Nombre, SUM(nota) as notasSinSuspenso 
        FROM notas n, alumnos a
        WHERE n.IdAlum = a.NIF and n.Nota > 4
        GROUP BY n.IdAlum
        ORDER by 5
        LIMIT $cantidadAlumno";;
        $peoresAlumnos = consultaDeDatos($consultaPeores);
        mostrarTabla($peoresAlumnos, $tituloMejores);
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadisticas</title>
</head>

<body>
    <fieldset>
        <legend>Seleccione criterios</legend>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

            <select name="opcion" id="opcion">
                <option value=""></option>

                <?php
                $opciones = array(1 => "Mejores", 2 => "Peores");
                // despegable que da a elegir
                foreach ($opciones as $key => $value) {
                    echo "<option value='$key' ";

                    if ($opc == $key) {
                        echo " selected ";
                    }
                    echo ">$value</option>";
                }
                ?>
            </select>
            <select name="cantidadAlumnos">
                <option value=""></option>
                <?php
                //obtener la cantidad de alumnos
                for ($i = 1; $i <= 10; $i++) {
                    echo "<option value='$i' ";

                    if ($cantidadAlumno == $i) {
                        echo " selected ";
                    }
                    echo ">$i</option>";
                }
                ?>
            </select>
            Con suspensos:
            <?php
            // Muestra las opciones de un radio input
            $radioOpciones = array(1 => "Si", 2 => "No");
            foreach ($radioOpciones as $key => $value) {
                echo "$value<input type='radio' name='elegirSuspenso' value='$key' ";

                if ($radioOpcion == $key) {
                    echo " checked ";
                }

                echo " >";
            }

            ?>

            <input type="submit" value="Mostrar" name="mostrarResultado">

        </form>
    </fieldset>
</body>

</html>