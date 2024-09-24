<html>

<body>
    <?php
    //pagina 157 para ver las funciones de el lenguaje PHP.pdf
    $edades = array();
    $edades["Jose"]=21;
    $edades["juan"]=19;
    $edades["luis"]=15;
    $edades["maria"]=65;
    $edades["Angel"]=40;


    echo "Antes de ordenar";
    foreach ($edades as $key => $value) {
        echo "<br>Clave: $key valor: $value ";
    }
    echo "<br>";

    // sort($edades); //ordenacion por valor ascendente


    // echo "Ordenar ascendente";
    // foreach ($edades as $clave => $value) {
    //     echo "<br>Clave: $clave valor: $value ";
    // }
    // echo "<br>";

    // rsort($edades);

    // echo "ordenar descendente";
    // foreach ($edades as $key => $value) {
    //     echo "<br>Clave: $key valor: $value ";
    // }
    // echo "<br>";

    
    //mantienen asociacion de clave y valor
    asort($edades);

    echo "ordenar con asort()";
    foreach ($edades as $key => $value) {
        echo "<br>Clave: $key valor: $value ";
    }
    echo "<br>";

    ksort($edades);

    echo "ordenar con ksort()";
    foreach ($edades as $key => $value) {
        echo "<br>Clave: $key valor: $value ";
    }
    echo "<br>";

    ?>



</body>

</html>