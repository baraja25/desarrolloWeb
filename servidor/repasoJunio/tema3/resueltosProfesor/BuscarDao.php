
<html>
 <body>
 
   <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' > 
     <fieldset><legend>Búsqueda de coches</legend>
            
            
           
            <label for='marca'>Marca </label><input type='text' name='marca'  ><br>
            <label for='modelo'>Modelo </label><input type='text' name='modelo'  ><br>
            <label for='min'>Precio Min </label><input type='text' name='min'  ><br>
            <label for='max'>Precio Max </label><input type='text' name='max'  ><br>
             
            <input type='submit' name='Buscar' value='Buscar'>
            
           </fieldset> 
     </form>  
     
     <?php 
     
     require_once 'DaoCoches.php';
     
     $base="repaso";
     
     $daoC=  new DaoCoches($base);  //Creamos una instancia de la clase DaoCoches
     
     if (isset($_POST['Buscar']) )
     {
        $marca=$_POST['marca'];
        $modelo=$_POST['modelo'];
        $min=$_POST['min'];
        $max=$_POST['max'];
         
        $daoC->buscar($marca, $modelo, $min, $max);
        
        echo "<table border='2'>";
        echo "<th>Id</th><th>Nombre</th><th>Marca</th><th>Modelo</th><th>Precio</th><th>Matricula</th><th>Anio</th><th>Foto</th>";
        
        
        foreach ($daoC->coches as $coche) 
        {
            echo "<tr>";
           
              
            echo "<td>".$coche->__get("id")."</td>";
            echo "<td>".$coche->__get("nombre")."</td>";
            echo "<td>".$coche->__get("marca")."</td>";
            echo "<td>".$coche->__get("modelo")."</td>";
            echo "<td>".$coche->__get("precio")."</td>";
            echo "<td>".$coche->__get("matricula")."</td>";
            echo "<td>".$coche->__get("anio")."</td>";
             
            $conte=$coche->__get("foto");
            
            echo "<td><img src='data:image/jpg;base64,$conte' width=70 height=70></td>";
            
            echo "</th>";
            
            
        }
         
        echo "</table>"; 
     }
    
     ?>
  </body>  
</html>  
  

