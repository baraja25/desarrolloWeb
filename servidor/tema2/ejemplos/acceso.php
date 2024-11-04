

<?php
// Insertar datos simple
// Conectar al servidor BBDD

$host = "localhost";

$user = "root";

$pass = "";

$base = "tema2";


$db = mysqli_connect($host, $user, $pass, $base); // Conexion al servidor de base de datos y devuelve el decriptor de conexion

$consulta = "INSERT INTO alumnos VALUES('33333333C','Maria', 'Lopez', 'Ruiz','444444444')";

$resultado = mysqli_query($db,$consulta);

if ($resultado == false) {
    echo "Error al hacer la consulta". mysqli_error($db);
}

mysqli_close($db);


?>