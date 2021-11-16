<?php
  function cambiarFormatoFecha($fecha) {//Recibe la fecha con el formato que genera automaticamente el input date y nos devuelve la fecha con un formato más normal para nosotros
    $partesFecha = explode("-",$fecha);
    $nuevoFormato = $partesFecha[2]."/".$partesFecha[1]."/".$partesFecha[0];

    return $nuevoFormato;
  }

  function generarCombinacion() {//Devolvemos la combinacion ganadora generada de forma aleatoria en forma de array
    $combinacion[0] = rand(1,7);//Generamos el primer número y el array

    for ($i=1; $i < 7; $i++) {//Rellenamos el resto del array teniendo en cuenta que no se repita ningun número
      do {
        $numero = rand(1,7);
      } while (in_array($numero, $combinacion));
      $combinacion[$i] = $numero;
    }

    do {//Lo hacemos a parte ya que el aleatorio del ultimo número es distinto
      $numero = rand(0,9);
    } while (in_array($numero, $combinacion));
    $combinacion[7] = $numero;

    return $combinacion;
  }

  function mostrarCombinacion($combinacion) {//Le pasamos un array con la combinación ganadora para mostrarlo generando el codigo html necesario
    echo "<div>";
      for ($i=0; $i < 6; $i++) {
        echo "<span class=num><img src=./imagenes/r22_bolasprimitiva/".$combinacion[$i].".png></span>";
      }
      echo "<p class=gris><span class=gris>Complementario:</span><img src=./imagenes/r22_bolasprimitiva/".$combinacion[6].".png></p>";
      echo "<p class=gris><span class=gris>Reintegro:</span><img src=./imagenes/r22_bolasprimitiva/rbola".$combinacion[7].".png></p>";
    echo "</div>";
  }

  function participantesSorteo() {//Contamos las lineas del archivo para ver los participantes
    $participantes = 0;

    $datos = fopen("./resultados/r22_primitiva.txt","r");
    fgets($datos);//Saltamos la primera linea ya que es despreciable para la cuenta de participantes

    while(!feof($datos)){//contamos el número de lineas para sacar el número de participantes
      $participantes++;
      fgets($datos);
    }
    fclose($datos);

    return $participantes;
  }

  function verAciertos($combinacion) {//Vamos a mostrar el número de apuestas jugadas y acertantes. Le pasamos el array con la combinación ganadora
    $conReintegros = 0;
    $aciertos = [0,0,0,0,0,0,0,0];

    $datos = fopen("./resultados/r22_primitiva.txt","r");
    fgets($datos);//Saltamos la primera linea ya que es despreciable para la cuenta de aciertos

    while(!feof($datos)){//contamos el número de lineas para sacar el número de participantes
      $con = 0;
      $linea = explode("-",fgets($datos));

      for ($i=0; $i < 6; $i++) {//Contamos el número de aciertos de cada uno de los 6 números de cada participante
        if ($linea[$i+1] == $combinacion[$i]){$con++;}
      }

      if ($linea[8] == $combinacion[7]) {$aciertos[7]++;}

      switch ($con) {//Vemos cuantos a acertado X númeross
        case 0:
          $aciertos[0]++;
          break;
        case 1:
          $aciertos[1]++;
          break;
        case 2:
          $aciertos[2]++;
          break;
        case 3:
          $aciertos[3]++;
          break;
        case 4:
          $aciertos[4]++;
          break;
        case 5:
          $aciertos[5]++;
          break;
        case 6:
          $aciertos[6]++;
          break;
      }
    }

    fclose($datos);

    return $aciertos;
  }

  function gestionarPremios($premio) {//Escribimos los datos en el fichero que se nos pide y le pasamos la recaudacion para poder operar con la misma
    $fichero = "./premios/premiosorteo".date("jdY").".txt";//Nos creamos la ruta del fichero
    $datos = fopen($fichero,"w");

    fwrite($datos,"C6 # premio a percibir cada acertante 6 aciertos = ".($premio*0.40)."\n");
    fwrite($datos,"C5+# premio a percibir cada acertante 5 aciertos + complementario = ".($premio*0.30)."\n");
    fwrite($datos,"C5 # premio a percibir cada acertante 5 aciertos = ".($premio*0.15)."\n");
    fwrite($datos,"C4 # premio a percibir cada acertante 4 aciertos = ".($premio*0.05)."\n");
    fwrite($datos,"C3 # premio a percibir cada acertante 4 aciertos = ".($premio*0.08)."\n");
    fwrite($datos,"CR # premio a percibir cada acertante reintegro = ".($premio*0.02)."\n");

    fclose($datos);
  }
 ?>
