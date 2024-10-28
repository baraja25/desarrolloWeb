<html>

<body>

    <?php

    // Función para obtener las notas de los alumnos desde un archivo
    function ObtenerNotas()
    {
        $notas = array(); // Inicializamos un array para almacenar las notas
        $fd = fopen("notas.txt", "r") or die("Error al abrir el archivo"); // Abrimos el archivo de notas

        // Leemos el archivo línea por línea
        while (!feof($fd)) {
            $linea = fgets($fd); // Leemos una línea del archivo
            $campos = explode(":", $linea); // Separamos la línea en campos

            // Verificamos que haya exactamente dos campos: clave y nota
            if (count($campos) == 2) {
                $notas[trim($campos[0])] = trim($campos[1]); // Guardamos la nota asociada al alumno
            }
        }

        fclose($fd); // Cerramos el archivo
        return $notas; // Devolvemos el array de notas
    }

    // Función para obtener los alumnos matriculados en un módulo y curso específicos
    function ObtenerMatriculados($mod, $cur)
    {
        $alumnosMatri = array(); // Inicializamos un array para almacenar los alumnos matriculados

        $alumnos = ObtenerAlumnos(); // Obtenemos los datos de todos los alumnos

        $fd = fopen("Matricula.txt", "r") or die("Error al abrir el archivo"); // Abrimos el archivo de matrícula

        // Leemos el archivo línea por línea
        while (!feof($fd)) {
            $linea = fgets($fd); // Leemos una línea del archivo
            $campos = explode(":", $linea); // Separamos la línea en campos

            // Filtramos líneas que no tengan exactamente 3 campos
            if (count($campos) == 3) {
                // Verificamos si el módulo y el curso coinciden
                if (($mod == $campos[1]) && ($cur == $campos[2])) {
                    $lineaAlu = $alumnos[$campos[0]]; // Recuperamos la línea con los datos de ese alumno
                    $camposAlu = explode(":", $lineaAlu); // Separamos la línea en campos

                    // Guardamos en el array de matriculados la línea del alumno con ese DNI
                    $alumnosMatri[$campos[0]] = "$camposAlu[2]:$camposAlu[3]:$camposAlu[1]:$camposAlu[4]:$camposAlu[5]";
                }
            }
        }

        asort($alumnosMatri); // Ordenamos por valor manteniendo la clave
        fclose($fd); // Cerramos el archivo

        return $alumnosMatri; // Devolvemos el array de alumnos matriculados
    }

    // Función para obtener todos los alumnos desde un archivo
    function ObtenerAlumnos()
    {
        $alumnos = array(); // Inicializamos un array para almacenar los alumnos

        $fd = fopen("Alumnos.txt", "r") or die("Error al abrir el archivo"); // Abrimos el archivo de alumnos

        // Leemos el archivo línea por línea
        while (!feof($fd)) {
            $linea = fgets($fd); // Leemos una línea del archivo
            $campos = explode(":", $linea); // Separamos la línea en campos

            // Solo queremos las líneas con 6 campos
            if (count($campos) == 6) {
                $alumnos[$campos[0]] = $linea; // Guardamos esa línea en el array de alumnos
            }
        }

        fclose($fd); // Cerramos el archivo
        return $alumnos; // Devolvemos el array de alumnos
    }

    // Función para obtener los módulos desde un archivo
    function ObtenerModulos()
    {
        $modulos = array(); // Inicializamos un array para almacenar los módulos

        $fd = fopen("Modulos.txt", "r") or die("Error al abrir el archivo"); // Abrimos el archivo de módulos

        // Leemos el archivo línea por línea
        while (!feof($fd)) {
            $linea = fgets($fd); // Leemos una línea del archivo
            $campos = explode(":", $linea); // Separamos la línea en campos

            // Solo queremos las líneas con 4 campos
            if (count($campos) == 4) {
                $modulos[$campos[0]] = $linea; // Guardamos esa línea en el array de módulos
            }
        }

        fclose($fd); // Cerramos el archivo
        return $modulos; // Devolvemos el array de módulos
    }

    // Comprobamos los datos recibidos tras la recarga
    $mod = "";

    if (isset($_GET['Modulo'])) {
        $mod = $_GET['Modulo'];
    }

    $cur = "";

    if (isset($_GET['Curso'])) {
        $cur = $_GET['Curso'];
    }

    $notas = "";

    if (isset($_GET['Calificar'])) {
        $notas = $_GET['nota'];
        $fd = fopen("notas.txt", "w") or die("No se pudo abrir el archivo"); // Abrimos el archivo de notas en modo escritura

        // Escribimos las notas en el archivo
        foreach ($notas as $key => $nota) {
            fputs($fd, "$key:$nota\n");
        }

        fclose($fd); // Cerramos el archivo
    }

    ?>


    <fieldset>
        <legend>Calificación de alumnos</legend>
        <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">

            <?php
            // Recuperamos los datos de los módulos
            $modulos = ObtenerModulos(); // Llamamos a la función para obtener los módulos disponibles

            // Iteramos sobre cada módulo para crear un checkbox
            foreach ($modulos as $clave => $modulo) {
                $campos = explode(":", $modulo); // Separamos la línea del módulo en campos

                // Creamos un checkbox para cada módulo
                echo "<input type='checkbox' name='Modulo[]' value='$campos[0]'  ";

                // Si el módulo está seleccionado, lo marcamos como checked
                if (in_array($campos[0], (array) $mod)) {
                    echo " checked ";
                }
                echo ">$campos[1]</input>"; // Mostramos el nombre del módulo
            }
            ?>

            <!-- Dropdown para seleccionar el curso -->
            Curso<select name='Curso'>
                <option value=''></option>
                <?php
                // Definimos los años de curso disponibles
                $cursos = array('2020', '2021', '2022', '2023', '2024', '2025');

                // Iteramos sobre los cursos para crear las opciones del dropdown
                foreach ($cursos as $clave => $curso) {
                    echo "<option value='$clave'  ";

                    // Si el curso está seleccionado, lo marcamos como selected
                    if ($cur == $clave) {
                        echo " selected ";
                    }
                    echo ">$curso</option>"; // Mostramos el año del curso
                }
                ?>
            </select>

            <!-- Botón para enviar el formulario -->
            <input type='submit' name='Mostrar' value='Mostrar Alumnos'>
    </fieldset>

    <?php
    // Verificamos si se ha enviado el formulario para mostrar los alumnos
    if (isset($_GET['Mostrar'])) {
        echo "<fieldset><legend>Alumnos con notas</legend>"; // Iniciamos un nuevo fieldset para mostrar los alumnos

        echo "<table border='2'>"; // Creamos una tabla para mostrar los datos
        echo "<th>Apellido1</th><th>Apellido2</th><th>Nombre</th><th>Nota</th>"; // Encabezados de la tabla

        // Obtenemos los módulos seleccionados
        $modulosSeleccionados = isset($_GET['Modulo']) ? $_GET['Modulo'] : []; // Verificamos si se seleccionaron módulos

        // Obtenemos las notas de los alumnos
        $notasAlumnos = ObtenerNotas();

        // Iteramos sobre cada módulo seleccionado
        foreach ($modulosSeleccionados as $modulo) {
            // Obtenemos los alumnos matriculados en el módulo y curso seleccionados
            $alumnos = obtenerMatriculados($modulo, $cur);
            if (!empty($alumnos)) { // Verificamos que haya alumnos matriculados
                foreach ($alumnos as $clave => $linea) {
                    $campos = explode(":", $linea); // Separamos la línea del alumno en campos

                    echo "<tr>"; // Iniciamos una nueva fila en la tabla
                    echo "<td>$campos[0]</td><td>$campos[1]</td><td>$campos[2]</td>"; // Mostramos los apellidos y el nombre del alumno

                    // Obtenemos la nota actual del alumno o dejamos vacío si no tiene nota
                    $notaActual = isset($notasAlumnos[$clave]) ? $notasAlumnos[$clave] : '';
                    echo "<td><input type='text' name='nota[$clave]' value='$notaActual'></td>"; // Campo de texto para la nota
                    echo "</tr>"; // Cerramos la fila
                }
            }
        }

        echo "</table>"; // Cerramos la tabla

        // Botón para calificar a los alumnos
        echo "<input type='submit' name='Calificar' value='Calificar'>";

        echo "</fieldset>"; // Cerramos el fieldset
    }
    ?>

    </form>

</body>

</html>