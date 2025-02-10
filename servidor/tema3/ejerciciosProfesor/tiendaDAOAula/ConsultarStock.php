<html>
<?php 

require_once 'DaoTiendas.php';
require_once 'DaoFamilias.php';
require_once 'DaoStocks.php';

$base="tienda";  //Indicamos la bbdd a conectar

$daoTienda= new DaoTiendas($base);
$daoFamilia= new DaoFamilias($base);

$tienda="";  //Variable que recibe el cod de tienda seleccionado previamente

if (isset($_POST['Tienda']) )
{
    $tienda=$_POST['Tienda'];
}

$familia="";  //Variable que recibe el cod de tienda seleccionado previamente

if (isset($_POST['Familia']) )
{
    $familia=$_POST['Familia'];
}

?>

  <body>
  
  <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >
  
       Tienda<select name='Tienda'>
         <option value=''></option>            
            
         <?php 
         
         $daoTienda->listar();
         
         foreach ($daoTienda->tiendas as $tien)
         {
             echo "<option value='".$tien->__get('cod')."' ";
             
             if ($tien->__get('cod')==$tienda)
             {
               echo " selected ";  
             }
                 
             echo ">".$tien->__get('nombre')."</option>";
             
         }
         
         
    
         ?>
            
       </select>
       
       Familia<select name='Familia'>
         <option value=''></option>             
            
         <?php 
         
         $daoFamilia->listar();
         
         foreach ($daoFamilia->familias as $fami)
         {
             echo "<option value='".$fami->__get('cod')."' ";
             
             if ($fami->__get('cod')==$familia)
             {
               echo " selected ";  
             }
                 
             echo ">".$fami->__get('nombre')."</option>";
             
         }
        
         ?>   
            
          
       </select>
       <input type='submit' name='Mostrar' value='Mostrar Stock'>

   </form>
  
   <?php 
  
   if (isset($_POST['Mostrar']) )
   {
     $daoStock= new DaoStocks($base);
    
     $daoStock->listarFamTien($tienda, $familia);
  
     echo "<table border='2'>";
     echo "<th>Tienda</th><th>Producto</th><th>Unidades</th>";
     foreach ($daoStock->stocks as $stock)
     {
        echo "<tr>";
        echo "<td>".$stock->__get("tienda")."</td><td>".$stock->__get("producto")."</td><td>".$stock->__get("unidades")."</td>";
    
        echo "</tr>";
     }
        
     echo "</table>";
     
   }

   ?>
   


   </body>
</html>

