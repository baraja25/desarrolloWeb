<html>

<body>

    <?php

    function ObtenerAlumnos()
    {
        $alumnos = array();   //Array con las lineas del archivo

        $fd = fopen("Alumnos.txt", "r") or die("Error al abrir el archivo");

        //Mostramos el contenido del archivo

        while (!feof($fd))     //Mientras No  llegado al fin del archivo
        {
            $linea = fgets($fd); //Extraemos una linea de ese archivo

            $campos = explode(":", $linea); //Separamos la linea en campos

            if (count($campos) == 6)   //Solo queremos la lineas con los 6 campos del alumno
            {
                $alumnos[$campos[0]] = $linea; //Guardamos ese linea en el array de alumnos
            }
        }

        fclose($fd);

        return  $alumnos;
    }

    function pasarFiltro($campos, $filtro)
    {
        $pasa = true;

        for ($i = 1; $i <= 5; $i++) {
            $pasa = $pasa && ($filtro[$i] == "" || (trim($filtro[$i]) == trim($campos[$i])));
        }

        return $pasa;
    }
    function eliminarAlumnos($nifs)
    {
        $alumnos = ObtenerAlumnos();

        foreach ($nifs as $key => $nif) {
            unset($alumnos[$nif]);
        }

        $fd = fopen("Alumnos.txt", "w") or die("Error al abrir el archivo");

        foreach ($alumnos as $key => $linea) {
            fwrite($fd, $linea);
        }

        fclose($fd);
    }

    if (isset($_GET['Eliminar'])) {
        eliminarAlumnos($nifs);
    }
    ?>


    <fieldset>
        <legend>Busqueda de alumnos</legend>
        <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">

            NIF <input type="text" name="NIF"><br>
            Nombre <input type="text" name="Nombre"><br>
            Apellido1 <input type="text" name="Apellido1"><br>
            Apellido2 <input type="text" name="Apellido2"><br>
            Edad <input type="text" name="Edad"><br>
            Telefono <input type="text" name="Telefono"><br>

            <input type="submit" name="Buscar" value="Buscar">



        </form>

    </fieldset>

    <?php

    if (isset($_GET['Buscar'])) {
        //Recogemos los valores de los campos

        $nombre = $_GET['Nombre'];
        $apellido1 = $_GET['Apellido1'];
        $apellido2 = $_GET['Apellido2'];
        $edad = $_GET['Edad'];
        $telefono = $_GET['Telefono'];

        $filtro = array();
        $filtro[1] = $nombre;
        $filtro[2] = $apellido1;
        $filtro[3] = $apellido2;
        $filtro[4] = $edad;
        $filtro[5] = $telefono;


        $alumnos = ObtenerAlumnos(); //recoger los datos de los alumnos del txt y se pasa a un array

        echo "<form name='f2' method='get' action='$_SERVER[PHP_SELF]'>";
        echo "<table border='2'>";
        echo "<th>Eliminar</th><th>NIF</th><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Edad </th><th>Telefono </th>";
        foreach ($alumnos as $key => $linea) {
            $campos = explode(":", $linea);
            if (pasarFiltro($campos, $filtro)) {
                echo "<tr>";

                echo "<td><input type='checkbox' name='nifs[]' 
                value='" . trim($campos[0]) . "'></td>";
                foreach ($campos as $key => $campo) {
                    echo "<td>$campo</td>";
                }
                echo "</tr>";
            }
        }


        echo "</table>";
        echo "<input type='submit' value='Eliminar' name='Eliminar'>";
        echo "</form>";
    }


    ?>
</body>

</html>