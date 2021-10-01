<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      echo "<h1>Transformación decimal-binario bucles</h1>";
      #PRINCIPIO CODIGO
      $num = 192;#Introducimos cualquier número
      $numAux = $num;#Para poder ir dividiendolo sin cambiar el número
      $binR = "";#Para ir introduciendo los restos del ultimo al primero y asi crear el número en binario al reves
      $binB = "";#Para poner de forma correcta la cadena binR

      while ($numAux > 0 ) {#Sacamos el número binario al reves
        $binR .= strval($numAux % 2);
        $numAux = intval($numAux / 2);
      }

      for ($i= (strlen($binR) - 1); $i >= 0; $i--) {#Damos la vuelta a la cadena bin para sacar el número en binario bien
        $binB.=$binR[$i];
      }
      #FINAL CODIGO
      echo "<h2>El número ".$num." en binario es ".$binB."</h2>";
    echo "</body>";
  echo "</html>";
 ?>
