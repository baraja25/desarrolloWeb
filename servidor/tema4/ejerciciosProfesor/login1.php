<html>
<?php 
session_start();

require_once 'libreriaPDO.php';

$base="tiendadao";

$db= new DB($base) ;


function MenorInterv($filas,$intervalo)  //Función que indica si los intentos se han producido en un intervalo inferior al recibido
{
    $inicio=$filas[2]['Hora']; //Obtenemos la hora del primer intento de login
    
    $diferecia=time()-$inicio;  //Restamos a la hora actual la del login inicial
    
    return ($diferecia<=$intervalo);  //Los intentos se han realizado en menor tiempo que el intervalo permitido
   
}

function TresDeneg($filas)  //Recibe las tres ultimas filas de login y indica si en todas el acceso es degado
{
   //$tresD=FALSE; 
    
    $denegados=FALSE;
    
    $cont=0;
    
    if (count($filas)>=3 ) 
    {
      reset($filas);  //ponemos el puntero del array apuntando al principio de array
    
      while ( ($fila=current($filas))!==FALSE && $fila['Acceso']=="D" ) 
      {
         $cont++;
          
         next($filas);
      }
     
      $denegados=($cont==3);
      
    }
      
    return $denegados;
}

function Bloqueado($usu)  //Funcion que retorna -1 si no esta bloqueado y en caso contrario el valor epoch de la hora de bloqueo
{
   global $db;  
   
   $bloqueado=FALSE;  //Suponemos por defecto que no esta bloqueado
   
   $consulta="SELECT Hora,Acceso 
              FROM  login
              where Usuario=:Usuario
              ORDER by hora desc
              limit 3";
   
   $param=array();
   $param[":Usuario"]=$usu;
    
   $db->ConsultaDatos($consulta,$param); 
    
   $filas=$db->filas; //Guardamos em um array local las filas
   
   $bloqueado=-1;  //Suponemos por defecto que no está bloqueado
   
   $tiempoBloqueo=300; //Establecer cuanto tiempo tiene que estar bloqueado ese usuario
   
   if ( TresDeneg($filas)  )   //Si tiene tres denegaciones podría estar bloqueado
   {
       $intervalo=300;  //Fijamos el intervalo de tiempo en 300 segundos
       
       if (MenorInterv($filas,$intervalo) )   //Si las ha cometido dentro de ese intervalo de tiempo
       {
           $bloqueado=$filas[0]['Hora']+$tiempoBloqueo;  //Almacenamos el la variable la hora hasta la que se encuentra bloquedo
       }
      
   }
   
   
  return $bloqueado;

}


function IntentoLogin($usu,$cla) 
{
    global $db;
    
    $consulta="select count(*) as cuenta from usuarios where usuario=:usuario and contrasena=:contrasena";
    
    $param=array();
    $param[":usuario"]= $usu;
    $param[":contrasena"]= $cla;
    
    $db->ConsultaDatos($consulta,$param);
    
    $fila=$db->filas[0]; //Obtenemos la fila
 
  return $fila;  
}


function InsertarLogin($usu,$cla,$acceso)
{
   global $db;
    
   $consulta="insert into login values(:Usuario,:Clave,:Hora,:Acceso)";
   
   $param=array();
   
   $param[":Usuario"]=$usu;
   $param[":Clave"]=$cla;
   $param[":Hora"]=time();  //Cogemos la hora actual Epoch
   $param[":Acceso"]=$acceso;
   
   $db->ConsultaSimple($consulta,$param);
   
}


if (isset($_POST['Enviar']) )
{
    $usu=$_POST['Usuario'];
    $cla=sha1($_POST['Clave']); //Cogemos la clave pero aplicándole el cifrado correspondiente
    
    $bloqueado=Bloqueado($usu); //Comprobamos si esta bloqueado
    
    if ( $bloqueado==-1 )      //Si no esta bloquedo le dejamos hacer un intento de login
    {
       $fila=IntentoLogin($usu,$cla); 
   
       if ( $fila['cuenta']==1 )  //Hay coincidencia para ese usuario y esa clave
       {
           echo "<b> Login correcto!!!</b>";
           
           InsertarLogin($usu,$cla,"C");
           
           $_SESSION['usuario']=$usu;  //Creamos la variable de sesión para ese usuario
           
           header('Location: Menu.php');
           
       }
       else
       {
           echo "<b> Usuario/Clave incorrecto </b>";
           
           InsertarLogin($usu,$cla,"D");
       }
    
    }
    else  //Esta bloqueado hasta una hora concreta 
    {
        $campos=getdate($bloqueado);   //Convertimos la hora de bloqueo a formato legible
  
        $hora=$campos['hours'].":".$campos['minutes'].":".$campos['seconds'];
        
        $dia=$campos['mday']."/".$campos['mon']."/".$campos['year'];
        
        echo "<b>El usuario $usu esta bloqueado hasta las $hora del dia $dia</b>";
    }
    
 
}

?>

<body>

 <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >

    <label for='Usuario'>Usuario</label><input type='text' name='Usuario'>
    <label for='Clave'>Clave</label><input type='password' name='Clave'>
    
    <input type='submit' name='Enviar'>
   
   
 </form>
</body>  
</html>