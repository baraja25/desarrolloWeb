<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=tema3', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $th) {
    echo $th->getMessage();
}

$parametros = array();
$nombre = 'Elena';

$consulta = "SELECT * FROM alumnos where Nombre = :nombre";


$parametros[':nombre'] = $nombre;

$statement = $pdo->prepare($consulta);

$statement->execute($parametros);

$alumnos = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($alumnos as $alumno) {
    echo $alumno['Nombre'] . ' ' . $alumno['Apellido1'] . '<br>';
}