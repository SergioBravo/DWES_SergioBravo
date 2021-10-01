<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ejercicio3-Direcciones de red</title>
  </head>
  <body>
    <?php
      $ip = "192.168.206.203/16";
      $mas = explode('/',$ip);#Sacamos la mascara
      $oct = explode('.',$mas[0]);#Sacamos los octetos
      $host = 32 - intval($mas[1]);#Sacamos los host
      $red = decbin($oct[0]).".".decbin($oct[1]).".".decbin($oct[2]).".".decbin($oct[3]);#para la dirrección de red
      $bro = $red;#para la dirreción de broadcast
      $con = 0;#contador auxiliar

      for ($i = strlen($red)-1;$con <= $host;$i--) {#calcular dirreción de red
        if ($red[$i] != ".") {
          $red[$i] = "0";
          $con++;
        }
      }
      $pri = $red;
      $pri[strlen($pri)-1] = "1";
      $pri = explode('.',$pri);#Sacamos los octetos binarios de la dirreción ip
      $pri = bindec($pri[0]).".".bindec($pri[1]).".".bindec($pri[2]).".".bindec($pri[3]);#Pasamos a decimal

      $con = 0;#contador auxiliar
      for ($i = strlen($bro)-1;$con <= $host;$i--) {#calcular dirreción de broadcast
        if ($bro[$i] != ".") {
          $bro[$i] = "1";
          $con++;
        }
      }
      $ult = $bro;
      $ult[strlen($ult)-1] = "0";
      $ult = explode('.',$ult);#Sacamos los octetos binarios de la dirreción ip
      $ult = bindec(intval($ult[0])).".".bindec(intval($ult[1])).".".bindec(intval($ult[2])).".".bindec(intval($ult[3]));#Pasamos a decimal

      #Convertimos en decimal tanto la dirrecion de red como de broadcast
      $red = explode('.',$red);#Sacamos los octetos binarios de la dirreción ip
      $red = bindec($red[0]).".".bindec($red[1]).".".bindec($red[2]).".".bindec($red[3]);#Pasamos a decimal
      $bro = explode('.',$bro);#Sacamos los octetos binarios de la dirreción ip
      $bro = bindec($bro[0]).".".bindec($bro[1]).".".bindec($bro[2]).".".bindec($bro[3]);#Pasamos a decimal

      echo "<h1>"."IP ".$ip."</h1><br/>";
      echo "<h1>"."Mascara ".$mas[1]."</h1><br/>";
      echo "<h1>"."Dirección de red:".$red."</h1><br/>";
      echo "<h1>"."Dirección de Broadcast: ".$bro."</h1><br/>";
      echo "<h1>"."Rango: ".$pri." a ".$ult."</h1>";
     ?>
  </body>
</html>
