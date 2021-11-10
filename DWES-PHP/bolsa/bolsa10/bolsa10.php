<?php
  $col = 0;//Para guardar el número de columna
  $posicion = 0;//Para controlar las posciciones del array

  $datos = fopen("../fichero/ibex35.txt","r");//Abrimos el fichero en modo lectura

  fgets($datos);//Metemos un salto de linea ya que la primera no contiene ningun valor cuantificable

  while(!feof($datos)) {//Hasta que no finalize el fichero
    $linea = preg_replace( "/\s+/"," ", fgets($datos));
    $columnas = explode(" ",$linea);//Sacamos todas las columnas
    //Creamos arrays con todos los números de cada columna para poder usar luego las funciones max y min
    $maxCoti[$posicion] = str_replace(",",".",$columnas[5]);//Debemos cambiar las comas por puntos
    $minCoti[$posicion] = str_replace(",",".",$columnas[6]);
    $vol[$posicion] = str_replace(".","",$columnas[7]);
    $capi[$posicion] = str_replace(".","",$columnas[8]);

    $posicion++;
  }

  echo "El valor maximo de cotización es ".max($maxCoti)."€<br>";
  echo "El valor minimo de cotización es ".min($minCoti)."€<br>";
  echo "El valor maximo de volumen es ".max($vol)."€<br>";
  echo "El valor minimo de volumen es ".min($vol)."€<br>";
  echo "El valor maximo de capitalización es ".max($capi)."€<br>";
  echo "El valor minimo de capitalización es ".min($capi)."€<br>";

  fclose($datos);//Cerramso el fichero
 ?>
