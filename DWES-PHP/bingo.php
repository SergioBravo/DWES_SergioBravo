<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $bombo = range(1, 60);//Generamos un array con numeros del 1 al 60
      shuffle($bombo);//Mezclamos de forma aleatoria los números generados

      #CREAMOS LOS CARTONES
      $cartones = crearCartones($bombo);
      #CREAMOS EL BOMBO CAMBIANDO DE MANERA ALEATORIA DE NUEVO LOS NÚMEROS DEL MISMO
      shuffle($bombo);
      #CREAMOS EL JUEGO COMPARANDO LOS NÚMEROS QUE VAYAN SALIENDO DEL BOMBO CON LOS DEL CARTON
      $vueltas1 = compararNumero($cartones["carton1"],$bombo);
      $vueltas2 = compararNumero($cartones["carton2"],$bombo);
      $vueltas3 = compararNumero($cartones["carton3"],$bombo);
      $vueltas4 = compararNumero($cartones["carton4"],$bombo);
      #GANADOR
      //Comparamos todos los valores para saber quien ha dado menos vueltas y por tanto es el ganador
      //Para añadir los espacios en negro tenemos que tener en cuenta si el siguiente al número de cada fila es 2*10 veces mayor que el
      //Seria conveniente hacer una tabla con una fila que tenga a su vez las tablas de los distintos cartones
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";

  #FUNCIONES---------------------------------------------------------------------------------
function crearCartones($bombo) {//Creamos los cartones puede haber x cartones
  for ($w=1; $w < 5; $w++) {//Modificando los valores podemos crear los cartones que queramos
    $nombre = "carton".$w;
    $cartones[$nombre] = array();

    for ($i=0; $i < 15; $i++) {//Cogemos los 15 primeros números de la generación
      $numerosCarton[$i] = $bombo[$i];
    }

    sort($numerosCarton);
    $con = 0;

    for ($i=0; $i < 3; $i++) {
      $cartones[$nombre][$i] = array();
      for ($x=0; $x < 5; $x++) {
        $cartones[$nombre][$i][$x] = $numerosCarton[$x + $con];
      }
      $con += 5;
    }
    shuffle($bombo);//Mezclamos de forma aleatoria los números generados
  }
  return $cartones;
}

function compararNumero($array,$bombo){
  $con = 0;$vueltas = 0;
  foreach ($bombo as $filas => $numeros) {
    foreach ($array as $fila => $columnas) {
      foreach ($columnas as $numero => $valor) {
        if ($valor == $numeros)$con++;
      }
    }
    if ($con < 15) $vueltas++;
  }
  return $vueltas;
}
 ?>
