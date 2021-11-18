<?php
  function ContarJugadores(){//Vemos cuantos jugadores hay
    $con = 0;

    for ($i=1; $i < 5; $i++) {//Vemos cuantas cajas tienen no estan vacias para saber cuantos jugadores hay
      $nombre = 'nombre'.$i;
      if (!empty( $_POST[$nombre])) {$con++;}
    }

    return $con;
  }

  function ComprobarPremio() {//Comprobamos que se pase un premio y que no sea negativo
    if (empty( $_POST['apuesta'])) {$comprobar = 0;}//No pasan premio
    else if ($_POST['apuesta'] < 0) {$comprobar = 1;}//Pasan premio pero es negativo
    else {$comprobar = 2;}//Pasan premio y es positivo

    return $comprobar;
  }

  function ComprobarCartas() {//Comprobamos que se pasen cartas y que no sea negativo
    if (empty( $_POST['numcartas'])) {$comprobar = 0;}//No pasan cartas
    else if ($_POST['numcartas'] < 0) {$comprobar = 1;}//Pasan cartas pero es negativo
    else if ($_POST['numcartas'] < 2 || $_POST['numcartas'] > 6) {$comprobar = 2;}//Pasan cartas pero es negativo
    else {$comprobar = 3;}//Pasan cartas y es positivo

    return $comprobar;
  }

  function ArrayJugadores($numcartas) {//Le pasamos el número de cartas y devolvemos un array con los 4 jugadores más la banca y su correspondientes sumas
    $baraja=array("AC","2C","3C","4C","5C","6C","7C","JC","QC","KC",
  				 "AD","2D","3D","4D","5D","6D","7D","JD","QD","KD",
  	       "AP","2P","3P","4P","5P","6P","7P","JP","QP","KP",
  				 "AT","2T","3T","4T","5T","6T","7T","JT","QT","KT");
    $size = count($baraja);

    for ($x=0; $x < $numcartas; $x++) {//Creamos a la banca
      $jugadores['Banca'][$x] = $baraja[rand(0,($size-1))];//Sacamos una figura aleatoria y la añadimos al array de cada jugador
    }

    for ($i=1; $i < 5; $i++) {
      $nombre = $_POST['nombre'.$i];
        for ($x=0; $x < $numcartas; $x++) {//Aqui generamos tantas cartas aleatorias como sean necesarias
          $jugadores[$nombre][$x] = $baraja[rand(0,($size-1))];//Sacamos una figura aleatoria y la añadimos al array de cada jugador
        }
      }

    return $jugadores;
  }

  function TablaCartas($jugadores,$numcartas) {//Mostramos la tabla con las cartas de cada jugador
    echo "<table border=1>";
      foreach ($jugadores as $nombre => $valor) {
        echo "<tr>";
          echo "<td width=90px height=90px><h2>$nombre</h2></td>";
          for ($x=0; $x < $numcartas; $x++) {
            $numero = $jugadores[$nombre][$x];
            echo "<td><img src=./images/$numero.PNG width=90px height=90px></td>";
          }
        echo "</tr>";
      }
    echo "</table>";
  }

  function sumasJugador($jugadores) {//Le pasamos el array de los jugadores con sus cartas y devolvemos un array con sus sumas
    foreach ($jugadores as $nombre => $valor) {
      $sumas[$nombre] = 0;
      foreach ($valor as $fila => $numero) {
        if ($numero[0] == "A") {$sumas[$nombre] += 1;}
        else if ($numero[0] == "J" || $numero[0] == "Q" || $numero[0] == "K") {$sumas[$nombre] += 10;}
        else {$sumas[$nombre] += $numero[0];}
      }
    }

    return $sumas;
  }

  function verGanadores($sumas,$premio) {
    $banca = $sumas['Banca'];
    $mensaje = "";
    $gana = 0;//Contamos el número de ganadores
    foreach ($sumas as $nombre => $numero) {//Vamos a sacar los ganadores
      if ($numero > $banca && $numero <= 21 && $banca < 21) {
        $mensaje .= "$nombre $numero ";
        $gana++;
      }
    }
    $partes = explode(" ",$mensaje);//Jugadores = $partes[0+x] Premios = $partes[1+x]
    $tam = count($partes);
    $texto = "";//Textos adicionales que solo se muestren 1 vez

    $datos = fopen("./premios/premios_".date('djzHis').".txt","a");
    if ($mensaje == "" && $banca > 21) {echo "No ha ganado nadie";}
    else if ($banca <= 21 && $gana == 0) {
      echo "GANA LA BANCA!!!!";
    }
    else {
      for ($i=0; $i < $tam - 1; $i+=2) {
        if (in_array('Banca',$partes) && $partes[1] == 21){//En caso de que gane la banca y otros jugadores con 21 dividimos el premio entre 2 y se lo repartimos
          $texto = "BLACKJACK";
          echo "$partes[$i] tiene".$partes[$i+1]." y gana ".($premio/2)/$gana."€<br>";
          fwrite($datos,"$partes[$i]#$partes[1]#".($premio/2)/$gana."\n");
        }
        else if (in_array('Banca',$partes) && $partes[1] == $partes[3]) {
          $texto = "No ha ganado nadie";
        }
        else {
          if ($partes[1] == 21) {$texto = "BLACKJACK";}
          echo "$partes[$i] tiene ".$partes[$i+1]." y gana ".$premio/$gana."€<br>";
          fwrite($datos,"$partes[$i]#$partes[1]#".$premio/$gana."\n");
        }
      }
    }
    echo $texto;
    fclose($datos);
  }
 ?>
