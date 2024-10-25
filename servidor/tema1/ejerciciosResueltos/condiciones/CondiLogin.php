
<html>

<title>Login con registro</title>
<?php

//Variables de usuario y clave

$usuario="root";

$clave="clave";

?>

<body>

<form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
  
  <label for='Usuario'>Usuario</label><input type='text' name='Usuario'>
  <label for='Clave'>Clave</label><input type='password' name='Clave'>

<input type='submit' name='Enviar' value='Enviar'>

 </form> 

<?php 

if (isset($_GET['Enviar'] )  )
{
    $usu=$_GET['Usuario'];
    $cla=$_GET['Clave'];
    
    if ($usu==$usuario)     // El usuario está registrado
    {
        if ($cla==$clave ) 
        {
           echo "<b>Login correcto, sera redireccionado</b>"; 
        }
        else
        {
            echo "<b>Login incorrecto</b>"; 
        }
        
    }
    else   // No esta registrado. Mostramos el formulario de registro 
    {
       echo "<fieldset><legend>Usuario no registrado. Registrese</legend>";
        
       echo "<form name='f2' method='get' action=".$_SERVER['PHP_SELF'].">";
       echo "<label for='Usuario'>Usuario</label><input type='text' name='Usuario'>";
       echo "<label for='Clave'>Clave</label><input type='password' name='Clave'>";
       echo "<label for='Correo'>Correo</label><input type='text' name='Correo'>";
       
       echo "<input type='submit' name='Registrar' value='Registrar'>";
        
       echo "</fieldset>";
    }
    
    
}

if (isset($_GET['Registrar'] )  )
{
    
    $usu=$_GET['Usuario'];
    $cla=$_GET['Clave'];
    $correo=$_GET['Correo'];
    
    echo "Usuario registro con los datos:<br>";
    
    echo "Usuario:$usu Clave:$cla  Correo:$correo";
    

}



?>


 
</body>

</html>

 
 