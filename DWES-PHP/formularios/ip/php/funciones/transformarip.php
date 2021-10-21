<?php
  function TransformarIp($ip) {
    if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $ip)) {//Usamos una expresión regular que dice que empieze por número que puedan ser de 1 a 3 que le siga un punto esto lo repite hasta decir que acabe por un número
      $arrayip = explode('.',$ip);
      $bin = base_convert(intval($arrayip[0]),10,2)."."
      .base_convert(intval($arrayip[1]),10,2)."."
      .base_convert(intval($arrayip[2]),10,2)."."
      .base_convert(intval($arrayip[3]),10,2);
      return $bin;
    } else {return "FormatoMal";}

  }
 ?>
