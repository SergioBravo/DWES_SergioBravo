<?php
  $valor1 = $_POST['valor1'];
  $valor2 = $_POST['valor2'];

  $datos = fopen("../../fichero/ibex35.txt","r");//Abrimos el fichero en modo lectura

  $linea = preg_replace( "/\s+/"," ", fgets($datos));
  $columnas = explode(" ",$linea);
  echo $columnas[0]." ".$columnas[1]." ".$columnas[5]."  ".$columnas[6]."<br>";

  while(!feof($datos)) {//Hasta que no finalize el fichero
    $linea = preg_replace( "/\s+/"," ", fgets($datos));
    $columnas = explode(" ",$linea);
    if ($columnas[0] == $valor1) echo $columnas[0]." ".$columnas[1]." ".$columnas[5]." ".$columnas[6]."<br>";
    if ($columnas[0] == $valor2) echo $columnas[0]." ".$columnas[1]." ".$columnas[5]." ".$columnas[6]."<br>";
  }

  fclose($datos);//Cerramso el fichero
?>
