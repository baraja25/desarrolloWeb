<html>
<?php 
session_start();  //Iniciamos sesión el servidor

if (!isset($_SESSION['usuario'] ) )
{
   echo "Error: Debe autenticarse primero"; 
   
   echo "<meta http-equiv='refresh' content='3; URL=./cookie1.php' />";
   
   exit();  
      
}  


$usuarios=array('Juan','Pepe','Luis');

$usu='';

if (isset($_GET['Cerrar']) )
{
   session_destroy(); 
}
else 
{
            if (isset($_POST['Usuario']) )
            {
                $usu=$_POST['Usuario'];
                
                $_SESSION['usuario']=$usuarios[$usu];
            }
            
            if (isset($_SESSION['usuario'] )  )
            {
                $usuario=$_SESSION['usuario'];
                
                echo "Hola <b>".$usuario."</b> como estas hoy ";
            }
            else 
            {
                echo "Aun no hay usuarios en el sistema ";
            }

}
            
?>

<body>

 <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >

   <label for='Usuario'>Usuario</label>
   <select name='Usuario'>
   <option value=''></option>
   
   <?php 
   
   foreach ($usuarios as $clave=>$valor) 
   {
       echo "<option value='$clave' ";
       
       if ($clave==$usu )
       {
         echo " selected ";  
       }
       
       echo ">$valor</option>";
   }
  
   ?>
   
    </select>
   
    <input type='submit' name='Guardar' value='Guardar'>
   
   </form>
   
 <?php 
 
 echo "<a href='$_SERVER[PHP_SELF]?Cerrar=1' >Cerrar Sesión</a>";
 
 ?>
   
</body>

</html>