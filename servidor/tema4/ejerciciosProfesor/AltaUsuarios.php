
<html>
 <body>

<?php 

 require_once 'DaoUsuarios.php';

 $base="tiendadao";
 
 $daoUsu= new DaoUsuarios($base);
 
 if (isset($_POST['Alta']) )
 {
     //Definimos los caracteres de salting que incluiremos con las claves
     
     $salt1="~#!()=";
     
     $salt2="?)=€@";
     
     $usu=$_POST['Usuario'];
     
     $cla=$salt1.$_POST['Clave'].$salt2;
     
     $cla=sha1($cla); //Cogemos la clave pero aplicándole el cifrado correspondiente
     
     $usuario = new Usuario();
     
     $usuario->__set("usuario", $usu);
     $usuario->__set("contrasena", $cla);
     
     $daoUsu->insertar($usuario);
 }

?>
  
  
 <fieldset><legend>Alta de Usuarios</legend>
  <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >

    <label for='Usuario'>Usuario</label><input type='text' name='Usuario'>
    <label for='Clave'>Clave</label><input type='password' name='Clave'>
    
    <input type='submit' name='Alta' value='Alta'>
   
   
  </form>
 </fieldset>  
  
</body>  
</html>
