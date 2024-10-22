<html>

<body>
    <?php


    function PasaFiltro($campos, $filtro)
    {
        $pasa = TRUE;

        for ($i = 1; $i <= 5; $i++) {
            $pasa = $pasa && (($filtro[$i] == "") || (trim($filtro[$i]) == trim($campos[$i])));
        }

        return $pasa;
    }

    function ObtenerAlumnos()
    {
        $alumnos = array();   //Array con las lineas del archivo

        $fd = fopen("Alumnos.txt", "r") or die("Error al abrir el archivo");

        //Mostramos el contenido del archivo

        while (!feof($fd))     //Mientras No  llegado al fin del archivo
        {
            $linea = fgets($fd); //Extraemos una linea de ese archivo

            $campos = explode(":", $linea); //Separamos la linea en campos

            if (count($campos) == 6)   //Solo queremos la lienas con los 6 campos del alumno
            {
                $alumnos[$campos[0]] = $linea; //Guardamos ese linea en el array de alumnos
            }
        }

        fclose($fd);

        return  $alumnos;
    }

    function ObtenerModulos()
    {
        $modulos = array();   //Array con las lineas del archivo

        $fd = fopen("modulos.txt", "r") or die("Error al abrir el archivo");

        //Mostramos el contenido del archivo

        while (!feof($fd))     //Mientras No  llegado al fin del archivo
        {
            $linea = fgets($fd); //Extraemos una linea de ese archivo

            $campos = explode(":", $linea); //Separamos la linea en campos

            if (count($campos) == 4)   //Solo queremos la lienas con los 6 campos del alumno
            {
                $modulos[$campos[0]] = $linea; //Guardamos ese linea en el array de alumnos
            }
        }

        fclose($fd);

        return  $modulos;
    }

    function estaArchivo($linea)
    {
        $esta = false;

        $fd = fopen("matricula.txt", "r") or die("Error al abrir el archivo");

        while (!feof($fd) && !$esta) {
            $lineaFile = fgets($fd);

            if (trim($lineaFile) == trim($linea)) {
                $esta = true;
            }
        }

        return $esta;
        
        fclose($fd);
    }



    function Matricular($clave, $modulo, $curso)
    {
        $fd = fopen("matricula.txt", "a+") or die("Error al abrir el archivo");
        $salto = "\r\n";
        $linea = "$clave:$modulo:$curso" . $salto;
        if (!estaArchivo($linea)) {
            fputs($fd, $linea);
        } else {
            echo "El Alumno ya esta matriculado";
        }


        fclose($fd);
    }

    $alumnos = ObtenerAlumnos();   //Recogemos los alumnos del archivo en un array


    $modulo = "";

    if (isset($_GET['modulo'])) {
        $modulo = $_GET['modulo'];
    }

    $curso = "";

    if (isset($_GET['curso'])) {
        $curso = $_GET['curso'];
    }

    if (isset($_GET['matricular']) && (isset($_GET['Selec']))) {
        $selec = $_GET['Selec'];

        foreach ($selec as $key => $value) {
            Matricular($key, $modulo, $curso);
        }
    }


    ?>





    <fieldset>
        <legend>Busqueda de alumnos</legend>
        <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">

            Nombre<input type="text" name="Nombre"><br>
            Apellido1<input type="text" name="Apellido1"><br>
            Apellido2<input type="text" name="Apellido2"> <br>
            Edad<input type="number" name="Edad"> <br>
            Telefono<input type="text" name="Telefono"> <br>

            <input type="submit" name="Buscar" value="Buscar">
    </fieldset>

    <?php


    if (isset($_GET['Buscar'])) {
        //Recogemos los valores de los campos

        $nombre = $_GET['Nombre'];
        $apellido1 = $_GET['Apellido1'];
        $apellido2 = $_GET['Apellido2'];
        $edad = $_GET['Edad'];
        $telefono = $_GET['Telefono'];

        $filtro = array(); //Array con los valores del campos a filtrar

        $filtro[1] = $nombre;
        $filtro[2] = $apellido1;
        $filtro[3] = $apellido2;
        $filtro[4] = $edad;
        $filtro[5] = $telefono;

        $alumnos = ObtenerAlumnos();   //Recogemos los alumnos del archivo en un array
        echo "<fieldset><legend>Alumnos para matricular</legend>";

        $modulos = ObtenerModulos();

        echo "Modulos<select name='modulo'>";
        echo "<option value=''></option>";

        foreach ($modulos as $clave => $modulo) {
            $campos = explode(":", $modulo);

            echo "<option value='$campos[0]'  ";

            if ($modulo == $campos[0]) {
                echo " selected ";
            }
            echo ">$campos[2],$campos[1]</option>";
        }
        echo "</select>";

        $cursos = array('2020', '2021', '2022', '2023', '2024', '2025');

        echo "Curso<select name='curso'>";
        echo "<option value=''></option>";

        foreach ($cursos as $clave => $curso) {


            echo "<option value='$clave'  ";

            if ($curso == $campos[0]) {
                echo " selected ";
            }
            echo ">$curso</option>";
        }
        echo "</select>";


        echo "<input type='submit' name='matricular' value='Matricular'>";
        echo "<br>";
        echo "<br>";
        echo "<table border='2'>";
        echo "<th>Selec</th><th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Edad</th><th>Telefono</th>";

        foreach ($alumnos as $clave => $linea) {
            $campos = explode(":", $linea);

            if (PasaFiltro($campos, $filtro))       //Si la fila de esos campos pasa el filro
            {
                echo "<tr>";

                echo "<td><input type='checkbox' name='Selec[$campos[0]]'></td>";

                foreach ($campos as $clave => $campo) {
                    echo "<td>$campo</td>";
                }

                echo "</tr>";
            }
        }

        echo "</table>";
        echo "</fieldset>";
    }

    ?>


    </form>


</body>

</html>