<?php
  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
      echo "<title>php ejemplo</title>";
    echo "</head>";
    echo "<body>";
      #INICIO CODIGO
      $ruta = $_POST['ruta'];
      if (!file_exists($ruta)){echo "<h1>No existe el fichero</h1>";}//Comprobamos que exisra el fichero que nos pasan
      else {
      echo "<h1>Operaciones ficheros</h1>";
          $partes = explode("\\",$ruta);
          $tamaño = count($partes);
          $nombre = $partes[$tamaño - 1];//Cogemos la ultima parte del array
          $dir = "";

          for ($i=0; $i < $tamaño - 1; $i++) {//Concatenamos el resto del array menos el final para sacar la dirrecion
            $dir .= $partes[$i]."\\";
          }

          echo "<p><b>Nombre del fichero: </b>$nombre</p>";
          echo "<p><b>Directorio: </b>$dir</p>";
          echo "<p><b>Nombre del fichero: </b>".filesize($ruta)."KB</p>";
          echo "<p><b>Ultima fecha modificación de fichero: </b>".date ("F d Y H:i:s.",filemtime($ruta))."</p>";
        }
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
?>
