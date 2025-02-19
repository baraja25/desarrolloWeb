
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8"/>
<title>Ejemplo PHP MySQLi POO MVC</title>

<style>
input{
    margin-top:5px;
    margin-bottom:5px;
}
.right{
    float:right;
}
</style>
</head>
<body>

 <?php
   //El array $datos[] lo recibimos uando llamamos a la vista. 
   //function view($vista, $datos) del ControladorBase
 ?>
 
<h3>Mensaje: <?php echo $datos['mensaje'];?></h3>
<hr/>
<form action="<?php echo $this->url("departamento","index"); ?>" method="post" class="col-lg-5">
    <input type="submit" value="Volver al inicio." />
</form>
<form action="<?php echo $this->url("departamento","insertar"); ?>" method="post" class="col-lg-5">
    <input type="submit" value="Ir a insertar." />
</form>

 <footer class="col-lg-12">
       <hr/>
           Ejemplo PHP MySQLi POO MVC - <?php echo  date("Y"); ?>
  </footer>
</body>
</html>
