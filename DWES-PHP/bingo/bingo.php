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
      echo "<div align=center>";
        mostrarCartones($cartones);
      echo "</div>";
      #CREAMOS EL BOMBO CAMBIANDO DE MANERA ALEATORIA DE NUEVO LOS NÚMEROS DEL MISMO
      shuffle($bombo);
      #MOSTRAMOS EL BOMBO
      echo "<div align=center>";
        mostrarBombo($bombo);
      echo "</div>";
      #CREAMOS EL JUEGO COMPARANDO LOS NÚMEROS QUE VAYAN SALIENDO DEL BOMBO CON LOS DEL CARTON
      #GANADOR
      $minVueltas = 60;
      $ganador = "";
      for ($i=1; $i < 5; $i++) {//Creamos un comparador donde iremos mirando quien ha dado menos vueltas hasta completar el carton y por lo tanto ganar la partida
        $nombre = "carton".$i;
        if (compararNumero($cartones[$nombre],$bombo) < $minVueltas) {$minVueltas = compararNumero($cartones[$nombre],$bombo);$ganador = $nombre;}
      }

      echo "<h2 align=center>El ganador del Bingo es <span style=color:red;text-transform:capitalize;>".$ganador."</span></h2>";
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

function mostrarCartones($cartones) {//Creamos una tabla con una sola fila que contiene las tablas de los cartones
  echo "<table cellspacing=10px>";
    echo "<tr>";
    foreach ($cartones as $nombreCarton => $carton) {
      echo "<td>";
      echo "<table border=1px>";
        echo "<h2><legend style=text-transform:capitalize>$nombreCarton</legend></h2>";
        foreach ($carton as $fila => $columnas) {
          echo "<tr>";
          foreach ($columnas as $numero => $valor) {
            echo "<th width=35px height=35px align=center>$valor</th>";
          }
          echo "</tr>";
        }
      echo "</table>";
      echo "</td>";
    }
    echo "</tr>";
  echo "</table>";
}

function mostrarBombo($bombo) {//Mostramos el bombo en el orden de aparición con las imagenes correspondientes
  $con = 0;//Para controlar las columnas de la tabla bombo
  echo "<table border=1px>";
  echo "<h2><legend>Orden aparición bombo</legend></h2>";
    for ($i=0; $i < count($bombo); $i++) {
      if ($con == 0) echo "<tr>";
      echo "<td><img src=./imagenes/".$bombo[$i].".PNG alt=bola".$bombo[$i]." width=50px height=50px></td>";//Aprovechamos el número que se muestra en la posicion i del bombo para sacar su correspondiente imagen
      $con++;
      if ($con == 12){echo "</tr>";$con = 0;}//Cuando haya 12 columnas cerramos la fila y ponemos el contador a 0 para abrir una nueva
    }
  echo "</table>";

}
 ?>
