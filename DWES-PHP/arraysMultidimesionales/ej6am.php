<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $aleatorio = array(array(rand(0, 100),rand(0, 100),rand(0, 100)),//Utilizamos la función ram("valor1","valor2") para generar números aleatorios emn
                   array(rand(0, 100),rand(0, 100),rand(0, 100)),
                   array(rand(0, 100),rand(0, 100),rand(0, 100)));

      //Generamos el array maximos por fila
      for ($i=0; $i < 3; $i++) {
        $max = 0;
        for ($x=0; $x < 3; $x++) {
          if ($aleatorio[$i][$x] > $max) $max = $aleatorio[$i][$x];
        }
        $mfila[$i] = $max;
      }

      //Generamos el array maximos por columna
      for ($i=0; $i < 3; $i++) {
        $max = 0;
        for ($x=0; $x < count($aleatorio); $x++) {
          if ($aleatorio[$x][$i] > $max) $max = $aleatorio[$x][$i];
        }
        $mcolumna[$i] = $max;
      }

      //Mostramos la matriz
      echo "<table border=1>";
        echo "<legend><h2>Matriz con números aleatorios</h2></legend>";
        for ($i=0; $i < count($aleatorio); $i++) {#Para controlar las filas
          echo "<tr>";
          for ($x=0; $x < 3; $x++) {#Para controlar las coulumnas
            echo "<td width=20>".$aleatorio[$i][$x]."</td>";
          }
          echo "</tr>";
        }
      echo "</table>";

      //Mostramos el maximo por fila
      echo "<table border=1>";
        echo "<legend><h2>Maximo por filas</h2></legend>";
        echo "<tr>";
          echo "<th>Fila 1</th>";echo "<th>Fila 2</th>";echo "<th>Fila 3</th>";
        echo "</tr>";
        echo "<tr>";
        for ($i=0; $i < count($mfila); $i++) {
          echo "<td>".$mfila[$i]."</td>";
        }
        echo "</tr>";
      echo "</table>";
      //Mostramos el maximo por columnas
      echo "<table border=1>";
        echo "<legend><h2>Maximo por columnas</h2></legend>";

        for ($i=0; $i < count($mcolumna); $i++) {
          echo "<tr>";
            echo "<th>Columna".($i+1)."</th>";
            echo "<td>".$mcolumna[$i]."</td>";
          echo "</tr>";
        }

      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
