<?php
  echo "<html>";
    echo "<head><link rel=stylesheet href=./css/bingo.css></head>";
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
      #CREAMOS EL JUEGO COMPARANDO LOS NÚMEROS QUE VAYAN SALIENDO DEL BOMBO CON LOS DEL CARTON
      #GANADOR
      $minVueltas = 60;
      $ganador = "";$ganadores = "";$num = 0;
      for ($i=1; $i < 5; $i++) {//Creamos un comparador donde iremos mirando quien ha dado menos vueltas hasta completar el carton y por lo tanto ganar la partida
        $nombre = "carton".$i;
        if (numeroVueltas($cartones[$nombre],$bombo) < $minVueltas) {$minVueltas = numeroVueltas($cartones[$nombre],$bombo);$ganador = $nombre;$num = 0;}
        if (numeroVueltas($cartones[$nombre],$bombo) == $minVueltas) {$ganadores .= "|$nombre";$num++;}
      }
      #MOSTRAMOS EL BOMBO
      echo "<div align=center>";
        mostrarBombo($bombo,$minVueltas,$cartones[$ganador]);
      echo "</div>";
      #MOSTRAMOS EL GANADOR
      if ($num > 1) echo "<h2 align=center>BINGO <span style=color:red;text-transform:capitalize;>".$ganadores."!!!!!!!</span></h2>";
      else echo "<h2 align=center>BINGO <span style=color:red;text-transform:capitalize;>".$ganador."!!!!!!!</span></h2>";
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

    for ($i=0; $i < 15; $i++) {//Metemos los 15 ordenados en el carton
      $cartones[$nombre][$i] = $numerosCarton[$i];
    }
    shuffle($bombo);//Mezclamos de forma aleatoria los números generados
  }
  return $cartones;
}

function numeroVueltas($array,$bombo){//Comprobamos cuantas vueltas da un carton hasta completarse
  $con = 0;$vueltas = 0;
  while ($con < 15) {
    foreach ($bombo as $filas => $numeros) {
      foreach ($array as $fila => $valor) {
          if ($valor == $numeros)$con++;
      }
      if ($con < 15) ++$vueltas;
    }
  }
  return $vueltas;
}

function mostrarCartones($cartones) {//Creamos una tabla con una sola fila que contiene las tablas de los cartones
  $con = 0;//Para controlar las columnas de cada tabla de los cartones
  echo "<table cellspacing=10px>";
    echo "<tr>";
    foreach ($cartones as $nombreCarton => $carton) {
      echo "<td>";
      echo "<table border=1px>";
        echo "<h2><legend style=text-transform:capitalize>$nombreCarton</legend></h2>";
        for ($i=0; $i < count($carton); $i++) {
          if ($con == 0) echo "<tr>";
          echo "<th width=35px height=35px align=center>".$carton[$i]."</th>";
          $con++;
          if ($con == 5){echo "</tr>";$con = 0;}
        }
      echo "</table>";
      echo "</td>";
    }
    echo "</tr>";
  echo "</table>";
}

function mostrarBombo($bombo,$vueltas,$carton) {//Mostramos el bombo en el orden de aparición con las imagenes correspondientes
  $con = 0;//Para controlar las columnas de la tabla bombo
  echo "<table border=1px>";
  echo "<h2><legend>Orden aparición bombo</legend></h2>";
    for ($i=0; $i < $vueltas + 1; $i++) {//Solo dara vueltas hasta el número que le ha dado la victoria al ganador
      $comp = false;
      for ($x=0; $x < count($carton); $x++) {//Comparamos el número del bombo con el de el cartón ganador y pasamos el boolean a tru
        if ($bombo[$i] == $carton[$x]) $comp = true;
      }
        if ($con == 0) echo "<tr>";
        if ($comp == true) {//Si el número del bombo y el carton coinciden los marcamos
          echo "<td><div class=contenedor>".($i+1)."<img src=./imagenes/".$bombo[$i].".PNG alt=bola".$bombo[$i]." width=50px height=50px>";//Aprovechamos el número que se muestra en la posicion i del bombo para sacar su correspondiente imagen
          echo "<div class=tachado>----</div></div></td>";
        }
        else echo "<td>".($i+1)."<img src=./imagenes/".$bombo[$i].".PNG alt=bola".$bombo[$i]." width=50px height=50px>";
        $con++;
        if ($con == 12){echo "</tr>";$con = 0;}//Cuando haya 12 columnas cerramos la fila y ponemos el contador a 0 para abrir una nueva
      }
  echo "</table>";

}
 ?>
