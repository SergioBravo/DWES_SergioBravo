<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      for ($i=0; $i < 50; $i++) {//Creamos el array de la bolsa de forma dinamica
        $bolsa = array("Empresa$i" ==> array());
        for ($x=0; $x < 9 ; $x++) {
          $bolsa[$i][$x] = array("valor$x" ==> array());
        }
      }

      //Mostramos el array
      echo "<table border=1>";
        echo "<legend><h2>Tabla de atributos de cada empresa en la bolsa</h2></legend>";
        echo "<tr>";
          echo "<th>Empresa</th>";echo "<th>Precio</th>";echo "<th>Valor</th>";echo "<th>Variación</th>";echo "<th>Npi</th>";
        echo "</tr>";
        foreach ($bolsa as $empresa => $atributos) {
          echo "<tr>";
            echo "<td>$empresa</td>";
          foreach ($atributos as $atributo => $valor) {
            if ($atributo == "precio") echo "<td width=50>-$valor %</td>";
            elseif ($atributo == "valor") echo "<td width=50>$valor €</td>";
            else echo "<td width=50>$valor</td>";
          }
          echo "</tr>";
        }
      echo "</table>";
      echo "-----------------------------------------------------------------------------------------------------------------------------------";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
 $bolsa = array ("inditex" => array("valor1" => 0.07,"valor2" => 0.10,"valor3" => 100000,"valor4" => 15000000000,"valor5" => 15000000000,"valor6" => 15000000000,"valor7" => 15000000000,"valor8" => 15000000000,"valor9" => 15000000000),
                 "Bbva" => array("precio" => 9,"valor" => 10,"variacion" => 8,"npi" => 9));
