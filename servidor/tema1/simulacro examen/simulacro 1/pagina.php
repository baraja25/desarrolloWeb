<?php
/* 1. Realizar una página .php que contenga un formulario con los siguientes campos:
-Un campo de texto llamado Archivo1 en el que se deberá introducir el nombre de un archivo de texto.
-Un campo de texto llamado Archivo2 en el que se deberá introducir el nombre de otro archivo de texto.
-Un control RadioButton con dos opciónes “Palabras Están” y “Palabras No Están”
-Un botón llamado Mostrar que al pulsarlo mostrará por pantalla las palabras del archivo 1 que estén en el archivo 2 en caso de seleccionar en el radio la primera 
opción.
En caso de seleccionar la segunda mostrará las palabras del archivo1 que no estén en el archivo 2. */

?>
<?php
function obtenerPalabras($nombre)
{

    $fd = fopen("$nombre.txt", "r") or die("Error al abrir el archivo");

    //Mostramos el contenido del archivo

    while (!feof($fd))     //Mientras No  llegado al fin del archivo
    {
        $linea = fgets($fd); //Extraemos una linea de ese archivo

        $campos = explode(":", $linea); //Separamos la linea en campos
    }

    fclose($fd);

    return  $campos;
}
function generarPalabraAleatoria()
{
    $palabras = ['Manzana', 'Platano', 'Pera', 'Mango', 'Fresa', 'Kiwi', 'Naranja'];
    return $palabras[array_rand($palabras)];
}
function crearArchivo($nombre)
{
    $fd = fopen($nombre . ".txt", "w");
    $resultado = '';
    for ($i = 0; $i < 10; $i++) {
        $resultado .= generarPalabraAleatoria() . ":";
    }
    $resultado = rtrim($resultado, ":");

    fputs($fd, $resultado);

    fclose($fd);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" name="f1">

        <input type="text" name="archivo1" id="archivo1">
        <input type="text" name="archivo2" id="archivo2">
        <br>
        <input type="radio" name="Palabras" id="Palabras" value="1" checked> Palabras estan
        <input type="radio" name="Palabras" id="Palabras" value="2"> Palabras no estan
        <input type="submit" value="Mostrar" name="mostrarDatos">
        <?php
        $archivo1 = "";
        $archivo2 = "";

        if (isset($_GET['mostrarDatos'])) {
            $archivo1 = $_GET['archivo1'];
            $archivo2 = $_GET['archivo2'];
            $radioSeleccion = $_GET['Palabras'];


            if (!$archivo1 == "" || !$archivo2 == "") { //solo crear si hay algo escrito en los campos
                crearArchivo($archivo1);
                crearArchivo($archivo2);
                $palabrasArchivo1 = obtenerPalabras($archivo1);
                $palabrasArchivo2 = obtenerPalabras($archivo2);


                if ($radioSeleccion == 1) { // mostrar las palabras si estan
                    $coincidencias = array_intersect($palabrasArchivo1, $palabrasArchivo2);

                    $coincidenciasUnicas = array_unique($coincidencias);

                    foreach ($coincidenciasUnicas as $coincidencia) {
                        echo "$coincidencia ";
                    }
                }

                if ($radioSeleccion == 2) { // mostrar las que no estan
                    $diferencias = array_diff($palabrasArchivo1, $palabrasArchivo2);

                    $diferenciasUnicas = array_unique($diferencias);

                    foreach ($diferenciasUnicas as $diferencia) {
                        echo "$diferencia ";
                    }
                }
            }
        }
        ?>
    </form>
</body>

</html>