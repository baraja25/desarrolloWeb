<?php 
session_start();

require_once 'Database.php';

$db = new Database();

function MenorInterv($filas, $intervalo) {
    $inicio = $filas[2]['Hora']; // Obtenemos la hora del primer intento de login
    $diferencia = time() - $inicio; // Restamos a la hora actual la del login inicial
    return ($diferencia <= $intervalo); // Los intentos se han realizado en menor tiempo que el intervalo permitido
}

function TresDeneg($filas) {
    $denegados = FALSE;
    $cont = 0;
    
    if (count($filas) >= 3) {
        reset($filas); // Ponemos el puntero del array apuntando al principio de array
    
        while (($fila = current($filas)) !== FALSE && $fila['Acceso'] == "D") {
            $cont++;
            next($filas);
        }
     
        $denegados = ($cont == 3);
    }
      
    return $denegados;
}

function Bloqueado($usu) {
    global $db;  
    $bloqueado = FALSE; // Suponemos por defecto que no está bloqueado
    $consulta = "SELECT Hora, Acceso FROM login WHERE Usuario = :Usuario ORDER BY Hora DESC LIMIT 3";
    $param = array(":Usuario" => $usu);
    
    $statement = $db->query($consulta, $param); 
    $filas = $statement->fetchAll(); // Guardamos en un array local las filas
    $bloqueado = -1; // Suponemos por defecto que no está bloqueado
    $tiempoBloqueo = 300; // Establecer cuanto tiempo tiene que estar bloqueado ese usuario
   
    if (TresDeneg($filas)) { // Si tiene tres denegaciones podría estar bloqueado
        $intervalo = 300; // Fijamos el intervalo de tiempo en 300 segundos
        if (MenorInterv($filas, $intervalo)) { // Si las ha cometido dentro de ese intervalo de tiempo
            $bloqueado = $filas[0]['Hora'] + $tiempoBloqueo; // Almacenamos la hora hasta la que se encuentra bloqueado
        }
    }
   
    return $bloqueado;
}

function IntentoLogin($usu, $cla) {
    global $db;
    $consulta = "SELECT COUNT(*) AS cuenta FROM usuarios WHERE usuario = :usuario AND contrasena = :contrasena";
    $param = array(":usuario" => $usu, ":contrasena" => $cla);
    
    $statement = $db->query($consulta, $param);
    $fila = $statement->fetch(); // Obtenemos la fila
    return $fila;  
}

function InsertarLogin($usu, $cla, $acceso) {
    global $db;
    $consulta = "INSERT INTO login VALUES (:Usuario, :Clave, :Hora, :Acceso)";
    $param = array(
        ":Usuario" => $usu,
        ":Clave" => $cla,
        ":Hora" => time(), // Cogemos la hora actual Epoch
        ":Acceso" => $acceso
    );
    $db->query($consulta, $param);
}

if (isset($_POST['Enviar'])) {
    $usu = $_POST['Usuario'];
    $cla = sha1($_POST['Clave']); // Cogemos la clave pero aplicándole el cifrado correspondiente
    
    $bloqueado = Bloqueado($usu); // Comprobamos si está bloqueado
    
    if ($bloqueado == -1) { // Si no está bloqueado le dejamos hacer un intento de login
        $fila = IntentoLogin($usu, $cla); 
   
        if ($fila['cuenta'] == 1) { // Hay coincidencia para ese usuario y esa clave
            echo "<b> Login correcto!!!</b>";
            InsertarLogin($usu, $cla, "C");
            $_SESSION['usuario'] = $usu; // Creamos la variable de sesión para ese usuario
            header('Location: Menu.php');
        } else {
            echo "<b> Usuario/Clave incorrecto </b>";
            InsertarLogin($usu, $cla, "D");
        }
    } else { // Está bloqueado hasta una hora concreta 
        $campos = getdate($bloqueado); // Convertimos la hora de bloqueo a formato legible
        $hora = $campos['hours'] . ":" . $campos['minutes'] . ":" . $campos['seconds'];
        $dia = $campos['mday'] . "/" . $campos['mon'] . "/" . $campos['year'];
        echo "<b>El usuario $usu está bloqueado hasta las $hora del día $dia</b>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <label for='Usuario'>Usuario</label><input type='text' name='Usuario'>
        <label for='Clave'>Clave</label><input type='password' name='Clave'>
        <input type='submit' name='Enviar'>
    </form>
</body>  
</html>