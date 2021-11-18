<?php
include './funciones.php';
  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
      echo "<title>php ejemplo</title>";
    echo "</head>";
    echo "<body>";
      #PRINCIPIO DE CODIGO
        $jugadores = array();//Cremos un array para los jugadores
        //Lo primero que haremos sera comprobar que juegen los cuatro jugadores
        if (ContarJugadores() != 4) {echo "<h1 align=center><b>ERROR </b>Como mínimo debe haber 4 jugadores</h1>";}
				else if (ComprobarCartas() == 0){echo "<h1 align=center><b>ERROR </b>Se debe pasar un número de cartas</h1>";}
				else if (ComprobarCartas() == 1){echo "<h1 align=center><b>ERROR </b>El número de cartas no puede ser negativo</h1>";}
				else if (ComprobarCartas() == 2){echo "<h1 align=center><b>ERROR </b>Número de cartas entre 2 y 6</h1>";}
        else if (ComprobarPremio() == 0){echo "<h1 align=center><b>ERROR </b>Se debe pasar un premio</h1>";}
        else if (ComprobarPremio() == 1){echo "<h1 align=center><b>ERROR </b>El premio no puede ser negativo</h1>";}
        else {
					echo "<h1>RESULTADO BLACK JACK</h1>";
          $numcartas = $_POST['numcartas'];
          $premio = $_POST['apuesta'];
          $jugadores = ArrayJugadores($numcartas);

          TablaCartas($jugadores,$numcartas);
          $sumas = sumasJugador($jugadores);

          verGanadores($sumas,$premio);
        }
      #FINAL DE CODIGO
    echo "</body>";
  echo "</html>";
?>
