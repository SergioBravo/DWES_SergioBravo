<?php
include('./funciones.php');
  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
      echo "<title>php ejemplo</title>";
    echo "</head>";
    echo "<body>";
      #PRINCIPIO CODIGO
        $ruta = "../texto/".$_POST['ruta'];//Recogemos la ruta del fichero
        $seleccion = $_POST['seleccion'];
        $linea = $_POST['linea'];
        $nlinea = $_POST['vlinea'];

        if (!file_exists($ruta)){echo "<h1>No existe el fichero</h1>";}//Comprobamos que exisra el fichero que nos pasan
        else {
          switch ($seleccion) {
            case 'fichero':
              MostrarFichero($ruta);
              break;

            case 'ulinea':
              MostrarLinea($ruta,$linea);
              break;

            case 'nlinea':
              MostrarLineas($ruta,$nlinea);
              break;
          }
        }
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
?>
