<html>
 <body>
    <?php
    
    require_once 'DaoCoches.php';
    
    $base="repaso";
    
    $daoC=  new DaoCoches($base);  //Creamos una instancia de la clase DaoCoches
   
    $daoC->listar();
    
    
    echo "<table border='2'>";
    
    echo "<th>Foto</th>";
    
    
    foreach ($daoC->coches as $coche) 
    {
        $id=$coche->__get('id');  //Guardamos el Id del coche en una variable
        
        echo "<tr>";
       
        
       
        $conte= $coche->__get('foto');
        
        echo "<td><a href=detalle.php?id=$id>
                  <img src='data:image/jpg;base64,$conte' width=70 height=70>
                  </a>
              </td>";
        
        echo "</tr>";
        
    }
    
    echo "</table>";
    
    ?>
 
 </body>

</html>
