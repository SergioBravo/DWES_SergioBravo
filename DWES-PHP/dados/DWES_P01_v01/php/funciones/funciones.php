<?php
  function ContarJugadores(){//Vemos cuantos jugadores hay
    $con = 0;

    for ($i=1; $i < 5; $i++) {//Vemos cuantas cajas tienen no estan vacias para saber cuantos jugadores hay
      $nombre = 'nombre'.$i;
      if (!empty( $_POST[$nombre])) {$con++;}
    }

    return $con;
  }

  function ContarDados(){//Contamos el número de dados que nos introducen
    $mensaje = "";

    if (empty($_POST['numdados'])) {$mensaje = "<h1 align=center><b>ERROR </b>No se ha introducido número de dados</h1>";}
    else {
      $numdados = $_POST['numdados'];
      if ($numdados < 1 || $numdados > 10) {$mensaje = "<h1 align=center><b>ERROR </b>Número de dados 1-10</h1>";}
    }

    return $mensaje;
  }

  function ArrayJugadores($numdados) {//Hacemos lo mismo que al contar jugadores pero devolvemos un array
    for ($i=0; $i < 4; $i++) {
      $nombre = 'nombre'.($i+1);
      if (!empty( $_POST[$nombre])) {//Vamos a generar un array asociativo que nos guarde el nombre del jugador y los dados que le corresponden
        for ($x=0; $x < $numdados; $x++) {//Aqui generamos dados aleatorios hasta el número de dados que nos hayan pasado
          $jugadores[$nombre][$x] = rand(1, 6);
        }//fin2for
      }//finif
    }//fin1for

    return $jugadores;
  }

  function TablaDados($jugadores,$numdados) {//Mostramos la tabla con los dados de cada jugador
    $size = count($jugadores);
    echo "<table border=1>";
      for ($i=0; $i < $size; $i++) {
        $nombre = 'nombre'.($i+1);
        $valor = $_POST[$nombre];
        echo "<tr>";
          echo "<td width=90px height=90px><h2>$valor</h2></td>";
          for ($x=0; $x < $numdados; $x++) {
            $numero = $jugadores[$nombre][$x];
            echo "<td><img src=../images/$numero.PNG width=90px height=90px></td>";
          }
        echo "</tr>";
      }
    echo "</table>";
  }

  function JuegoDados($jugadores,$numdados) {//Recorremos el array y sacamos los datos
    $size = count($jugadores);
    for ($i=1; $i <= $size; $i++) {//Sacamos las variables que nos haran falta dependiendo del numero de jugadores
      ${"suma".$i} = 0;
    }

    for ($i=0; $i < $size; $i++) {//Sacamos todos los jugadores
      $nombre = 'nombre'.($i+1);
      $con = 0;
      $anterior = $jugadores[$nombre][0];//Guardaos el primer número
      for ($x=0; $x < $numdados; $x++) {//Sacamos cada uno de sus números
        if ($jugadores[$nombre][$x] == $anterior) $con++;//Comprobamos que los  dados no sean iguales
        else $con = 0;
        ${"suma".($i+1)} += $jugadores[$nombre][$x];//Sumamos los números y los guardamos en su respectiva variable suma
        $anterior = $jugadores[$nombre][$x];
      }
      if ($con == $numdados && $numdados > 2) ${"suma".($i+1)} = 100;//En caso de tener todos los dados iguales y que haya más de dos dados la suma vale 100
    }

    $con = 1;//Para controlar los array suma
    foreach ($jugadores as $nombre => $array) {//Mostramos los jugadores con sus respectivas sumas
      $nom = $_POST[$nombre];
      echo "<p>$nom = ".${"suma".$con}."</p>";
      $con++;
    }

    $min = 0;$con = 0;$suma = 0;$gan = 0;
    for ($i=0; $i < $size ; $i++) {//Creamos un array con los ganadores
      if (${"suma".($i+1)} == $min){++$con;$ganador[$con] = $_POST['nombre'.($i+1)];$suma+=${"suma".($i+1)};$suma+=${"suma".($i+1)};}
      if (${"suma".($i+1)} > $min){$ganador[$con] = $_POST['nombre'.($i+1)];$min = ${"suma".($i+1)};$suma=${"suma".($i+1)};$gan = ${"suma".($i+1)};}
    }

    if ($suma % $gan != 0) unset($ganador[0]);//La suma de todos los ganadores debe ser divisible entre el ganador, ya que todos son iguales, en caso de que no lo sea se nos colo un ganador en posicon 0

    foreach ($ganador as $celda => $nombre) {//Sacamos los ganadores
      echo "<p>GANADOR $nombre</p>";
    }
    $numGanadores = count($ganador);
    echo "<p>El número de ganadores es $numGanadores</p>";//Sacamos el número de ganadores
  }
 ?>
