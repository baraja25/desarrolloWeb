<html>

<body>


  <table border='2' width='600' height='600'>
   
  <?php 
  
   for($fil=0;$fil<8;$fil++)      //Bucle exterior para escribir las filas
   {
       echo "<tr>";
       
       for($col=0;$col<4;$col++)
       {
         if ($fil % 2 ==0) //Filas pares empiezan con celda color negro
         {
            echo "<td bgcolor='black'>&nbsp</td><td>&nbsp</td>";
         }
         else               //Filas impares empiezan con celda color blanco
         {
             echo "<td>&nbsp</td><td bgcolor='black'>&nbsp</td>";
         }
             
       }
       
       echo "</tr>";
       
   }
  
  
  
  
  
  
  
  
  ?>
  
  </table>


 



 
</body>

</html>