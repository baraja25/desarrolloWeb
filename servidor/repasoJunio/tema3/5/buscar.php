<?php
require_once("CochesDao.php");

$cochesDao = new CochesDao(); // Creamos una instancia de la clase CochesDao
$cochesDao->listarCoches(); // Llamamos al método para listar coches

// Verificamos si se ha enviado el formulario de búsqueda
if (isset($_POST["buscar"])) {

    // Recogemos los valores enviados por el formulario
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $precioMaximo = $_POST["precioMaximo"];
    $precioMinimo = $_POST["precioMinimo"];

    // Iniciamos la construcción de la consulta SQL
    $coches = $cochesDao->buscarCoche($marca, $modelo, $precioMaximo, $precioMinimo);

    // Verificamos si se encontraron resultados
    if (count($coches) > 0) {
        // Si hay resultados, mostramos una tabla con ellos
        echo "<h2>Resultados de la búsqueda:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Modelo</th><th>Precio</th><th>Matricula</th></tr>";
        foreach ($coches as $coche) {
            // Recorremos cada coche encontrado y lo mostramos en una fila
            echo "<tr>";
            echo "<td>" . $coche["id"] . "</td>";
            echo "<td>" . $coche["nombre"] . "</td>";
            echo "<td>" . $coche["marca"] . "</td>";
            echo "<td>" . $coche["modelo"] . "</td>";
            echo "<td>" . $coche["precio"] . "</td>";
            echo "<td>" . $coche["matricula"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // Si no hay resultados, mostramos un mensaje informativo
        echo "<h2>No se encontraron resultados.</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>

<body>
    <!-- Formulario de búsqueda -->
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <!-- Campo para la marca -->
        <label for="marca">Marca: </label>
        <input type="text" name="marca" id="marca"><br>

        <!-- Campo para el modelo -->
        <label for="modelo">Modelo: </label>
        <input type="text" name="modelo" id="modelo"><br>

        <!-- Campo para el precio máximo -->
        <label for="precioMaximo">Precio maximo: </label>
        <input type="number" name="precioMaximo" id="precioMaximo"><br>

        <!-- Campo para el precio mínimo -->
        <label for="precioMinimo">Precio minimo: </label>
        <input type="number" name="precioMinimo" id="precioMinimo"><br>

        <!-- Botón para enviar el formulario -->
        <input type="submit" value="Buscar" name="buscar"><br>
    </form>
</body>

</html>