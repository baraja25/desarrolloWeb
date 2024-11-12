<!DOCTYPE html>
<?php
// Configuración de conexión a la base de datos
$host = "localhost"; // Nombre del host (servidor)
$user = "root";      // Nombre de usuario de la base de datos
$pass = "";          // Contraseña de la base de datos
$base = "tema2";    // Nombre de la base de datos

$alumnos = array(); // Inicialización del array para almacenar los alumnos

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

// Inicialización de variables
$alu = ""; // Variable para almacenar el NIF del alumno seleccionado
$nif = ""; // Variable para almacenar el NIF
$nombre = ""; // Variable para almacenar el nombre
$apellido1 = ""; // Variable para almacenar el primer apellido
$apellido2 = ""; // Variable para almacenar el segundo apellido
$edad = ""; //Variable para almacenar la edad
$telefono = ""; // Variable para almacenar el teléfono

// Verificar si se ha enviado el formulario y se ha seleccionado un alumno
if (isset($_POST['alumno'])) {
    $alu = $_POST["alumno"]; // Obtener el NIF del alumno seleccionado
    // Consulta para obtener los datos del alumno seleccionado
    $consultaAlumno = "SELECT * FROM alumnos WHERE NIF = '$alu'";
    $resultadoAlumno = mysqli_query($db, $consultaAlumno); // Ejecutar la consulta para obtener el alumno seleccionado

    // Verificar si la consulta fue exitosa
    if ($resultadoAlumno) {
        $alumnoSeleccionado = mysqli_fetch_assoc($resultadoAlumno); // Obtener los datos del alumno seleccionado
        // Asignar los valores a las variables correspondientes
        $nif = $alumnoSeleccionado['NIF'];
        $nombre = $alumnoSeleccionado['Nombre'];
        $apellido1 = $alumnoSeleccionado['Apellido1'];
        $apellido2 = $alumnoSeleccionado['Apellido2'];
        $telefono = $alumnoSeleccionado['Telefono'];
    }
}

// Manejar la actualización de los datos del alumno
if (isset($_POST['actualizar'])) {
    $nif = $_POST['nif'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $telefono = $_POST['telefono'];

    // Consulta para actualizar los datos del alumno
    $consultaActualizar = "UPDATE alumnos SET Nombre='$nombre', Apellido1='$apellido1', Apellido2='$apellido2', Telefono='$telefono' WHERE NIF='$nif'";
    if (mysqli_query($db, $consultaActualizar)) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar: " . mysqli_error($db);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($db);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MostrarAlumnos</title> <!-- Título de la página -->
</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"> <!-- Formulario que se envía a sí mismo -->

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

        <input type="submit" value="Mostrar" name="mostrar"> <!-- Botón para enviar el formulario -->

        <?php
        // Si se ha enviado el formulario, mostrar los datos del alumno seleccionado
        if (isset($_POST['mostrar'])) {
            echo "<fieldset>"; // Crear un campo de conjunto para agrupar los campos
            echo "<label for='nif'>NIF: </label>"; // Etiqueta para el campo NIF
            echo "<input type='text' name='nif' id='nif' value='$nif' readonly>"; // Campo de texto para el NIF
            echo "<br>";
            echo "<label for='nombre'>Nombre: </label>"; // Etiqueta para el campo Nombre
            echo "<input type='text' name='nombre' id='nombre' value='$nombre'>"; // Campo de texto para el Nombre
            echo "<br>";
            echo "<label for='apellido1'> Primer apellido: </label>"; // Etiqueta para el campo Primer apellido
            echo "<input type='text' name='apellido1' id='apellido1' value='$apellido1'>"; // Campo de texto para el Primer apellido
            echo "<br>";
            echo "<label for='apellido2'>Segundo apellido: </label>"; // Etiqueta para el campo Segundo apellido
            echo "<input type='text' name='apellido2' id='apellido2' value='$apellido2'>"; // Campo de texto para el Segundo apellido
            echo "<br>";
            echo "<label for='telefono'>Teléfono: </label>"; // Etiqueta para el campo Teléfono
            echo "<input type='text' name='telefono' id='telefono' value='$telefono'>"; // Campo de texto para el Teléfono
            echo "<br>";
            echo "<input type='submit' value='Actualizar' name='actualizar'>"; // Botón para actualizar los datos
            echo "</fieldset>"; // Cerrar el campo de conjunto
        }
        ?>
    </form>
</body>

</html>