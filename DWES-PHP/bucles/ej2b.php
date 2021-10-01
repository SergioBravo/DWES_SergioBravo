<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      echo "<h1>Transformación decimal a cualquier base</h1>";
      #PRINCIPIO CODIGO
      $num = 192;#Introducimos cualquier número
      $base = 3;#Introducimos la base
      $numAux = $num;#Para poder ir dividiendolo sin cambiar el número
      $binR = "";#Para ir introduciendo los restos del ultimo al primero y asi crear el número en binario al reves
      $binB = "";#Para poner de forma correcta la cadena binR

      while ($numAux > 0 ) {#Sacamos el número binario al reves
        $binR .= strval($numAux % $base);
        $numAux = intval($numAux / $base);
      }

      for ($i= (strlen($binR) - 1); $i >= 0; $i--) {#Damos la vuelta a la cadena bin para sacar el número en binario bien
        $binB.=$binR[$i];
      }
      #FINAL CODIGO
      echo "<h2>El número ".$num." en base ".$base." es ".$binB."</h2>";
    echo "</body>";
  echo "</html>";
 ?>
