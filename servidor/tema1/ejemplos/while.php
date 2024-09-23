<html>
    <body>
        <?php
        $a=1;
        $encontrado=false;
        $num=rand(1, 10);
        echo "El numero de interacciones elegido es: $num";
        echo "<br>";

        while( $a <= $num ){
            
            echo "Hola numero $a";
            echo "<br>";
            
            $a++;
        }

        
        ?>
    </body>
</html>