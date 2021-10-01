<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $normal = array(array(1,2,3),array(4,5,6),array(7,8,9),array(10,11,12));

      //Mostramos la matriz normal
      echo "<table border=1>";
        echo "<legend><h2>Matriz Normal</h2></legend>";
        for ($i=0; $i < count($normal); $i++) {#Para controlar las filas
          echo "<tr>";
          for ($x=0; $x < count($normal[$i]); $x++) {#Para controlar las coulumnas
            echo "<td width=20>".$normal[$i][$x]."</td>";
          }
          echo "</tr>";
        }
      echo "</table>";

      //Sacamos la matriz traspuesta
      for ($i=0; $i < count($normal[$i]); $i++) {
        for ($x=0; $x < count($normal); $x++) {
          $traspuesta[$i][$x] = $normal[$x][$i];
        }
      }

      //Mostramos la matriz traspuesta
      echo "<table border=1>";
        echo "<legend><h2>Matriz Traspuesta</h2></legend>";
        for ($i=0; $i < count($traspuesta); $i++) {#Para controlar las filas
          echo "<tr>";
          for ($x=0; $x < count($traspuesta[$i]); $x++) {#Para controlar las coulumnas
            echo "<td width=20>".$traspuesta[$i][$x]."</td>";
          }
          echo "</tr>";
        }
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
