<html>

<?php

require_once 'libreria.php'; //Incluimos la librería de funciones

date_default_timezone_set('UTC'); // Aseguramos que use UTC

$db = new db('tema3'); //Creamos un objeto de la clase db

if (isset($_POST['Insertar']))   //Para dar de alta un nuevo alumno
{
    //Recogemos del formulario de edición los datos del alumno

    $nif = $_POST['NIF'];
    $nombre = $_POST['Nombre'];
    $Apellido1 = $_POST['Apellido1'];
    $Apellido2 = $_POST['Apellido2'];
    $Telefono = $_POST['Telefono'];
    $Premios = $_POST['Premios'];
    $FechaNac = $_POST['FechaNac'];

    $param = array();

    //Incluimos los valores dentro del array de parámetros de sustitución

    $param[':NIF'] = $nif;
    $param[':Nombre'] = $nombre;
    $param[':Apellido1'] = $Apellido1;
    $param[':Apellido2'] = $Apellido2;
    $param[':Telefono'] = $Telefono;
    $param[':Premios'] = $Premios;

    //La fecha hay que convertirla a Epoch

    $campos = explode("/", $FechaNac);

    $fecha = mktime(0, 0, 0, $campos[1], $campos[0], $campos[2]);

    $param[':FechaNac'] = $fecha;

    //Comprobamos si hemos introducido una imagen a modificar

    $conteFoto = "";

    if ($_FILES['Foto']['name'] != "") {
        $nombreTemp = $_FILES['Foto']['tmp_name'];

        $conteFoto = file_get_contents($nombreTemp);

        $conteFoto = base64_encode($conteFoto);

        $param[':Foto'] = $conteFoto;   // Y su valor al array de parámetros de sustitución

    }

    $consulta = "insert into Alumnos values(:NIF,:Nombre,:Apellido1,:Apellido2,:Telefono,:Premios,:FechaNac,:Foto)";

    $db->consultaSimple($consulta, $param);  //Ejecutamos la consulta de inserción


}






if (isset($_POST['Borrar']) && (isset($_POST['Selec'])))   //Si la acción solicitada era acutalizar y hemos marcado algún checkbox
{

    $selec = $_POST['Selec']; //Recogemos los checkbox marcados

    foreach ($selec as $clave => $valor) {
        $consulta = "Delete from Alumnos where NIF=:NIF ";

        $param = array();

        $param[":NIF"] = $clave;

        $db->consultaSimple($consulta, $param);  //Ejecutamos la consulta de borrado
    }
}

if (isset($_POST['Actualizar']) && (isset($_POST['Selec'])))   //Si la acción solicitada era acutalizar y hemos marcado algún checkbox
{
    $selec = $_POST['Selec']; //Recogemos los checkbox marcados

    //Recogemos los arrays con los datos de los alumnos

    $nombres = $_POST['Nombres'];
    $Apellido1s = $_POST['Apellido1s'];
    $Apellido2s = $_POST['Apellido2s'];
    $Telefonos = $_POST['Telefonos'];
    $Premioss = $_POST['Premioss'];
    $FechaNacs = $_POST['FechaNacs'];


    foreach ($selec as $clave => $valor) {
        $nombre = $nombres[$clave];
        $Apellido1 = $Apellido1s[$clave];
        $Apellido2 = $Apellido2s[$clave];
        $Telefono = $Telefonos[$clave];
        $Premios = $Premioss[$clave];
        $FechaNac = $FechaNacs[$clave];

        $consulta = " Update Alumnos set Nombre=:Nombre,
                                  Apellido1=:Apellido1,
                                  Apellido2=:Apellido2,
                                  Telefono=:Telefono,
                                  Premios=:Premios,
                                  FechaNac=:FechaNac ";

        $param = array();

        //Incluimos los valores dentro del array de parámetros de sustitución

        $param[':NIF'] = $clave;
        $param[':Nombre'] = $nombre;
        $param[':Apellido1'] = $Apellido1;
        $param[':Apellido2'] = $Apellido2;
        $param[':Telefono'] = $Telefono;
        $param[':Premios'] = $Premios;

        //La fecha hay que convertirla a Epoch

        $campos = explode("/", $FechaNac);

        $fecha = mktime(0, 0, 0, $campos[1], $campos[0], $campos[2]);

        $param[':FechaNac'] = $fecha;

        //Comprobamos si hemos introducido una imagen a modificar

        if ($_FILES['Fotos']['name'][$clave] != "") {
            $nombreTemp = $_FILES['Fotos']['tmp_name'][$clave];

            $conteFoto = file_get_contents($nombreTemp);

            $conteFoto = base64_encode($conteFoto);

            $consulta .= ",Foto=:Foto ";   //Añadimos el campo foto a la consulta de actualización

            $param[':Foto'] = $conteFoto;   // Y su valor al array de parámetros de sustitución

        }


        $consulta .= " Where NIF=:NIF ";

        $db->consultaSimple($consulta, $param);  //Ejecutamos la consulta de actualización


    }
}


$numeroPagina = 1; // por defecto mostramos la página 1

if (isset($_GET['numPag'])) {
    $numeroPagina = $_GET['numPag'];
}

$numReg = isset($_POST['numReg']) ? $_POST['numReg'] : 5;  //Número de registros a mostrar por página

$numReg = isset($_GET['numReg']) ? $_GET['numReg'] : $numReg;  //Número de registros cuando clicamos en siguiente o anterior

$inicio = ($numeroPagina - 1) * $numReg;  //Calculamos el registro por el que empezamos

//Obtenemos los datos de los alumnos

