<?php
include './funciones/transformarip.php';
  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
      echo "<title>Convertir Ip</title>";
    echo "</head>";
    echo "<body>";
      echo "<h1>Ips</h1>";
      echo "<div class=cajaform>";
      #PRINCIPIO CODIGO
      $ip = $_POST['ip'];
      $bin = TransformarIp($ip);
        echo "<form>";
        echo "Ip notación decimal: <input type=text name=ip value=$ip readonly><br><br>";
        echo "Ip notación binaria: <input type=text name=bin value=$bin readonly size=35>";
        echo "</form>";
      echo "</div>";
  echo "</body>";
  echo "</html>";
 ?>
