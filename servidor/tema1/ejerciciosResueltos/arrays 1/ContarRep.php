<?php


function Rellenar(&$numeros)
{
   for($i=0;$i<20;$i++)  
   {
       $numeros[$i]=rand(0,50);
   }
    
}

function Mostrar($numeros)
{
    echo "[";
    
    foreach ($numeros as $clave=>$valor)  
    {
       echo "$valor][";  
    }
    
    
}

function Contar($numeros,&$repeticiones)
{
   for($i=0;$i<count($numeros);$i++) 
   {
       if (!isset($repeticiones[$numeros[$i]]   )   )     //Si ese número no esta en el array de repeticiones
       {
           $repeticiones[$numeros[$i]]=1;
           
       }
       else   //Ese numero ya tenia una entrada en el array de repetidos
       {
           $repeticiones[$numeros[$i]]=$repeticiones[$numeros[$i]]+1;  //Incrementamos sus repeticiones
       }
     
   }
     
}

function MostrarTabla($repeticiones)
{
  echo "<table border='2'>";  
  echo "<th>Número</th><th>Repeticiones</th>";  
    
  foreach($repeticiones as $clave=>$valor  )
  {
    echo "<tr>";  
      
    echo "<td>$clave</td><td>$valor</td>";  
      
    echo "</tr>";  
      
  }
  
  echo "</table>";
    
}







$numeros=array();        //Array con numeros al azar
 
$repeticiones=array();  //Array cuya clave son los numeros del array anterior y valor las veces que ese número se repite 

Rellenar($numeros);

Mostrar($numeros);

Contar($numeros,$repeticiones);

MostrarTabla($repeticiones);


















?>