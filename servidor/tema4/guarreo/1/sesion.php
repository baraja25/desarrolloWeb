<?php

    $_SESSION['nombre'] = "Pepe";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sesión</title>
</head>
<body>
    <?php
        session_start();
        if (isset($_SESSION['nombre'])) {
            echo "Hola " . $_SESSION['nombre'];
        } else {
            echo "Hola desconocido";
        }
        session_destroy();
    ?>
</html>