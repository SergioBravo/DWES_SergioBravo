<?php
  $valor1 = $_POST['valor1'];
  $valor2 = $_POST['valor2'];
  $vol1 = 0;$vol2 = 0;

  $datos = fopen("../../fichero/ibex35.txt","r");//Abrimos el fichero en modo lectura

  $linea = preg_replace( "/\s+/"," ", fgets($datos));
  $columnas = explode(" ",$linea);
  echo $columnas[0]." ".$columnas[3]." ".$columnas[4]."<br>";;

  while(!feof($datos)) {//Hasta que no finalize el fichero
    $linea = preg_replace( "/\s+/"," ", fgets($datos));
    $columnas = explode(" ",$linea);
    if ($columnas[0] == $valor1) {echo $columnas[0]." ".$columnas[6]." ".$columnas[7]."<br>";$vol1 = $columnas[7];}
    if ($columnas[0] == $valor2) {echo $columnas[0]." ".$columnas[6]." ".$columnas[7]."<br>";$vol2 = $columnas[7];}
  }
  echo "<br>Valor medio de los volumenes de ambas empresas = ".(($vol1+$vol2)/2)."€";
  fclose($datos);//Cerramso el fichero
?>
