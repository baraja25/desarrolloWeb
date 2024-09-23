<html>

<body>



    <?php

$relleno=rand(1,20);



//esta es la forma que se suele trabajar los arrays
$edades=array();
$edades['juan']=19;
$edades['pepe']=20;
$edades['mario']=22;
$edades['lucas']=49;


foreach ($edades as $key => $value) {
    echo "El alumno $key tiene $value años";
    echo "<br>";
}


//rellenar 20 elementos un array 1 al 20, mostrar el array y decir el mayor, array minimo 10 maximo 20 despegable, numero 1-30

//crear otro despegable => numero de repeticiones (1-5). Mostrar los numeros que se repitan X veces


    ?>
</body>

</html>