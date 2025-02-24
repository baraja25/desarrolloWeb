<?php 

session_start();
require_once "Database.php";

$password =  "";
$repeatPassword = -1;

$db = new Database();
if (!isset($_SESSION['usuario']) )
{
    header('Location: login.php');
}
else 
{
    echo "Introduce un nuevo pin<br>";

    $usuario = $_SESSION['usuario'];

    
    if (isset($_POST['Enviar'])) {
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        if (!strcmp($password, $repeatPassword)) {
            $password = sha1($password);
            $consulta = "UPDATE usuarios SET ClavePin = ? WHERE Usuario = ?";
            
            $statement = $db->query($consulta, [$password, $usuario]);
            echo "Contraseña actualizada correctamente";
            $consulta = "DELETE * from login";
            $statement = $db->query($consulta);
            header('Location: login.php');
        }
    }
     
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pin nuevo</title>
</head>
<body>
<form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <label for='password'>Nueva contraseña: </label><input type='password' name='password'>
        <label for='repeatPassword'>Repite nueva contraseña:</label><input type='password' name='repeatPassword'>
        <input type='submit' name='Enviar'>
    </form>
</body>
</html>