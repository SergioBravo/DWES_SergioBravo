<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $primera = array(array(1,2,3),array(4,5,6),array(7,8,9));
      $segunda = array(array(10,11,12),array(13,14,15),array(16,17,18));
      $suma = array();$multi = array();

      //Suma de matrices al tener el mismo tamaño aix + bix
      for ($i=0; $i < count($primera); $i++) {
        $suma[$i] = array();$multi = array();
        for ($x=0; $x <count($primera[$i]); $x++) {
          $suma[$i][$x] = $primera[$i][$x] + $segunda[$i][$x];
        }
      }

      //Multipiclacion de matrices
      for ($i=0;$i< count($primera);$i++){#Recorremos las filas de la primera matriz
        for($x=0;$x<count($segunda[$i]);$x++){#Recorremos las columnas de la segunda matriz
          $multi[$i][$x]=0;#Cada vez que avancemos en las columnas creamos un nuevo array para la matriz
          for($k=0;$k<count($segunda);$k++){#Recorremos las filas de la segunda matriz
            $multi[$i][$x]+=$primera[$i][$k]*$segunda[$k][$x];#Suma de la multiplicación de la fila de la primera matriz con la de la segunda
          }
        }
      }

      //Mostramos la matriz primera
      echo "<table border=1>";
        echo "<legend><h2>Matriz Primera</h2></legend>";
        for ($i=0; $i < count($primera); $i++) {#Para controlar las filas
          echo "<tr>";
          for ($x=0; $x < count($primera[$i]); $x++) {#Para controlar las coulumnas
            echo "<td width=20>".$primera[$i][$x]."</td>";
          }
          echo "</tr>";
        }
      echo "</table>";

      //Mostramos la matriz segunda
      echo "<table border=1>";
        echo "<legend><h2>Matriz Segunda</h2></legend>";
        for ($i=0; $i < count($segunda); $i++) {#Para controlar las filas
          echo "<tr>";
          for ($x=0; $x < count($segunda[$i]); $x++) {#Para controlar las coulumnas
            echo "<td width=20>".$segunda[$i][$x]."</td>";
          }
          echo "</tr>";
        }
      echo "</table>";

      //Mostramos la matriz suma
      echo "<table border=1>";
        echo "<legend><h2>Matriz Suma</h2></legend>";
        for ($i=0; $i < count($suma); $i++) {#Para controlar las filas
          echo "<tr>";
          for ($x=0; $x < count($suma[$i]); $x++) {#Para controlar las coulumnas
            echo "<td width=20>".$suma[$i][$x]."</td>";
          }
          echo "</tr>";
        }
      echo "</table>";

      //Mostramos la matriz multiplicación
      echo "<table border=1>";
        echo "<legend><h2>Matriz Multiplicación</h2></legend>";
        for ($i=0; $i < count($multi); $i++) {#Para controlar las filas
          echo "<tr>";
          for ($x=0; $x < count($multi[$i]); $x++) {#Para controlar las coulumnas
            echo "<td width=20>".$multi[$i][$x]."</td>";
          }
          echo "</tr>";
        }
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
