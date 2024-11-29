<?php
require_once "misc.php";
//declaracion de variables
$datosArchivo1 = array();
$datosArchivo2 = array();
$datosArchivo3 = array();
$repeticiones = array();
$titulos = ["Palabras", "Repeticiones"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
</head>

<body>
    <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post" name="f1">
        <?php
        //datos para mostrar en la tabla principal
        $datos = [
            ["archivos" => 'palabra1.txt'],
            [2 => 'palabras2.txt'],
            [3 => 'palabras3.txt'],
        ];
        generarTablaConCheckboxes($datos, "archivos");
        ?>
        <input type="submit" value="Mostrar rep" name="mostrarRep">

        <?php
    

        if (isset($_POST['mostrarRep']) && isset($_POST['archivos'])) {
            $checkboxesMarcados = $_POST['archivos'];
            
            $datosArchivo1 = ObtenerDatosDeArchivo("Palabras1.txt", " ", 1);
            $datosArchivo2 = ObtenerDatosDeArchivo("Palabras2.txt", " ", 1);
            $datosArchivo3 = ObtenerDatosDeArchivo("Palabras3.txt", " ", 1);
            
            //Contar($datosArchivo1, $repeticiones);

            foreach ($checkboxesMarcados as $valor) {
                //si ha marcado el primer checkbox
                if ($valor == 0) {
                    echo "<table border='2'>";
                    echo "<th><a href='?ordenar='>Palabra</a></th><th><a href='?repetida='>Repetida</a></th></th>";
                    // se que tenia que coger el valor de una variable pero no recuerdo cual tenia que poner
                    foreach ($datosArchivo1 as $key => $value) {
                        echo "<tr>";
                        echo "<td>$key</td><td>1</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                echo "<br>";
                //si ha marcado el segundo checkbox
                if ($valor == 1) {
                    echo "<table border='2'>";
                    echo "<th><a href='?ordenar='>Palabra</a></th><th><a href='?repetida='>Repetida</a></th></th>";
                    foreach ($datosArchivo2 as $key => $value) {
                        echo "<tr>";
                        echo "<td>$key</td><td>1</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                echo "<br>";
                //si ha marcado el tercer checkbox
                if ($valor == 2) {
                    echo "<table border='2'>";
                    echo "<th><a href='?ordenar='>Palabra</a></th><th><a href='?repetida='>Repetida</a></th></th>";
                    foreach ($datosArchivo3 as $key => $value) {
                        echo "<tr>";
                        echo "<td>$key</td><td>1</td>";
                        echo "</tr>";
                    }
                    
                    echo "</table>";
                }
            }
        }
        
        
        ?>

    </form>
</body>

</html>