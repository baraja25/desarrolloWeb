<html>
<?php

require_once 'libreria.php';

if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];

    //como recoger las imagenes

    if ($_FILES['imagen']['name'] != "") {
        $nombreOriginal = $_FILES['imagen']['name'];
        $nombreTemporal = $_FILES['imagen']['tmp_name'];
        copy($nombreTemporal, "img/$nombreOriginal"); //copia el archivo temporal a la carpeta que yo le ponga con el nombre original
        $consulta = "INSERT INTO marcas VALUES (NULL, '$nombre', '$nombreOriginal')";
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