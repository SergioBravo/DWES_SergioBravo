<?php
  echo "<html>";
    echo "<head><link rel=stylesheet href=./css/bingo.css></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $bombo = range(1, 60);//Generamos un array con numeros del 1 al 60
      shuffle($bombo);//Mezclamos de forma aleatoria los números generados

      #CREAMOS LOS CARTONES
      for ($i=1; $i < 5; $i++) {//Con esto creamos los jugadores que queramos
        ${"jugador".$i} = crearCartones($bombo);//Creamos un array para cada jugado
      }
      #MOSTRAMOS LOS CARTONES
      echo "<div align=center>";
        echo "<table>";
          echo "<tr>";
            for ($i=1; $i < 5; $i++) {//Para cada jugador mostramos sus cartones
              mostrarCartones(${"jugador".$i},$i);
            }
          echo "</tr>";
        echo "</table>";
      echo "</div>";
      #CREAMOS EL BOMBO CAMBIANDO DE MANERA ALEATORIA DE NUEVO LOS NÚMEROS DEL MISMO
      shuffle($bombo);
      #CREAMOS UN ARRAY CON TODOS LOS JUGADORES QUE HAY PARA LUEGO PODER COMPARARLOS A TODOS A LA VEZ
      for ($i=0; $i < 4; $i++) {//Aqui hay que poner el número de jugadores que hay
        $jugadores[$i] = ${"jugador".($i+1)};
      }
      #GANADOR
      $ganador = ganadorBingo($jugadores,$bombo);
      $cartonGanador = explode(" ", $ganador);//Dividimos el String para poder sacar el jugador ganador y su cartón
      #MOSTRAMOS EL BOMBO
      echo "<div align=center>";
        mostrarBombo($bombo,numVueltas($jugadores,$bombo),${$cartonGanador[0]}[$cartonGanador[1]]);
      echo "</div>";
      #MOSTRAMOS EL GANADOR
      echo "<h2 align=center>BINGO <span style=color:red;text-transform:capitalize;>".$ganador."!!!!!!!</span></h2>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";

  #FUNCIONES---------------------------------------------------------------------------------
function crearCartones($bombo) {//Creamos los cartones puede haber x cartones
  for ($w=1; $w < 4; $w++) {//Modificando los valores podemos crear los cartones que queramos
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

function ganadorBingo($jugadores,$bombo){//Comprobamos cuantas vueltas da un carton hasta completarse
  $gana=false;$ganador = "";
  for ($i=0; $i < count($jugadores); $i++) {//Sacamos todos los jugadores
    for ($x=1; $x <= count($jugadores[$i]); $x++) {//Creamos un contador para cada cartón de cada jugador
      ${"j".($i+1)."con".$x} = 0;
    }
  }

  for ($i=0; $i < count($bombo) && $gana == false; $i++) {
    $conCar = 1;
    while ($conCar < 4) {//Comparamos que el número que sale esta o no en cada carton de cada jugador
      for ($x=0; $x < count($jugadores); $x++) {//Para cada jugador
        if (in_array($bombo[$i], $jugadores[$x]["carton".$conCar]))${"j".($x+1)."con".$conCar}++;
        if (${"j".($x+1)."con".$conCar} == 15) {$ganador .= "jugador".($x+1)." carton".$conCar." |";$gana = true;}
      }
      $conCar++;
    }
  }
  return $ganador;
}

function numVueltas($jugadores,$bombo){//Similar al ganador pero devolviendo el número de vueltas para mostrar el bombo
  $gana=false;$vueltas = 0;
  for ($i=0; $i < count($jugadores); $i++) {//Sacamos todos los jugadores
    for ($x=1; $x <= count($jugadores[$i]); $x++) {//Creamos un contador para cada cartón de cada jugador
      ${"j".($i+1)."con".$x} = 0;
    }
  }

  for ($i=0; $i < count($bombo) && $gana == false; $i++) {
    $conCar = 1;
    while ($conCar < 4) {//Comparamos que el número que sale esta o no en cada carton de cada jugador
      for ($x=0; $x < count($jugadores); $x++) {//Para cada jugador
        if (in_array($bombo[$i], $jugadores[$x]["carton".$conCar]))${"j".($x+1)."con".$conCar}++;
        if (${"j".($x+1)."con".$conCar} == 15) {$gana = true;}
      }
      $conCar++;
      $vueltas = $i;
    }
  }
  return $vueltas;
}

function mostrarCartones($jugador,$i) {//Creamos una tabla que va a contener tablas que mostraran los cartones de cada jugador
  $con = 0;//Para controlar las columnas de cada tabla de los cartones
  $nom = "Jugador".$i;
  echo "<table cellspacing=10px border=1px>";
    echo "<legend align=center><h2>".$nom."</h2></legend>";
    echo "<tr>";
    foreach ($jugador as $nombreCarton => $carton) {
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
    echo "</td>";
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
