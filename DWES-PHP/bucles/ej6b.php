<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
        $num = 5;
        $fact = 1;#Acumulador para el factorial del número

        if ($num < 0) echo "Introduce un número positivo";
        else if ($num == 0) echo "<h1>El factorial del número $num es $fact</h1>";#El factorial de 0 es 1
        else {
          for ($i=1; $i <= $num ; $i++) {#Calculamos el fatorial del número cogiendo todos los números entre uno y num - 1 y los multiplicamos
            $fact *= $i;
          }
          echo "<h1>El factorial del número $num es $fact</h1>";
        }

      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
