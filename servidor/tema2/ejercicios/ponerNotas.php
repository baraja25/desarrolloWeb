<?php
// Configuración de conexión a la base de datos
$host = "localhost"; // Nombre del host (servidor)
$user = "root";      // Nombre de usuario de la base de datos
$pass = "";          // Contraseña de la base de datos
$base = "tema2";    // Nombre de la base de datos



// Inicialización de variables
$alu = ""; // Variable para almacenar el NIF del alumno seleccionado
$mod = ""; // Variable para almacenar el id del modulo seleccionado
$nota = ""; // Variable para almacenar la nota introducida
$nif = ""; // Variable para almacenar el NIF
$nombre = ""; // Variable para almacenar el nombre
$apellido1 = ""; // Variable para almacenar el primer apellido
$apellido2 = ""; // Variable para almacenar el segundo apellido
$edad = ""; //Variable para almacenar la edad
$telefono = ""; // Variable para almacenar el teléfono
$alumnos = array(); // Inicialización del array para almacenar los alumnos
$modulos = array(); // Inicialización del array para almacenar los modulos

// Establecer la conexión con la base de datos
$db = mysqli_connect($host, $user, $pass, $base); // Conexión al servidor de base de datos y devuelve el descriptor de conexión

// Consulta para obtener todos los alumnos
$consulta = "SELECT * FROM alumnos";
$resultado = mysqli_query($db, $consulta); // Ejecutar la consulta

// Verificar si la consulta fue exitosa
if ($resultado) {
    $alumnos = mysqli_fetch_all($resultado, MYSQLI_ASSOC); // Almacenar todos los resultados en el array $alumnos
} else {
    echo "Error:" . mysqli_error($db); // Mostrar error si la consulta falla
}

$consultaModulos = "SELECT * FROM modulos";
$resultadoModulos = mysqli_query($db, $consultaModulos); //Ejecutar la consulta

// Verificar si la consulta fue exitosa
if ($resultadoModulos) {
    $modulos = mysqli_fetch_all($resultadoModulos, MYSQLI_ASSOC); // Almacenar todos los resultados en el array $alumnos
} else {
    echo "Error:" . mysqli_error($db); // Mostrar error si la consulta falla
}

if (isset($_POST['ponerNota'])) {
    $alu = $_POST['alumno'];
    $mod = $_POST['modulo'];
    $nota = $_POST['nota'];
    if ($nota <= 10 && $nota >= 0) {
        $consultaNota = "INSERT INTO notas (idAlumno, idModulo, nota) VALUES ('$alu', $mod, $nota)";
        $resultadoNota = mysqli_query($db, $consultaNota); //Ejecutar la consulta
    } else {
        echo "Introduce una nota entre 0 y 10";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poner Notas</title>
</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        Alumnos <select name="alumno"> <!-- Dropdown para seleccionar un alumno -->
            <option value=""></option> <!-- Opción vacía -->
            <?php
            // Generar las opciones del dropdown a partir del array de alumnos
            foreach ($alumnos as $alumno) {
                echo "<option value='{$alumno['NIF']}'"; // Valor de la opción es el NIF del alumno

                // Si el NIF del alumno coincide con el seleccionado, marcarlo como seleccionado
                if ($alu == $alumno['NIF']) {

                    echo " selected";
                }

                // Mostrar el apellido y nombre del alumno en la opción
                echo ">{$alumno['Apellido1']}, {$alumno['Nombre']}</option>";
            }
            ?>
        </select>

        Modulos <select name="modulo"> <!-- Dropdown para seleccionar un modulo -->
            <option value=""></option> <!-- Opción vacía -->
            <?php
            // Generar las opciones del dropdown a partir del array de modulos
            foreach ($modulos as $modulo) {
                echo "<option value='{$modulo['id']}'"; // Valor de la opción es el id del modulo

                // Si el id del modulo coincide con el seleccionado, marcarlo como seleccionado
                if ($mod == $modulo['id']) {
                    echo " selected";
                }

                // Mostrar el nombre del modulo en la opción
                echo ">{$modulo['Nombre']}</option>";
            }
            ?>
        </select>
        <input type="number" name="nota">
        <input type="submit" value="Poner Nota" name="ponerNota">

    </form>

</body>

</html>