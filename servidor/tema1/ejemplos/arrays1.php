<html>

<body>



    <?php

    //mostrar elemento de un array unidimensional

    $numeros = array(1, 2, 3, 4, 5, 6);


    //array dinamico? añade elementos en un array vacio
    $elementos=array();

    $elementos[0]=2;
    $elementos[1]="lol";
    $elementos[2]=5;
    $elementos[3]=6;


    for ($i = 0; $i < count($elementos); $i++) {
        echo "El numero en la posicion i es $elementos[$i] <br>";
    }








    ?>
</body>

</html>