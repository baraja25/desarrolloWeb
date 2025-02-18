
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8" />
  <link href="./resources/css/miestilo.css" rel="stylesheet" type="text/css"  />
 
<title>Ejemplo PHP MySQLi POO MVC</title>


</head>
<body>
<div id="centro">
	<h3><br>Listado de departamentos</h3>
	<hr />
	<section style="height: 300px; overflow-y: scroll;">
<?php
// El array $datos[] lo recibimos cuando llamamos a la vista.
// function view($vista, $datos) del ControladorBase
$alldeps = $datos['alldeps'];

foreach ($alldeps as $depp) { // recorremos el array de objetos y obtenemos el valor de las propiedades ?>
      <?php echo $depp->getDept_no(); ?> -
      <?php echo $depp->getDnombre(); ?> -
      <?php echo $depp->getDloc(); ?> -
   
            <div class="right">
   
			<a href="<?php echo $this->url("departamento","borrar"); ?>&dept_no=<?php echo $depp->getDept_no(); ?>">
				Borrar |</a>
			<a href="<?php echo $this->url("departamento","modificar"); ?>&dept_no=<?php echo $depp->getDept_no(); ?>">
				Modificar dep |</a>

	  </div>
	  </p>
		<hr />
<?php } ?>
    </section>
	<form action="<?php echo $this->url("departamento","index"); ?>"
		method="post" class="col-lg-5">
		<input type="submit" value="Volver al inicio." />
	</form>
	<footer class="col-lg-12">
		<hr />
           Ejemplo PHP MySQLi POO MVC - <?php echo  date("Y"); ?>
  </footer>
  </div>
</body>
</html>
