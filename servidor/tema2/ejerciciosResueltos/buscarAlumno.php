<html>

<body>
    <?php
    // Función para mostrar los resultados en una tabla HTML
    function mostrarTabla($filas)
    {
        // Inicia un fieldset para los resultados de la búsqueda
        echo "<fieldset><legend>Resultado de la busqueda</legend>";

        // Crea una tabla HTML con borde
        echo "<table border='2'>";

        // Encabezados de la tabla con enlaces para ordenar por cada campo
        echo
        "<th>
        <a href='?ordenar=NIF&Nombre={$_GET['Nombre']}&Apellido1={$_GET['Apellido1']}&Apellido2={$_GET['Apellido2']}&edadMinima={$_GET['edadMinima']}&edadMaxima={$_GET['edadMaxima']}'>NIF</a>
        </th>

        <th>
        <a href='?ordenar=Nombre&Nombre={$_GET['Nombre']}&Apellido1={$_GET['Apellido1']}&Apellido2={$_GET['Apellido2']}&edadMinima={$_GET['edadMinima']}&edadMaxima={$_GET['edadMaxima']}'>Nombre</a>
        </th>

        <th>
        <a href='?ordenar=Apellido1&Nombre={$_GET['Nombre']}&Apellido1={$_GET['Apellido1']}&Apellido2={$_GET['Apellido2']}&edadMinima={$_GET['edadMinima']}&edadMaxima={$_GET['edadMaxima']}'>Apellido1</a>
        </th>

        <th>
        <a href='?ordenar=Apellido2&Nombre={$_GET['Nombre']}&Apellido1={$_GET['Apellido1']}&Apellido2={$_GET['Apellido2']}&edadMinima={$_GET['edadMinima']}&edadMaxima={$_GET['edadMaxima']}'>Apellido2</a>
        </th>

        <th>
        <a href='?ordenar=edad&Nombre={$_GET['Nombre']}&Apellido1={$_GET['Apellido1']}&Apellido2={$_GET['Apellido2']}&edadMinima={$_GET['edadMinima']}&edadMaxima={$_GET['edadMaxima']}'>Edad</a>
        </th>

        <th>
        <a href='?ordenar=telefono&Nombre={$_GET['Nombre']}&Apellido1={$_GET['Apellido1']}&Apellido2={$_GET['Apellido2']}&edadMinima={$_GET['edadMinima']}&edadMaxima={$_GET['edadMaxima']}'>Telefono</a>
        </th>";

        // Itera sobre las filas de resultados y mostrarlas en la tabla
        foreach ($filas as $fila) {
            echo "<tr>"; // Inicia una nueva fila en la tabla
            echo "<td>{$fila['NIF']}</td>"; // Muestra el NIF
            echo "<td>{$fila['Nombre']}</td>"; // Muestra el Nombre
            echo "<td>{$fila['Apellido1']}</td>"; // Muestra el Primer Apellido
            echo "<td>{$fila['Apellido2']}</td>"; // Muestra el Segundo Apellido
            echo "<td>{$fila['edad']}</td>"; // Muestra la Edad
            echo "<td>{$fila['telefono']}</td>"; // Muestra el Teléfono
            echo "</tr>"; // Cierra la fila
        }

        // Cierra la tabla y el fieldset
        echo "</table>";
        echo "</fieldset>";
    }
    ?>

    <fieldset>
        <legend>Buscar alumnos</legend>
        <!-- Formulario para buscar alumnos -->
        <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            Nombre <input type="text" name="Nombre" value="<?php echo isset($_POST['Nombre']) ? $_POST['Nombre'] : ''; ?>"><br>
            Apellido1 <input type="text" name="Apellido1" value="<?php echo isset($_POST['Apellido1']) ? $_POST['Apellido1'] : ''; ?>"><br>
            Apellido2 <input type="text" name="Apellido2" value="<?php echo isset($_POST['Apellido2']) ? $_POST['Apellido2'] : ''; ?>"><br>
            Edad Minima <input type="number" name="edadMinima" value="<?php echo isset($_POST['edadMinima']) ? $_POST['edadMinima'] : ''; ?>">
            Edad Maxima <input type="number" name="edadMaxima" value="<?php echo isset($_POST['edadMaxima']) ? $_POST['edadMaxima'] : ''; ?>">
            <input type="submit" name="Buscar" value="Buscar"> <!-- Botón para enviar el formulario -->
        </form>
    </fieldset>

    <?php
    // Parámetros de conexión a la base de datos
    $host = "localhost"; // Host de la base de datos
    $user = "root"; // Usuario de la base de datos
    $pass = ""; // Contraseña de la base de datos
    $base = "tema2"; // Nombre de la base de datos
    $db = mysqli_connect($host, $user, $pass, $base); // Conectar a la base de datos

    // Verificar si se ha enviado el formulario de búsqueda o se ha solicitado ordenar
    if (isset($_POST['Buscar']) || (isset($_GET['ordenar']))) {
        $ordenar = "NIF"; // Valor por defecto para ordenar
        // Obtener los valores del formulario, usando fusión de null para evitar errores
        $nombre = $_POST['Nombre'] ?? ''; // Nombre ingresado
        $apellido1 = $_POST['Apellido1'] ?? ''; // Primer apellido ingresado
        $apellido2 = $_POST['Apellido2'] ?? ''; // Segundo apellido ingresado
        $edadMinima = $_POST['edadMinima'] ?? ''; // Edad mínima ingresada
        $edadMaxima = $_POST['edadMaxima'] ?? ''; // Edad máxima ingresada

        // Construir la consulta SQL
        $consulta = "SELECT * FROM alumnos WHERE 1"; // Seleccionar todos los registros

        // Añadir condiciones a la consulta según los valores proporcionados
        if ($nombre != "") {
            $consulta .= " AND Nombre='$nombre'"; // Filtrar por nombre
        }
        if ($apellido1 != "") {
            $consulta .= " AND Apellido1='$apellido1'"; // Filtrar por primer apellido
        }
        if ($apellido2 != "") {
            $consulta .= " AND Apellido2='$apellido2'"; // Filtrar por segundo apellido
        }
        if ($edadMinima != "") {
            $consulta .= " AND edad >='$edadMinima'"; // Filtrar por edad mínima
        }
        if ($edadMaxima != "") {
            $consulta .= " AND edad <='$edadMaxima'"; // Filtrar por edad máxima
        }

        // Comprobar si se ha solicitado ordenar
        if (isset($_GET['ordenar'])) {
            $ordenar = $_GET['ordenar']; // Obtener el campo por el que se desea ordenar

            // Validar que el campo de ordenamiento es uno de los esperados
            $camposValidos = ['NIF', 'Nombre', 'Apellido1', 'Apellido2', 'edad', 'telefono'];
            if (in_array($ordenar, $camposValidos)) {
                $consulta .= " ORDER BY " . $ordenar; // Añadir la cláusula ORDER BY a la consulta
            }
        }

        // Ejecutar la consulta
        $resul = mysqli_query($db, $consulta);

        // Comprobar si la consulta se ejecutó correctamente
        if ($resul == FALSE) {
            echo "Error en la consulta:" . mysqli_error($db); // Mostrar error si la consulta falla
        } else {
            $filas = mysqli_fetch_all($resul, MYSQLI_ASSOC); // Obtener todos los resultados como un array asociativo
            mostrarTabla($filas); // Mostrar los resultados en una tabla
        }

        mysqli_close($db); // Cerrar la conexión a la base de datos
    }
    ?>
</body>

</html>