<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $multiplos = array(array(2,4,6),array(8,10,12),array(14,16,18));
      #SUMAMOS POR FILAS
      echo "<table border=1>";
      echo "<legend><h2>Suma por filas</h2></legend>";
      for ($i=0; $i < 3; $i++) {//Este for controla las filas
        $suma = 0;
        for ($x=0; $x < 3; $x++) {//Este for controla las columnas
          $suma += $multiplos[$i][$x];
        }
        echo "<tr>";
          echo "<td>$suma</td>";
        echo "</tr>";
      }
      echo "</table>";
      #SUMAMOS POR COLUMNAS
      echo "<table border=1>";
      echo "<legend><h2>Suma por columnas</h2></legend>";
      echo "<tr>";
      for ($i=0; $i < 3; $i++) {//Este for controla las columnas
        $suma = 0;
        for ($x=0; $x < 3; $x++) {//Este for controla las filas
          $suma += $multiplos[$x][$i];
        }
          echo "<td>$suma</td>";
      }
      echo "</tr>";
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
