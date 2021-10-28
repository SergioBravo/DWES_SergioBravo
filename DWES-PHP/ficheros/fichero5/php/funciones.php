<?php
  function MostrarFichero($ruta){
    $fichero = fopen($ruta,"r");

    while(!feof($fichero)){
      $lin=fgets($fichero,4000);
      echo $lin,"<br>";
    }

    fclose($fichero);
  }

  function MostrarLinea($ruta,$linea) {
    $fichero = fopen($ruta,"r");
    $con = 1;

    while(!feof($fichero)){
      if ($con == $linea){
        $lin=fgets($fichero,4000);
        echo $lin,"<br>";
        $con++;
      }else {fgets($fichero,4000);$con++;}
    }

    fclose($fichero);
  }

  function MostrarLineas($ruta,$nlinea) {
    $fichero = fopen($ruta,"r");
    $con = 1;

    while(!feof($fichero)){
      while ($con <= $nlinea){
        $lin=fgets($fichero,4000);
        echo $lin,"<br>";
        $con++;
      }
      fgets($fichero,4000);
    }

    fclose($fichero);
  }
 ?>
