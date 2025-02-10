<html>
<body>

<?php

function mostrarForm($nif) 
{
    global $pdo; 
    
    $consulta = "SELECT * FROM Alumnos WHERE NIF = :NIF";  
    $param = [":NIF" => $nif];
    
    $sta = $pdo->prepare($consulta);
    $sta->execute($param);
    $fila = $sta->fetch(PDO::FETCH_ASSOC);  // Extraemos la fila con los datos de ese alumno
    
    echo "<fieldset>";
    echo "<form name='f1' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>";
    
    foreach ($fila as $clave => $valor) {
        if ($clave == "FechaNac") {
            $campos = getdate($valor);
            $valor = $campos['mday'] . "/" . $campos['mon'] . "/" . $campos['year'];
            echo "$clave<input type='text' name='$clave' value='$valor'><br>";
        } elseif ($clave == "Foto") {
            $imagenConte = $fila['Foto'];   // Extraemos el contenido de la imagen
            echo "<img src='data:image/jpg;base64,$imagenConte' width='80' height='80'>";
            echo "<input type='file' name='$clave'><br>";
        } else {
            echo "$clave<input type='text' name='$clave' value='$valor'";
            if ($clave == 'NIF') {
                echo " readonly='readonly'";   
            }
            echo "><br>";
        } 
    }
    
    echo "<input type='submit' name='Modificar' value='Modificar'>";
    echo "</form>";  
    echo "<br>";
    echo "<a href='crud.php'>Volver</a>";
    echo "</fieldset>";
}

// Incluimos el código necesario para conectar
$host = "localhost";
$user = "root";
$pass = "";
$base = "Tema3";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$nif = isset($_POST['NIF']) ? $_POST['NIF'] : "";

if (isset($_POST['Alta'])) {   // Para dar de alta un nuevo alumno
    $param = [
        ':NIF' => $nif,
        ':Nombre' => $_POST['Nombre'],
        ':Apellido1' => $_POST['Apellido1'],
        ':Apellido2' => $_POST['Apellido2'],
        ':Telefono' => $_POST['Telefono'],
        ':Premios' => $_POST['Premios'],
        ':FechaNac' => mktime(0, 0, 0, ...explode("/", $_POST['FechaNac']))
    ];
    
    if ($_FILES['Foto']['name'] != "") {
        $conteFoto = base64_encode(file_get_contents($_FILES['Foto']['tmp_name']));
        $param[':Foto'] = $conteFoto;
    }
    
    $consulta = "INSERT INTO Alumnos VALUES (:NIF, :Nombre, :Apellido1, :Apellido2, :Telefono, :Premios, :FechaNac, :Foto)";
    $sta = $pdo->prepare($consulta);
    $sta->execute($param);   // Ejecutamos la consulta de actualización
    
    mostrarForm($nif);   // Que muestre el formulario con los datos nuevos que hemos insertado
}

if (isset($_POST['Modificar'])) {   // Si queremos modificar los datos del formulario
    $param = [
        ':NIF' => $nif,
        ':Nombre' => $_POST['Nombre'],
        ':Apellido1' => $_POST['Apellido1'],
        ':Apellido2' => $_POST['Apellido2'],
        ':Telefono' => $_POST['Telefono'],
        ':Premios' => $_POST['Premios'],
        ':FechaNac' => mktime(0, 0, 0, ...explode("/", $_POST['FechaNac']))
    ];
    
    $consulta = "UPDATE Alumnos SET Nombre = :Nombre, Apellido1 = :Apellido1, Apellido2 = :Apellido2, Telefono = :Telefono, Premios = :Premios, FechaNac = :FechaNac";
    
    if ($_FILES['Foto']['name'] != "") {
        $conteFoto = base64_encode(file_get_contents($_FILES['Foto']['tmp_name']));
        $consulta .= ", Foto = :Foto";
        $param[':Foto'] = $conteFoto;
    }
    
    $consulta .= " WHERE NIF = :NIF";
    $sta = $pdo->prepare($consulta);
    $sta->execute($param);   // Ejecutamos la consulta de actualización
    
    mostrarForm($nif);   // Que muestre el formulario con los datos actualizados  
}

if (isset($_POST['Borrar'])) {   // Si la acción solicitada era borrar
    $consulta = "DELETE FROM Alumnos WHERE NIF = :NIF";  
    $param = [":NIF" => $nif];
    $sta = $pdo->prepare($consulta);
    $sta->execute($param);
}

if (isset($_POST['Actualizar'])) {   // Si la acción solicitada era actualizar
    mostrarForm($nif);   // Mostramos un formulario de edición con los datos de ese NIF
}

$pdo = null;  // Cerramos la conexión

?>

</body>
</html>