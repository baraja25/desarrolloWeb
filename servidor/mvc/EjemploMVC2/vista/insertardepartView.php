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
<section style="height:400px;overflow-y:scroll;">
<form action="<?php echo $this->url("departamento","crear"); ?>" method="post" class="col-lg-5">
    <h3>Añadir Departamento</h3>
    <hr/>
    <br>Número de departamento: <input type="number" name="dept_no" />
    <br>Denominación: <input type="text" name="dnombre" />
    <br>Localidad: <input type="text" name="loc" />
    <br><input type="submit" value="Insertar " />
</form>
</section>
<form action="<?php echo $this->url("departamento","index"); ?>" method="post" class="col-lg-5">
    <input type="submit" value="Volver al inicio." />
</form>
 <footer class="col-lg-12">
    <hr/>
       Ejemplo PHP MySQLi POO MVC -<?php echo  date("Y"); ?>
 </footer>
</body>
</html>
