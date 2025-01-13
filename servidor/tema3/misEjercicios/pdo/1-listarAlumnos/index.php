<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=tema3', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $th) {
    echo $th->getMessage();
}

$consulta = "SELECT * FROM alumnos";

$statement = $pdo->prepare($consulta);

$statement->execute();

$alumnos = $statement->fetchAll(PDO::FETCH_ASSOC);


require 'index.view.php';
