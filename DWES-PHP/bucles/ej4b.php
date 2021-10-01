<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
        $num = 6;
        echo "<h1>Tabla de multiplicar del ".$num."</h1>";

        for ($i=0; $i <= 10; $i++) {#Multiplicamos el número por $i hasta 10
          echo "<h2>".$num." x ".$i." = ".$num*$i."</h2>";
        }
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
