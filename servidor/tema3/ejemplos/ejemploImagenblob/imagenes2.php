<html>
<?php

require_once 'libreria.php';
?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype="multipart/form-data">
        <img src="d" alt="" srcset="">
        
        <?php
        $consulta = "SELECT * FROM marcas";
        $filas = consultaDatos($consulta);
        echo "<table border='1'>";
        echo "<th>Nombre</th><th>Imagen</th>";
        foreach ($filas as $fila) {
            echo "<tr>";
            echo "<td>$fila[Nombre]</td>";
            $imagenCampo = $fila['Imagen'];
            echo "<td><img src='data:image/jpg;base64,$imagenCampo' width='80' height='80'></td>";
            echo "</tr>";
        }
        echo "</table>";

        ?>
    </form>
</body>







</html>