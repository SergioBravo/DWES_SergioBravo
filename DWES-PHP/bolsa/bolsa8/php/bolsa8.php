<?php
echo "<html lang=es dir=ltr>";
  echo "<head>";
    echo "<meta charset=utf-8>";
    echo "<title>php ejemplo</title>";
  echo "</head>";
  echo "<body>";
  #PRINCIPIO CODIGO
    echo "<form action=../bolsa8.html method=post>";
      $valor = $_POST['valor'];//La opcion que eligue el usuario
      echo "<p>Valor: <input type=text value=$valor readonly></p>";
      $mostrar = $_POST['mostrar'];//La opcion que eligue el usuario
      $col = 0;//Para guardar el número de columna

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
        if ($columnas[0] == $valor) echo "<p>$mostrar: <input type=text value=".$columnas[$col]." readonly></p>";
      }

      fclose($datos);//Cerramso el fichero
      echo "<p>";
      echo "  <input type=submit name=Volver value=\"Hacer otra consulta\">";
      echo "</p>";
    echo "</form>";
    #FINAL CODIGO
  echo "</body>";
echo "</html>";
?>
