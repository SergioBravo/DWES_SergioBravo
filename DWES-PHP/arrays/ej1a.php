<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $anteriores = 0;#Almacena el anterior número

      echo "<table border=1px WIDTH=400>";
        echo "<tr>";
          echo "<th align=center>Indice</th>";
          echo "<th align=center>Valor</th>";
          echo "<th align=center>Suma</th>";
        echo "</tr>";
        echo "<caption><h1>Tabla de los 20 primeros números impares</h1></caption>";

        for ($i=0; $i < 20; $i++) {#Almacenamos los 20 primeros números impares
          $valor[$i] = 2*$i+1;#Almacenamos el valor de los impares usando la formula
        }

        for ($i=0; $i < count($valor); $i++) {//Sacamos los datos
            $anteriores += $valor[$i];

            echo "<tr>";
              echo "<td align=center>".$i."</td>";
              echo "<td align=center>".$valor[$i]."</td>";
              echo "<td align=center>".$anteriores."</td>";
            echo "</tr>";
            
        }
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
