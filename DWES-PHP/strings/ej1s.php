<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>EJ1-Conversion IP Decimal a Binario</title>
  </head>
  <body>
  <?php
    $ip="192.18.16.204";
    $arrayip = explode('.',$ip);
    printf("La IP $ip vale %b . %b. %b. %b en binario",intval($arrayip[0]),intval($arrayip[1]),intval($arrayip[2]),intval($arrayip[3]));
  ?>
  </body>
</html>