$consulta = "select * from Alumnos where 1 limit $inicio, $numReg ";

$param = array();

$db->consultaDeDatos($consulta, $param);

if (isset($_POST['Buscar']))   //Si se ha pulsado el botón de buscar
{

    $nif = $_POST['NIF'];
    $nombre = $_POST['Nombre'];
    $Apellido1 = $_POST['Apellido1'];
    $Apellido2 = $_POST['Apellido2'];
    $Telefono = $_POST['Telefono'];
    $Premios = $_POST['Premios'];
    $FechaNac = $_POST['FechaNac'];
    if ($nif != "") {
        $consulta .= " and NIF like :NIF ";
        $param[':NIF'] = '%' . $nif . '%';
    }
    if ($nombre != "") {
        $consulta .= " and Nombre like :Nombre ";
        $param[':Nombre'] = '%' . $nombre . '%';
    }
    if ($Apellido1 != "") {
        $consulta .= " and Apellido1 like :Apellido1 ";
        $param[':Apellido1'] = '%' . $Apellido1 . '%';
    }
    if ($Apellido2 != "") {
        $consulta .= " and Apellido2 like :Apellido2 ";
        $param[':Apellido2'] = '%' . $Apellido2 . '%';
    }
    if ($Telefono != "") {
        $consulta .= " and Telefono like :Telefono ";
        $param[':Telefono'] = '%' . $Telefono . '%';
    }
    if ($Premios != "") {
        $consulta .= " and Premios like :Premios ";
        $param[':Premios'] = '%' . $Premios . '%';
    }
    if ($FechaNac != "") {
        $campos = explode("/", $FechaNac);
        $FechaNac = mktime(0, 0, 0, $campos[1], $campos[0], $campos[2]);
        
        $consulta .= " and FechaNac=:FechaNac ";
        $param[':FechaNac'] = $FechaNac;
    }
    $consulta .= " limit $inicio, $numReg ";
    
    // $param[':inicio'] = (int)$inicio;

    // $param[':numReg'] = (int)$numReg;


    $db->consultaDeDatos($consulta, $param);
}


?>

<body>


    <?php


    echo "<fieldset>";

    echo "<form name='f1' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'  >";
    
    echo "<input type='submit' name='Actualizar' value='Actualizar'>";
    echo "<input type='submit' name='Borrar' value='Borrar'>";
    echo "<input type='submit' name='Insertar' value='Insertar'>";
    echo "<input type='submit' name='Buscar' value='Buscar'>";

    echo "Numero registros <select name='numReg' onchange='f1.submit()'>";
    echo "<option value=''></option>";

    for ($i = 1; $i <= 10; $i++) {
        echo "<option value='$i'";
        if ($i == $numReg) {
            echo " selected ";
        }

        echo ">$i</option>";
    }

    echo "</select>";

    echo "<table border='2'>";
    echo "<thead>";
    echo "<tr>";

    echo "<th>Selec</th>";
    echo "<th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Telefono</th><th>Premio</th><th>Fecha Nac</th><th>Foto</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    echo "<tr>";
    echo "<td><b>+</b></td>";
    echo "<td><input type='text' name='NIF' size='10'></td>";
    echo "<td><input type='text' name='Nombre' size='10'></td>";
    echo "<td><input type='text' name='Apellido1' size='10'></td>";
    echo "<td><input type='text' name='Apellido2' size='10'></td>";
    echo "<td><input type='text' name='Telefono' size='10'></td>";
    echo "<td><input type='text' name='Premios' size='10'></td>";
    echo "<td><input type='text' name='FechaNac' placeholder='dd/mm/yyyy' size='10'></td>";
    echo "<td><input type='file' name='Foto'></td>";




    echo "</tr>";

    foreach ($db->rows as $fila) {
        echo "<tr>";

        echo "<td><input type='checkbox' name='Selec[" . $fila['NIF'] . "]'></td>";

        foreach ($fila as $clave => $valor) {
            if ($clave == "FechaNac") {
                $campos = getdate($valor);

                $valor = $campos['mday'] . "/" . $campos['mon'] . "/" . $campos['year'];

                echo "<td><input type='text' name='" . $clave . 's[' . $fila['NIF'] . ']' . "' value='$valor'></td>";
            } elseif ($clave == "Foto") {
                $imagenConte = $fila['Foto'];   //Extraemos el contenido de la imagen

                echo "<td>";

                echo "<img src='data:image/jpg;base64,$imagenConte'   width='80' height='80'>";

                echo "<input type='file' name='" . $clave . 's[' . $fila['NIF'] . ']' . "'>";

                echo "</td>";
            } else {
                echo "<td><input type='text' name='" . $clave . 's[' . $fila['NIF'] . ']' . "' value='$valor' size='10' ";

                if ($clave == "NIF") {
                    echo " readonly='readonly' ";
                }
                echo "></td>";
            }
        }

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    echo "</form>";

    // mostramos los enlaces para avanzar y retroceder páginas

    $consulta = "select count(*) as total from Alumnos";
    $db->consultaDeDatos($consulta);
    $totalRegistros = $db->rows[0]['total'];
    $paginas = ceil($totalRegistros / $numReg);
    
    
    

    if ($numeroPagina > 1) {
        echo "<a href='?numPag=" . ($numeroPagina - 1) . "&numReg=$numReg'>Anterior</a> ";
    }

    if ($numeroPagina < $paginas) {
        echo "<a href='?numPag=" . ($numeroPagina + 1) . "&numReg=$numReg'>Siguiente</a>";
    }
    echo "</fieldset>";

    ?>



</body>

</html>