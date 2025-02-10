<?php
    setcookie('nombre', 'Pepe', time() + 3600);
?>

<html>
<head>
    <title>Cookie</title>
</head>
<body>
    <?php
        if (isset($_COOKIE['nombre'])) {
            echo "Hola " . $_COOKIE['nombre'];
        } else {
            echo "Hola desconocido";
        }
    ?>
</html>
