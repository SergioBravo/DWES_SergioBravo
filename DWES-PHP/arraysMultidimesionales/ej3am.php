<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $multidimensional = array(array("Elemento 1,1","Elemento 1,2","Elemento 1,3","Elemento 1,4","Elemento 1,5"),
                   array("Elemento 2,1","Elemento 2,2","Elemento 2,3","Elemento 2,4","Elemento 2,5"),
                   array("Elemento 3,1","Elemento 3,2","Elemento 3,3","Elemento 3,4","Elemento 3,5"));
      #MOSTRAMOS POR FILAS
      echo "<table border=1>";
      echo "<legend><h2>Mostrar por filas</h2></legend>";
      for ($i=0; $i < count($multidimensional); $i++) {//Este for controla las filas
        echo "<tr>";
        for ($x=0; $x < 5; $x++) {//Este for controla las columnas
          echo "<td>".$multidimensional[$i][$x]."</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
      #MOSTRAMOS POR COLUMNAS
      echo "<table border=1>";
      echo "<legend><h2>Mostrar por Columnas</h2></legend>";
      for ($i=0; $i < 5; $i++) {//Este for controla las filas
        echo "<tr>";
        for ($x=0; $x < count($multidimensional); $x++) {//Este for controla las columnas
          echo "<td>".$multidimensional[$x][$i]."</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
