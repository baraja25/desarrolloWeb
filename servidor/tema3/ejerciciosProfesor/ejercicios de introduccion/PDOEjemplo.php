<?php

$host="localhost";

$user="root";

$pass="";

$base="examentema2";

try
{
 $pdo=new PDO("mysql:host=$host;dbname=$base",$user,$pass);

 //Para que genere excepciones a la hora de reportar errores.

 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) 
{
    echo $e->getMessage();
}

$idPro=1;

$consulta="select * from producto where Id=:Id ";

$param=array(); //Array con los parámetros que vamos a pasar al objeto statement

$param[":Id"]=$idPro;  //Añadimos una entrada al array de pámetros de sustitución

$sta=$pdo->prepare($consulta);

$sta->execute($param);

$filas=$sta->fetchAll();

foreach ($filas as $fila) 
{
  echo $fila['Nombre']."<br>";
}


$pdo = null;  //Cerramos la conexión

?>