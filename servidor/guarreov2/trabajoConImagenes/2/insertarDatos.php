<?php
require_once 'Database.php';
$db = new Database();
$marcas = $db->query('SELECT * FROM marcascoches')->fetchAll();


if (isset($_POST['guardar'])) {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $matricula = $_POST['matricula'];
    $fechaMatricula = strtotime($_POST['fechaMatricula']);
    $num_fotos = isset($_POST['num_fotos']) ? intval($_POST['num_fotos']) : 0;

    // Insert data into coches table
    $db->query('INSERT INTO coches (marca, modelo, precio, matricula, fechaMatri) VALUES (?, ?, ?, ?, ?)', [$marca, $modelo, $precio, $matricula, $fechaMatricula]);
    $cocheId = $db->query('SELECT LAST_INSERT_ID()')->fetchColumn();

    // Insert data into fotoscoche table
    for ($i = 1; $i <= $num_fotos; $i++) {
        if (isset($_FILES['foto' . $i]) && $_FILES['foto' . $i]['error'] == UPLOAD_ERR_OK) {
            $foto = $_FILES['foto' . $i]['tmp_name'];
            $fotoNombre = basename($_FILES['foto' . $i]['name']);
            $fotoDestino = 'coches/' . $fotoNombre;
            move_uploaded_file($foto, $fotoDestino);
            $db->query('INSERT INTO fotoscoche (IdCoche, Foto) VALUES (?, ?)', [$cocheId, $fotoNombre]);
        }
    }

    echo "Datos insertados correctamente.";
}


require 'insertar.view.php';
?>


