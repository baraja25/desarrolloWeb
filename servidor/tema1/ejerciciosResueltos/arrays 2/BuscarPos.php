<?php

function Rellenar(&$numeros)
{
    for($i=0;$i<15;$i++)
    {
        $numeros[$i]=rand(0,20);
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

function EnPos($numeros,$num)
{
 
  $i=0;
    
  while( ($i<count($numeros) )  && ( $numeros[$i]!=$num)      )  
  {
    $i++;
  }
    
  if ($i==count($numeros) )  
  {
      $i=-1;
  }
  
  return $i;
    
}


$numeros=array();


Rellenar($numeros);

Mostrar($numeros);



echo "El numero 7 esta en la posición:".EnPos($numeros,7);







?>