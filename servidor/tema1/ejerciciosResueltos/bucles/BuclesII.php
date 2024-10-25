<html>

<title>Mini Calculadora</title>
<body>
<form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>

  <label for='Num'>Numero</label>
     <input type='number' name='Num'>

    <input type='submit' name='Mostrar' value='Mostrar'>
   <br>
   
</form>     
  
<?php 

if (isset( $_GET['Mostrar'] )  )      //Si Pulso el botón calcular
{

        $num=$_GET['Num'];  //Recogemos el tamaño de la tabla  
            
 
        if ( ($num>1) && ($num<12)   )   
        {
            
            $fil=$num;  //El número de filas lo indica la variable num
           
            $primo='';  //numero primo a mostrar
            
            $PrimoEncontrado=FALSE;  //Variable que indica si el numero es primo
            
            $ini=1;    //Numero inicial desde dobnde buscar los primos
            
            echo "<table border='2'>";
            
            while ($fil>0 )
            {
              $col=$num;
                
              echo "<tr>"; 
              
              while ($col>0 )
              {
                 echo "<td>";
              
                    if ($ini==1 )
                    {
                       $primo=1; 
                       
                       $ini++;
                    }
                    else  //Tenemnos que hallar el siguiente primo desde el inicio 
                    {
                        
                      while (!$PrimoEncontrado)     
                      {
                                $i=2;  // Variable que recorre desde el valor 2 hasta el numero ini  
                                     
                                while ( ($i<$ini) && ( ($ini%$i)!=0 ) )
                                {
                                  $i++;
                                }
                              
                                if ($i==$ini)   //Si  hemos salido del bucle es que hemos encontrado un primo
                                {
                                    $PrimoEncontrado=TRUE;
                                    $primo=$ini;
                                   
                                }
                                else   //El numero no era primo, probamnos con el siguiente
                                {
                                  $ini++;
                                }
                                  
                        }
                        
                         $ini++;   //Tenemos que probar con el siguiente
                        
                         $PrimoEncontrado=FALSE;
                         
                      }
                  
                 
                 echo $primo;
                 
                 echo "</td>";
                
                 $col--;
              }
                  
              echo "</tr>";
              
              $fil--;
            }
            
            
            echo "</table>";
            
        }
        else 
        {
          echo "<B>Error, debe introducir un número entre 2 y 8</b>";  
            
        }


}

?>  

</body>

</html>



