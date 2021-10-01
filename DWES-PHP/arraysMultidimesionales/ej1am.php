<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $multiplos = array(array(2,4,6),array(8,10,12),array(14,16,18));

      echo "<table border=1>";
      for ($i=0; $i < 3; $i++) {//Este for controla las filas
        echo "<tr>";
        for ($x=0; $x < 3; $x++) {//Este for controla las columnas
          echo "<td width=20px>".$multiplos[$i][$x]."</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
