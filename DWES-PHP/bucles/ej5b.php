<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $num = 6;
      $mul = 0;

      echo "<table border=1px WIDTH=400>";
        echo "<caption>Tabla de multiplicar del ".$num."</caption>";
        for ($i=0; $i <= 10; $i++) {#Multiplicamos el número por $i hasta 10
          $mul = $num*$i;
          echo "<tr>";
            echo "<td align=center>$num x $i</td>";
            echo "<td align=center>$mul</td>";
          echo "</tr>";
        }
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
