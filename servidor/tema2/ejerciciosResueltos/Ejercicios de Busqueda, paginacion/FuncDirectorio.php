<?php


    $dir=opendir("../Tema2");   //Abrimos esta carpeta o directorio     

    $archivosPhp=array();
    
    $archivosTxt=array();
    
  
  
    while( ($NomFich=readdir($dir))!=FALSE  )
    {
        if ( substr($NomFich,0,1)!="." ) 
        {    
            $campos=explode(".",$NomFich);
            
            if ($campos[1]=="txt" )
            {
              $archivosTxt[]=$NomFich;
            }
            if ($campos[1]=="php")
            {
              $archivosPhp[]=$NomFich;
            }
            
        }
        
    }

    sort($archivosTxt);  //Ordenamos por valor ascendente
    
    sort($archivosPhp);  //Ordenamos por valor ascendente
    
    echo "Archivos Tipo Txt:<br>";
    
    foreach ($archivosTxt as $archivo)
    {
      echo $archivo."<br>";  
    }
    
    echo "<br>";
    
    echo "Archivos Tipo Php:<br>";
    
    
    foreach ($archivosPhp as $archivo)
    {
        echo $archivo."<br>";
    }
    
    
    closedir($dir);


?>