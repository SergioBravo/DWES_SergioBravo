<?php
  $datos = fopen("../fichero/ibex35.txt","r");//Abrimos el fichero en modo lectura

  while(!feof($datos)) {//Hasta que no finalize el fichero
    $linea = fgets($datos);
    echo "<pre>".$linea."</pre>";//Mostramos cada linea
  }

  fclose($datos);//Cerramso el fichero
 ?>
