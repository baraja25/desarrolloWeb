<html>
    <body>
        
        <table border="2" width="500px" height="500px">
        <?php
        for ($i=0; $i < 8; $i++) {
            echo "<tr></tr>"; 
            for ($j=0; $j < 4; $j++) { 
                
                if ($i % 2==0) {
                    echo "<td bgcolor='black'></td><td bgcolor='white'></td>";
                } else {
                    echo "<td bgcolor='white'></td><td bgcolor='black'></td>";
                }
                 
            }
        }


        ?>
        </table>
        
       
    </body>
</html>