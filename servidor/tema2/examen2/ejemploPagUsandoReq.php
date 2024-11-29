<?php
// Incluir el archivo de paginación
require_once 'paginacion.php';

// Parámetros de conexión a la base de datos
$host = 'localhost';
$user = 'root';
$pass = '';
$base = 'tema2';
$tabla = 'Alumnos';

// Obtener el número de registros por página y la página actual desde la URL
$num = isset($_GET['Numero']) ? (int)$_GET['Numero'] : 5;
$pagina = isset($_GET['Pag']) ? (int)$_GET['Pag'] : 1;

// Llamar a la función de paginación
paginacion($host, $user, $pass, $base, $tabla, $num, $pagina);
?>