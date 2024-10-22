<html>

<body>
    <?php
    // al seleccionar modulo y año tiene que salir los alumnos matriculados. Al salir los alumnos en la tabla un texto para añadirle nota

    
    function ObtenerAlumnos()
    {
        $alumnos = array();   //Array con las lineas del archivo

        $fd = fopen("matricula.txt", "r") or die("Error al abrir el archivo");

        //Mostramos el contenido del archivo

        while (!feof($fd))     //Mientras No  llegado al fin del archivo
        {
            $linea = fgets($fd); //Extraemos una linea de ese archivo

            $campos = explode(":", $linea); //Separamos la linea en campos

            if (count($campos) == 3)   //Solo queremos la lienas con los 6 campos del alumno
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
    $modulo = "";

    if (isset($_GET['modulo'])) {
        $modulo = $_GET['modulo'];
    }

    ?>
    <fieldset>
        <legend>Calificacion de alumnos</legend>
        <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
            <?php
            $alumnos = ObtenerAlumnos();
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

            echo "Variable modulo: $modulo";
            echo "Variable curso: $curso";
            ?>
            <input type="submit" value="mostrar alumnos" name="mostrarAlumnos">
    </fieldset>

    </form>
</body>

</html>