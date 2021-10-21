<?php
include './funciones/convertir.php';
  echo "<html>";
    echo "<head>";
      echo "<title>Cambio Bases</title>";
      echo "<meta charset=utf-8>";
    echo "</head>";
    echo "<body>";
      echo "<h1>CAMBIO DE BASES</h1>";
      #PRINCIPIO CODIGO
      $cadena = explode("/",trim($_POST['numero']));//Quitamos los espacios en blanco y sacamos el número y la base dividiendo la cadena por el separador /
      $numero = $cadena[0];
      $base = $cadena[1];
      $basen = $_POST['basen'];

      echo "Numero $numero en base $base = ".Convertir($numero,$base,$basen)." en base $basen";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
