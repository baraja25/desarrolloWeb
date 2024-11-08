<html>

<?php

$host = "localhost";

$user = "root";

$pass = "";

$base = "tema2";

$db = mysqli_connect($host, $user, $pass, $base);   //Nos conectamos a ese servidor de base de datos y recibimos el descriptor de conexio

function MostrarForm($nif)
{
    global $alumnos; //accedemos al array que tiene los datos de los alumnos


    echo "<fieldset><legend>Datos del alumno</legend> ";

    echo "NIF<input type='text' name='NIF' value='$nif' readonly='readonly'><br>";

    $fila = $alumnos[$nif];

    echo "Nombre<input type='text' name='Nombres[$nif]' value='$fila[Nombre]'><br>";
    echo "Apellido1<input type='text' name='Apellidos1[$nif]' value='$fila[Apellido1]'><br>";
    echo "Apellido2<input type='text' name='Apellidos2[$nif]' value='$fila[Apellido2]'><br>";

    echo "Telefono<input type='text' name='Telefonos[$nif]' value='$fila[telefono]'><br>";

    echo "</fieldset>";
}

if (isset($_POST['Actualizar']))  //si le hemos dado a actualizar alumno
{

    $nombres = $_POST['Nombres'];
    $apellidos1 = $_POST['Apellidos1'];
    $apellidos2 = $_POST['Apellidos2'];
    $telefonos = $_POST['Telefonos'];

    foreach ($nombres as $key => $value) {
        $consulta = "update Alumnos set Nombre='$nombres[$key]',
                                  Apellido1='$apellidos1[$key]',
                                  Apellido2='$apellidos2[$key]',
                                  Telefono='$telefonos[$key]'
                                    where NIF='$key' ";
        $resul = mysqli_query($db, $consulta);
    }





    if ($resul) {
        echo "Registro actualizado correctamente";
    } else {
        echo mysqli_error($db);
    }
}

//Obtenemos los alumos para el desplegable


$alumnos = array();

$consulta = "select * from Alumnos";

$resul = mysqli_query($db, $consulta);

if ($resul)  //Si ha resultado
{
    while ($alumno = mysqli_fetch_assoc($resul)) {
        $alumnos[$alumno['NIF']] = $alumno;
    }
} else {
    echo "Error:" . mysqli_error($db);
}
/*
$alu="";  //Inicilizamos la variable alu para el NIF del alumno seleccionado

if (isset($_POST['Alumno']) )  //Comprobamos si hay un alumnos previamente seleccionado
{
    $alu=$_POST['Alumno'];
}
*/



mysqli_close($db);

?>

<body>

    <fieldset>
        <legend>Seleccione alumno</legend>
        <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>">



            <?php

            echo "<table border='2'>";
            echo "<th>Selec</th><th>Alumno</th>";

            foreach ($alumnos as $alumno) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='Selec[$alumno[NIF]]'></td><td></td><td>$alumno[Apellido1], $alumno[Nombre]</td>";


                echo "</tr>";
            }
            echo "</table>";
            ?>




            <input type="submit" name="Mostrar" value="Mostrar">
            <input type='submit' name='Actualizar' value='Actualizar'>
    </fieldset>

    <?php


    if (isset($_POST['Mostrar']) && (isset($_POST['Selec'])))  //Comprobamos si hay un alumnos previamente seleccionado
    {
        $select = $_POST['Selec'];

        foreach ($select as $key => $value) {
            MostrarForm($key);
        }
    }


    ?>

    </form>
</body>

</html>