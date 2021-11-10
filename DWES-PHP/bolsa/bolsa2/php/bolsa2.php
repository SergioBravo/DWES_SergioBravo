<?php
  $valor = $_POST['valor'];

  $datos = fopen("../../fichero/ibex35.txt","r");//Abrimos el fichero en modo lectura

  $linea = fgets($datos)."<br>";
  echo $linea;

  while(!feof($datos)) {//Hasta que no finalize el fichero
    $linea = preg_replace( "/\s+/"," ", fgets($datos));//usamos la una función que nos cambia todo el exceso de espacios en blanco definido en la función regular por un solo espacio en blanco
    $columnas = explode(' ',$linea);//Sacamos todas las columnas
    if ($columnas[0] == $valor) echo $linea;
  }

  fclose($datos);//Cerramso el fichero
?>
