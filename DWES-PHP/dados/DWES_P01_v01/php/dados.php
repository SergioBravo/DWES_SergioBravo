<?php
include './funciones/funciones.php';
  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
      echo "<title>php ejemplo</title>";
    echo "</head>";
    echo "<body>";
      echo "<h1>RESULTADO JUEGO DADOS</h1>";
      #PRINCIPIO DE CODIGO
        $jugadores = array();//Cremos un array para los jugadores
        //Lo primero que haremos sera comprobar que los datos que nos pasan son los correctos dentro de las reglas del juego
        if (ContarJugadores() < 2) {echo "<h1 align=center><b>ERROR </b>Como mínimo debe haber 2 jugadores</h1>";}
        else if (ContarDados() != ""){echo ContarDados();}
        else {
          echo "<p>".date('l jS \of F Y h:i:s A')."</p>";
          $numdados = $_POST['numdados'];
          $jugadores = ArrayJugadores($numdados);

          TablaDados($jugadores,$numdados);
          JuegoDados($jugadores,$numdados);
        }
      #FINAL DE CODIGO
    echo "</body>";
  echo "</html>";
?>
