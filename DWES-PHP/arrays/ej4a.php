<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      echo "<table border=1px WIDTH=400>";
        echo "<tr>";
          echo "<th align=center>Indice</th>";
          echo "<th align=center>Binario</th>";
          echo "<th align=center>Octal</th>";
        echo "</tr>";
        echo "<caption><h1>Tabla de los 20 primeros números binarios</h1></caption>";
        for ($i=0; $i < 20; $i++) {//Definimos los 20 primeros números binarios y sus octales
          $binario[$i] = base_convert($i,10,2);
        }
        $reves = array_reverse($binario);//Damos la vuelta al array usando la funcón de ordenador al reves
        
        for ($i=0; $i < count($reves); $i++) {//Mostramos los números
          echo "<tr>";
            echo "<td align=center>".$i."</td>";
            echo "<td align=center>".$reves[$i]."</td>";
            echo "<td align=center>".base_convert($reves[$i],2,8)."</td>";
          echo "</tr>";
        }
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
