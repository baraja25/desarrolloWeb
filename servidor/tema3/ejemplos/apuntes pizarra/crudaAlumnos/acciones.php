<?php
function mostrarFormulario($nif) {
    global $pdo;
    $consulta = "SELECT * FROM alumnos WHERE NIF = :NIF";
    $parametros = array(":NIF" => $nif);
    $statement = $pdo->prepare($consulta);
    $statement->execute($parametros);
    $alumno = $statement->fetch(PDO::FETCH_ASSOC);
    
    ?>
    <form action="index.php" method="post">
        <input type="hidden" name="nif" value="<?php echo $alumno['NIF']; ?>">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?php echo $alumno['Nombre']; ?>"><br>
        <label for="apellido1">Apellido1</label>
        <input type="text" name="apellido1" value="<?php echo $alumno['Apellido1']; ?>"><br>
        <label for="apellido2">Apellido2</label>
        <input type="text" name="apellido2" value="<?php echo $alumno['Apellido2']; ?>"><br>
        <label for="telefono">Telefono</label>
        <input type="text" name="telefono" value="<?php echo $alumno['Telefono']; ?>"><br>
        <input type="submit" name="Actualizar" value="Actualizar">
    </form>
    <?php
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=tema3', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $th) {
    echo $th->getMessage();
}

// pagina que ejecuta las acciones del crud
$nif = isset($_POST['nif']) ? $_POST['nif'] : "";

if (isset($_POST['Borrar'])) {

    $consulta = "DELETE FROM alumnos WHERE NIF = :NIF";

    $parametros = array(":NIF" => $nif);

    $pdo->prepare($consulta)->execute($parametros);
}


if (isset($_POST['Actualizar'])) {
    mostrarFormulario($nif);
}


$pdo = null;