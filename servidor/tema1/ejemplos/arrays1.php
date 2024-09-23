<html>

<body>



    <?php

    //mostrar elemento de un array unidimensional

    $numeros = array(1, 2, 3, 4, 5, 6);


    //array dinamico? añade elementos en un array vacio
    $elementos=array();

    //se puede dejar los [] vacios y se ira rellenando automaticamente
    $elementos[4]=11;
    //el relleno automatico se salta los indices si no se introduce nada
    $elementos[]=2;
    $elementos[]="lol";
    $elementos[]=5;
    $elementos[]=6;


    foreach ( $elementos as $key => $value ) {
        echo "El numero en la posicion $clave es $valor <br>";
    } 







    ?>
</body>

</html>