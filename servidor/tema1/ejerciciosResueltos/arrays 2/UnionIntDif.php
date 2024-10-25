<html>
 <body>
   <form name='f1' method='get' action='<?php echo $_SERVER['PHP_SELF']?>' >
        <?php
        
        $ope=""; //Inicializamos la variable operación a vacio
        
        $nume1="";
        $nume2="";
        
        
        if (isset($_GET['Ope']) )   //Si recibimos un valor de operacion
        {
            $ope=$_GET['Ope'];
            
            $nume1=$_GET['Numer1'];    //Recogemos los números de los campos de texto
            
            $nume2=$_GET['Numer2']; 
            
        }
        
        if (isset($_GET['Enviar']) )  //Hay que recuperar los arrays anteriores
        {
            
        }
        else  //No hay arrays creados, hay que incializarlos
        {
                        $numeros1=array(); //Array con los primero números
                        $numeros2=array(); //Array con los segundos numeros
                       
                        echo "Primero[";
                        
                        for($i=0;$i<10;$i++)         //Rellenamos los dos arrays con los números de 1 al 20
                        {
                          $numeros1[]=rand(1,20);
                          echo "$numeros1[$i] ";
                        }
                        
                        echo "]";
                        
                        echo "<br><br>";
                        
                        echo "Segundo[";
                        
                        for($i=0;$i<10;$i++)         //Rellenamos los dos arrays con los números de 1 al 20
                        {
                            $numeros2[]=rand(1,20);
                            echo "$numeros2[$i] ";
                        }
                        
                        echo "]";
                        
            //Ordenamos los arrays de numeros creados
            
           sort($numeros1);
           sort($numeros2);
                        
           $nume1=implode(",",$numeros1);      //Variable que va a guardar el array serializado   
           
           $nume2=implode(",",$numeros2);      //Variable que va a guardar el array serializado 
           
           }
           
           echo "<br>";
           echo "<br>";
           
           echo "Numeros Primero<input type='text' name='Numer1' value='$nume1' size='25'>"; 
           
           echo "<br><br>";
           
           echo "Numeros Segundo<input type='text' name='Numer2' value='$nume2' size='25'>"; 
                        
        
        ?>
        <br>
        Operacion<select name='Ope'>
                   <option value=''></option>
                   <?php 
                   
                   $operaciones=array(1=>"Union",2=>"Interseccion",3=>"Diferencia");
                   
                   foreach ($operaciones as $clave=>$valor)
                   {
                       echo "<option value='$clave' ";
                       
                       if ($clave==$ope)
                       {
                         echo " selected ";  
                       }
                       
                       echo ">$valor</option>";
                       
                       
                   }
                   
                   ?> 
        
                 </select>
                 
          <input type='submit' name='Enviar' value='Enviar'>     
                
          <?php 
          
          //Según la operación realizamos la operación correspondiente
          
          if ($ope!="")  // si hemos seleccionado una operacion
          {
              //Convertir a Arrays los numeros de los campos de text
              
              $numeros1=explode(",", $nume1);
              
              $numeros2=explode(",", $nume2);
              
          }
          
          if ($ope==1)   //La operación a realizar es la Union
          {
             $union=array();    //Array que va a guardar el resultado de la union 
              
             foreach ($numeros1 as $clave=>$valor) //Volcamos todos los elementos del primer array
             {
                 if (!in_array($valor,$union) )  //Si ese elemento no está en el array de unión
                 {
                   $union[]=$valor;
                 }
             }
             
             foreach ($numeros2 as $clave=>$valor) //Volcamos todos los elementos del primer array
             {
                 if (!in_array($valor,$union) )  //Si ese elemento no está en el array de unión
                 {
                     $union[]=$valor;
                 }
             }
          
             sort($union); 
             
             echo "<br>";
             
             echo "Union[";
             
             foreach ($union as $clave=>$valor)
             {
                 echo "$valor ";
             }
             echo "]";
             
             
             
          }
          elseif ($ope==2)   //La operación a realizar es la Interseccion
          {
              $inter=array();    //Array que va a guardar el resultado de la interseccion
              
              foreach ($numeros1 as $clave=>$valor) //Volcamos los elementos del primer array
              {
                  if (in_array($valor,$numeros2 ) )  //Si es numero del primer array esta en el segundo
                  {
                      if (!in_array($valor,$inter) ) // Y no estaba anteriormente
                      {
                          $inter[]=$valor;           //Lo incluimos en la interseccion
                      }
                  }
              }
              
              sort($inter);
              
              echo "<br>";
              
              echo "Interseccion[";
              
              foreach ($inter as $clave=>$valor)
              {
                  echo "$valor ";
              }
              echo "]";
              
              
              
          }
          elseif ($ope==3)   //La operación diferencia
          {
              $difer=array();    //Array que va a guardar el resultado de la interseccion
              
              foreach ($numeros1 as $clave=>$valor) //Volcamos los elementos del primer array
              {
                  if (!in_array($valor,$numeros2 ) )  //Si es numero del primer array esta en el segundo
                  {
                      if (!in_array($valor,$difer) ) // Y no estaba anteriormente
                      {
                      
                         $difer[]=$valor;
                      }
                  }
              }
              
              sort($difer);
              
              echo "<br>";
              
              echo "Interseccion[";
              
              foreach ($difer as $clave=>$valor)
              {
                  echo "$valor ";
              }
              echo "]";
              
              
              
          }
          
          
          
          
          
          
          
          
          
          ?>        
                
                
                 
        
   </form>      
 </body>
</html>


