<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      //Definimos la matriz
      for ($i=0; $i < 3; $i++) {#Para controlar las filas
        for ($x=0; $x < 5; $x++) {#Para controlar las columnas
          $numeros[$i][$x]=$i+$x;
        }
      }

      //Mostramos la matriz por columnas
      echo "<table border=1>";
        echo "<legend><h2>Matriz con la suma de sus Fila-Columna en cada posición</h2></legend>";
        for ($i=0; $i < count($numeros); $i++) {#Para controlar las columnas
          echo "<tr>";
          for ($x=0; $x < 5; $x++) {#Para controlar las filas
            echo "<td width=20>".$numeros[$i][$x]."</td>";
          }
          echo "</tr>";
        }
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
