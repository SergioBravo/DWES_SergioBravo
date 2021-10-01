<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>EJ2-Conversion IP Decimal a Binario</title>
  </head>
  <body>
  <?php
    $ip="192.18.16.204";
    $arrayip = explode('.',$ip);
    echo "La ip $ip en base 2 es ". base_convert(intval($arrayip[0]),10,2)."."
    .base_convert(intval($arrayip[1]),10,2)."."
    .base_convert(intval($arrayip[2]),10,2)."."
    .base_convert(intval($arrayip[3]),10,2)." en binario";
  ?>
  </body>
</html>
