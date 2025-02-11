<?php

function comprobarIntento($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

session_start();



$servername = "localhost";
$dbname = "tienda";
$dbusername = "root";
$dbpassword = "";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





if (isset($_POST['Enviar'])) {
    $username = $_POST['username'];
    $hashedPassword = sha1($_POST['password']);
    if (comprobarIntento($_POST['username'], $hashedPassword)) {
        $stmt = $conn->prepare("INSERT INTO login (Usuario, Clave, Hora, Acceso) VALUES (?, ?, ?, ?)");
        $hora = time();
        $acceso = 'C';
        $stmt->bind_param("ssss", $_POST['username'], $hashedPassword, $hora, $acceso);
        $stmt->execute();
        $_SESSION['username'] = $_POST['username'];
        header('Location: menu.php');
    } else {
        $stmt = $conn->prepare("INSERT INTO login (Usuario, Clave, Hora, Acceso) VALUES (?, ?, ?, ?)");
        $hora = time();
        $acceso = 'D';
        $stmt->bind_param("ssss", $_POST['username'], $hashedPassword, $hora, $acceso);
        $stmt->execute();
        echo 'Usuario o contraseña incorrectos';
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Iniciar sesión" name="Enviar">
    </form>
</body>

</html>