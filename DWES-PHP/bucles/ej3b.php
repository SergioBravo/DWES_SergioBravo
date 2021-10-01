<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      echo "<h1>Transformación decimal a hexadecimal</h1>";
      #PRINCIPIO CODIGO
      $num = 192;#Introducimos cualquier número
      $numAux = $num;#Para poder ir dividiendolo sin cambiar el número
      $con = 0;#Para tener el cuenta los 4 bits que usaremos luego
      $bin = "";#Para sacar el número binario al reves ya que luego lo necesitamos para convertilo a hexadecimal
      $numHexa = "";#Para sacar el número en hexadecimal
      $numHexaB = "";#Numero hexadecimal bien ordenado
      $suma = 0;#Para controlar el valor de la suma de las posiciones de los cuartetos
      $letras = "ABCDEF";

      #Vamos a convertir en número en decimal
      while ($numAux > 0 ) {#Sacamos el número binario al reves
        if ($con == 4){$bin .=".";$con==0;}
        $bin .= strval($numAux % 2);
        $numAux = intval($numAux / 2);
        $con++;
      }

      #Convertimos el número a hexadecimal haciendo agrupaciones de 4
      $hexa = explode('.',$bin);

      for ($i=0; $i < sizeof($hexa); $i++) {#Accedemos a las posiciones del array
        for ($x=0; $x < 4; $x++) {
            $suma += $hexa[$i][$x]*2**$x;
            if ($suma > 9)$suma = $letras[$suma-10];
        }
        $numHexa .= strval($suma);
      }
      #Le damos la vuelta al número hexadecimal
      for ($i= (strlen($numHexa) - 1); $i >= 0; $i--) {
        $numHexaB.=$numHexa[$i];
      }

      #FINAL CODIGO
      echo "<h2>El número ".$num." en hexadecimal es ".$numHexaB."</h2>";
    echo "</body>";
  echo "</html>";
 ?>
