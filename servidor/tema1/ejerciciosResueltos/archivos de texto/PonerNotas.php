<html>

<body>

    <?php


    function teniaNotaModulo($clave, $mod, $cur, $notasArchivo)
    {
        $tenia = false;

        $linea = $notasArchivo[$clave];

        $campos = explode(":", $linea);

        if ($campos[1] = $mod && $campos[2] = $cur) {
            $tenia = true;
        }
        return $tenia;
    }

    function volcarNotas($notas)
    {
        $fd = fopen("notas.txt", "w") or die("Error al abrir el archivo");

        foreach ($notas as $key => $linea) {
            fputs($fd, $linea);
        }


        fclose($fd);
    }

    function obtenerNotas()
    {
        $notas = array();   //Array con las lineas del archivo

        if (file_exists("notas.txt")) {
            $fd = fopen("notas.txt", "r") or die("Error al abrir el archivo");

            //Mostramos el contenido del archivo

            while (!feof($fd))     //Mientras No  llegado al fin del archivo
            {
                $linea = fgets($fd); //Extraemos una linea de ese archivo

                $campos = explode(":", $linea); //Separamos la linea en campos

                if (count($campos) == 4)   //Solo queremos la lienas con los 6 campos del alumno
                {
                    $notas[$campos[0]] = $linea; //Guardamos ese linea en el array de alumnos
                }
            }

            fclose($fd);

            return  $notas;
        }
    }

    function ponerNota($clave, $mod, $cur, $nota)
    {

        global $notasArchivo;

        $salto = "\r\n";

        $linea = "$clave:$mod:$cur:$nota" . $salto;

        $notasArchivo[$clave] = $linea;
    }


    function ObtenerMatriculados($mod, $cur)
    {
        $alumnosMatri = array();

        $alumnos = ObtenerAlumnos();   //Obtenemos los datos de todos los alumnos

        $fd = fopen("Matricula.txt", "r") or die("Error al abrir el archivo");

        while (!feof($fd)) {
            $linea = fgets($fd);

            $campos = explode(":", $linea);

            if (count($campos) == 3)       //Filtramos posibles lineas con menos campos(con caracteres especiales)
            {
                if ((trim($mod) == trim($campos[1])) && (trim($cur) == trim($campos[2])))    //Si en esa matricula conincie el curso y el modulo
                {
                    $lineaAlu = $alumnos[$campos[0]];   //Recuperamos la linea con los datos de ese alumno

                    $camposAlu = explode(":", $lineaAlu);

                    $alumnosMatri[$campos[0]] = "$camposAlu[2]:$camposAlu[3]:$camposAlu[1]:$camposAlu[4]:$camposAlu[5]";;  //Guardamos en el array de matriculados la linea del alumno con ese dni   
                }
            }
        }

        asort($alumnosMatri); //Ordenamos por valor manteniendo la clave

        fclose($fd);

        return  $alumnosMatri;
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

        $fd = fopen("Modulos.txt", "r") or die("Error al abrir el archivo");

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



    //Comprobamos los datos recibidos tras la recarga



    $mod = "";

    if (isset($_GET['Modulo']))   //Si tras la recarga recibimos un módulo
    {
        $mod = $_GET['Modulo'];
    }

    $cur = "";

    if (isset($_GET['Curso']))   //Si tras la recarga recibimos un módulo
    {
        $cur = $_GET['Curso'];
    }

    if (isset($_GET['Calificar'])) {
        $notas = $_GET["notas"];

        $notasArchivo = obtenerNotas();

        foreach ($notas as $key => $nota) {
            if ($nota != "") {
                ponerNota($key, $mod, $cur, $nota);
            }
        }

        volcarNotas($notasArchivo);
    }

    ?>


    <fieldset>
        <legend>Calificación de alumnos</legend>
        <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">

            Modulo<select name='Modulo'>
                <option value=''></option>

                <?php

                //Recuperamos los datos los modulos

                $modulos = ObtenerModulos();  //Obtenemos los alumnos matriculados en ese modulo y curso

                foreach ($modulos as $clave => $modulo) {
                    $campos = explode(":", $modulo);

                    echo "<option value='$campos[0]'  ";

                    if ($mod == $campos[0]) {
                        echo " selected ";
                    }
                    echo ">$campos[1]</option>";
                }

                ?>

            </select>

            Curso<select name='Curso'>
                <option value=''></option>
                <?php

                $cursos = array('2020', '2021', '2022', '2023', '2024', '2025');

                foreach ($cursos as $clave => $curso) {
                    echo "<option value='$clave'  ";

                    if ($cur == $campos[0]) {
                        echo " selected ";
                    }
                    echo ">$curso</option>";
                }

                ?>

            </select>

            <input type='submit' name='Mostrar' value='Mostrar Alumnos'>

    </fieldset>

    <?php

    if (isset($_GET['Mostrar'])) {

        echo "<fieldset><legend>Alumnos Calificables</legend>";

        echo "<table border='2'>";
        echo "<th>Apellido1</th><th>Apellido2</th><th>Nombre</th><th>Nota</th>";

        $alumnos = ObtenerMatriculados($mod, $cur);  //Obtenemos los alumnmos matriculados para ese curso y ese modulo

        foreach ($alumnos as $clave => $linea) {
            $campos = explode(":", $linea);

            echo "<tr>";

            echo "<td>$campos[0]</td><td>$campos[1]</td><td>$campos[2]</td>";

            $notaAlumno = "";

            if (teniaNotaModulo($clave, $mod, $cur, $notasArchivo) != false) {

                $lineaNot = $notasArchivo[$clave];

                $camposNot = explode(":", $lineaNot);

                $notaAlumno = $camposNot[3];
            }


            echo "<td><input type='text' size='3' name='notas[$clave]' value='$notaAlumno'></td>";

            echo "</tr>";
        }

        echo "</table>";

        echo "<input type='submit' name='Calificar' value='Calificar'>";

        echo "</fieldset>";
    }

    ?>



    </form>


</body>

</html>