<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $multidimensional = array(array(1,2,3,4,5),
                   array(10,20,30,40,50),
                   array(8,7,6,2,1));
      $mayor = 0;$columna = 0;

      #MOSTRAMOS LA TABLA
      echo "<table border=1>";
        echo "<legend><h2>TABLA DEL ARRAY MULTIDIMENSIONAL</h2></legend>";
        for ($i=0; $i < count($multidimensional); $i++) {
          echo "<tr>";
          for ($x=0; $x < 5; $x++) {
            echo "<td>".$multidimensional[$i][$x]."</td>";
          }
          echo "</tr>";
        }
      echo "</table>";
      #AVERIGUAMOS CUAL ES EL ELEMENTO MAYOR
      for ($i=0; $i < count($multidimensional); $i++) {//Este for controla las filas
        for ($x=0; $x < 5; $x++) {//Este for controla las columnas
          if ($multidimensional[$i][$x] > $mayor){$mayor = $multidimensional[$i][$x];$columna=$x;}
        }
      }

      echo "<br>El elemento mayor es: $mayor <br>";
      #AHORA LO BUSCAMOS CON LA FUNCION ARRAY_SEARCH QUE NOS DEVOLVERA SU KEY LO QUE YA NOS DARA ACCESO A SU FILA Y LUEGO A SU COLUMNA
      $posi = array_search($mayor, $multidimensional);
      #MOSTRAMOS LA FILA
      echo "<table border=1>";
        echo "<legend><h2>MOSTRAMOS LA FILA DEL ELEMENTO MAYOR</h2></legend>";
        echo "<tr>";
        for ($i=0; $i < 5; $i++) {
          echo "<td>".$multidimensional[$posi][$i]."</td>";
        }
        echo "</tr>";
      echo "</table>";
      #MOSTRAMOS LA COLUMNA GRACIAS A LA VARIABLE QUE HEMOS GUARDADO QUE REGISTRA LA COLUMNMA

      echo "<table border=1>";
        echo "<legend><h2>MOSTRAMOS LA COLUMNA DEL ELEMENTO MAYOR</h2></legend>";

        for ($i=0; $i < count($multidimensional); $i++) {
          echo "<tr>";
          echo "<td>".$multidimensional[$i][$columna]."</td>";
          echo "</tr>";
        }
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
