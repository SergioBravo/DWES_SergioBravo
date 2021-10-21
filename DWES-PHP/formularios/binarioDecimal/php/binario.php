<?php
include './funciones/conversor.php';
  echo "<html>";
    echo "<head>";
      echo "<title>Conversor Binario</title>";
      echo "<meta charset=utf-8>";
    echo "</head>";
    echo "<body>";
      echo "<h1 align=Center>CONVERSOR BINARIO</h1>";
      echo "<div class=cajaForm align=center>";
      #VARIABLE
      $decimal = $_POST['decimal'];
        echo "<form>";
          echo "<p>";
            echo "<label for=deci>Número decimal: </label>";
            echo "<input type=text name=deci readonly value=$decimal>";
          echo "</p>";
          echo "<p>";
            echo "<label for=deci>Número decimal: </label>";
            echo "<input type=text name=deci readonly value=".Convertir($decimal).">";
          echo "</p>";
        echo "</form>";
      echo "</div>";
    echo "</body>";
  echo "</html>";
 ?>
