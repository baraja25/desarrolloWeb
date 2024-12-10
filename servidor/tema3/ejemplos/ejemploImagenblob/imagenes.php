<html>
<?php

require_once 'libreria.php';

if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];

    //como recoger las imagenes

    if ($_FILES['imagen']['name'] != "") {
        $nombreOriginal = $_FILES['imagen']['name'];
        $nombreTemporal = $_FILES['imagen']['tmp_name'];
        if ($_FILES['imagen']['size'] < (16*1024*1024)) {
            $imagenCampo = file_get_contents($nombreTemporal);
            $imagenCampo = base64_encode($imagenCampo);  //formatea el contenido en base 64
        } else {
            echo "el tamaño maximo de la imagen es de 16mb";
        }

        $consulta = "INSERT INTO marcas VALUES (NULL, '$nombre', '$imagenCampo')";
        consultaSimple($consulta);
    }
}


?>

<body>

    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype="multipart/form-data">
        Nombre <input type="text" name="nombre"><br>
        Imagen <input type="file" name="imagen"><br>



        <input type='submit' name='guardar' value='Guardar'>


    </form>
</body>







</html>