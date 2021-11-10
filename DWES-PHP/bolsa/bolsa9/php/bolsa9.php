<?php
echo "<html lang=es dir=ltr>";
  echo "<head>";
    echo "<meta charset=utf-8>";
    echo "<title>php ejemplo</title>";
  echo "</head>";
  echo "<body>";
    echo "<h1>Consulta Operaciones bolsa</h1>";
  #PRINCIPIO CODIGO
    echo "<form action=../bolsa9.html method=post>";
      $mostrar = $_POST['mostrar'];//La opcion que eligue el usuario
      $col = 0;//Para guardar el número de columna
      $suma = 0;//Para controlar la suma que mostramos
      $datos = fopen("../../fichero/ibex35.txt","r");//Abrimos el fichero en modo lectura

      $linea = preg_replace( "/\s+/"," ", fgets($datos));//usamos la una función que nos cambia todo el exceso de espacios en blanco definido en la función regular por un solo espacio en blanco
      $columnas = explode(' ',$linea);//Sacamos todas las columnas
      $size = count($columnas);
      for ($i=0; $i < $size; $i++) {//Nos quedamos con el número de la columna que nos estan pasando
        if ($columnas[$i] == $mostrar) $col = $i;
      }

      while(!feof($datos)) {//Hasta que no finalize el fichero
        $linea = preg_replace( "/\s+/"," ", fgets($datos));
        $columnas = explode(" ",$linea);//Sacamos todas las columnas

        $suma += str_replace(".","",$columnas[$col]);//reemplazamos los puntos por vacios y sumamos los números
      }
      $suma .="€";
      echo "Total $mostrar <input type=text value=$suma readonly>";
      fclose($datos);//Cerramso el fichero
      echo "<p>";
      echo "  <input type=submit name=Volver value=\"Hacer otra consulta\">";
      echo "</p>";
    echo "</form>";
    #FINAL CODIGO
  echo "</body>";
echo "</html>";
?>
