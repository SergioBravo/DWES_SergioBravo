<?php
  function Convertir($numero,$base,$basen) {
    return base_convert($numero, $base, $basen);//Pasamos un número en base 10 al que convertimos a una base que nosotros le pasamos
  }
 ?>
