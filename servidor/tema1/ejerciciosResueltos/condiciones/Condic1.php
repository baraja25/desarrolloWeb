<?php

$condicion1=TRUE;

$condicion2=1;

$condicion3=FALSE;

$expresion=$condicion1 &&  ($condicion2 ||  $condicion3 );


if ( $expresion   )
{
  echo "La condición es cierta  ";  
}
elseif ( $condicion2  )
{
  echo "Se cumple condición 2 ";  
}
else   //Valor por defecto
{
    
    
}




?>