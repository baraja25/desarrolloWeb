<?php
// mira no se que cojones hace este tio, no sube lo que hace y encima recicla ese codigo que no sube asique no le puedo seguir me cago en dios
require_once 'daoClientes.php';
$db = "tienda";
$daoClientes = new DaoClientes($db);
$nif = "";

if (isset($_POST["Cliente"])) {
    $nif = $_POST["Cliente"];
}


?>

<body>

    <fieldset>
        <legend>Seleccionar cliente</legend>
        <form name='f1' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

            <?php





            ?>
            <input type='submit' name='Actualizar' value='Actualizar'>
        </form>
    </fieldset>
</body>

</html>