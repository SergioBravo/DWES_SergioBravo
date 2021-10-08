<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $bombo = range(1, 60);//Generamos un array con numeros del 1 al 60
      shuffle($bombo);//Mezclamos de forma aleatoria los números generados

      #CREAMOS LOS CARTONES
      $cartones = crearCartones($bombo);
      #MOSTRAMOS LOS CARTONES
      echo "<table cellspacing=10px>";
        echo "<tr>";
        foreach ($cartones as $nombreCarton => $carton) {
          echo "<td>";
          echo "<table border=1px>";
            echo "<h2><legend>$nombreCarton</legend></h2>";
            foreach ($carton as $fila => $columnas) {
              echo "<tr>";
              foreach ($columnas as $numero => $valor) {
                echo "<td>$valor</td>";
              }
              echo "</tr>";
            }
          echo "</table>";
          echo "</td>";
        }
        echo "</tr>";
      echo "</table>";
      #CREAMOS EL BOMBO CAMBIANDO DE MANERA ALEATORIA DE NUEVO LOS NÚMEROS DEL MISMO
      shuffle($bombo);
      #MOSTRAMOS EL BOMBO
      mostrarBombo($bombo);
      #CREAMOS EL JUEGO COMPARANDO LOS NÚMEROS QUE VAYAN SALIENDO DEL BOMBO CON LOS DEL CARTON
      #GANADOR
      $minVueltas = 60;
      $ganador = "";
      for ($i=1; $i < 5; $i++) {//Creamos un comparador donde iremos mirando quien ha dado menos vueltas hasta completar el carton y por lo tanto ganar la partida
        $nombre = "carton".$i;
        if (compararNumero($cartones[$nombre],$bombo) < $minVueltas) {$minVueltas = compararNumero($cartones[$nombre],$bombo);$ganador = $nombre;}
      }

      echo "<h2>El ganador del Bingo es <span style=color:red>".$ganador."</span></h2>";
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

function compararNumero($array,$bombo){//Comprobamos cuantas vueltas da un carton hasta completarse
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

function mostrarBombo($bombo) {
  $con = 0;//Para controlar las columnas de la tabla bombo
  echo "<table border=1px>";
  echo "<h2><legend>Orden aparición bombo</legend></h2>";
    for ($i=0; $i < count($bombo); $i++) {
      if ($con == 0) echo "<tr>";
      echo "<td>".$bombo[$i]."</td>";
      $con++;
      if ($con == 5){echo "</tr>";$con = 0;}
    }
  echo "</table>";

}
 ?>
