<?php
  function Convertir($numero,$base) {
    return base_convert($numero, 10, $base);//Pasamos un número en base 10 al que convertimos a una base que nosotros le pasamos
  }
 ?>
