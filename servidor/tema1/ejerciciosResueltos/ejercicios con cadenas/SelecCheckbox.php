<html>
    <body>
      <fieldset> 
      <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">
        
      <?php 
      
      $aficiones=array("Futbol","Tenis","Cine","Teatro","Golf");
      
      foreach ($aficiones as $clave=>$valor)
      {
        echo "<input type='checkbox' name=Aficiones[$clave]>$valor<br>";  
            
      }
      
      
      ?> 

           <input type="submit" name="Enviar" value="Enviar">
 
      </form>  
         
        
        
     <?php 
     
     if (isset($_GET['Enviar']) && (isset($_GET['Aficiones']) ) )
     {
         $SusAficiones=$_GET['Aficiones'];
         
         foreach ($SusAficiones as $clave=>$valor)
         {
           echo "Aficion $clave marcada que es $aficiones[$clave]     <br>";  
         }
         
         
     }
     
     
     
     
     ?>   
        
        
    </body>
</html>



