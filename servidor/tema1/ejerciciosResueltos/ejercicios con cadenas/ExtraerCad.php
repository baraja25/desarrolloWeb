<?php

function DentroCadena($cad,$pos)   //Funcion que indica si esa posicion esta dentro de los límites de la cadena 
{
  return ( ($pos>=0) && ($pos<strlen($cad) ) ) ; 
    
}

function QuitarCad($cad,$ini,$fin)    //Extrae de una cadena los caracteres delimitados por las posiciones indicadas
{
    $sub="";
    
    if ( DentroCadena($cad,$ini) && DentroCadena($cad,$fin)   )
    {
        if ($ini>$fin)
        {
            echo "<B>Error</B> Ha introducido un valor inicial mayor que el final";
        }
        else
        {     //Extraemos de la cadena principal el segmento pedido
            
            for($i=0;$i<strlen($cad);$i++)
            {
                if ( ($i<$ini) || ($i>$fin) )
                {
                    $sub.=$cad[$i];
                }
            }
        }
        
        
    }
    else  //Error los limites introducidos no estan dentro de la cadena
    {
        echo "<B>Error los limites introducidos no estan dentro de la cadena</B>";
    }
    
    return $sub;
    
}




function ExtraerCad($cad,$ini,$fin)    //Extrae de una cadena los caracteres delimitados por las posiciones indicadas
{
    $sub=""; 
    
    if ( DentroCadena($cad,$ini) && DentroCadena($cad,$fin)   )   
    {
        if ($ini>$fin)
        {
          echo "<B>Error</B> Ha introducido un valor inicial mayor que el final";  
        }
        else 
        {     //Extraemos de la cadena principal el segmento pedido
            
           for($i=$ini;$i<=$fin;$i++) 
           {
               $sub.=$cad[$i];
               
           }     
        }
            
     
    }
    else  //Error los limites introducidos no estan dentro de la cadena 
    {
        echo "<B>Error los limites introducidos no estan dentro de la cadena</B>";
    }
    
    
    
    return $sub;
    
}

$cadena="telescopio";

$ini=2;

$fin=4;

echo "La cadena es $cadena y extraemos desde $ini hasta $fin ";

echo "<br>";

echo QuitarCad($cadena, $ini, $fin);


