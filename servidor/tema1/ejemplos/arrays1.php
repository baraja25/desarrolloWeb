<html>

<body>



    <?php

    //mostrar elemento de un array unidimensional

    $numeros = array(1, 2, 3, 4, 5, 6);


    //array dinamico? añade elementos en un array vacio
    $elementos=array();

    //se puede dejar los [] vacios y se ira rellenando automaticamente
    $elementos[]=2;
    $elementos[]="lol";
    $elementos[]=5;
    $elementos[]=6;


    for ($i = 0; $i < count($elementos); $i++) {
        echo "El numero en la posicion i es $elementos[$i] <br>";
    }








    ?>
</body>

</html>