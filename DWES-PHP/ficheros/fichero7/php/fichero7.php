<?php
include('funciones.php');
  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
      echo "<title>php ejemplo</title>";
    echo "</head>";
    echo "<body>";
      #INICIO CODIGO
      echo "<h1>Operaciones sistema ficheros</h1>";
      $origen = $_POST['origen'];
      $destino = $_POST['destino'];
      $operacion = $_POST['operacion'];

      switch ($operacion) {
        case 'copiar':
          copiarFichero($origen,$destino);
          break;

        case 'renombrar':
          renombrarFichero($origen,$destino);
          break;

        case 'borrar':
          borrarFichero($origen);
          break;
          }
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
?>
