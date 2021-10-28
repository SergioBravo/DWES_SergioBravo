<?php
  $valores = explode('-', $_POST['fecha']);//Dividimos la fecha en partes con el metodo explode usando como separador "-" y nos la da en formato aaaa mm dd
	if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[1])){//Comprobamos que hay 3 valores mm dd aaaa y que sea una fecha real con la función checkdate
    $nombre = $_POST['nombre'];
    $apellido1= $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $fecha = $_POST['fecha'];
    $localidad = $_POST['localidad'];
    $datos = fopen("../fichero/alumnos.txt","a");//Creamos el fichero y lo ponemos en modo "Write/Read" y nos situamos al inicio

    $fila = str_pad($nombre,40," ",STR_PAD_LEFT)."".
            str_pad($apellido1,40," ",STR_PAD_LEFT)."".
            str_pad($apellido2,41," ",STR_PAD_LEFT)."".
            str_pad($fecha,9," ",STR_PAD_LEFT)."".
            str_pad($localidad,26," ",STR_PAD_LEFT)."\n";
    fwrite($datos,$fila);//Escribimos la fila
    fclose($datos);//Cerramos el fichero

    echo "<html lang=es dir=ltr>";
      echo "<head>";
        echo "<meta charset=utf-8>";
        echo "<title>php ejemplo</title>";
      echo "</head>";
      echo "<body>";
        echo "<h1 style=\"top:50%;left:30%;position:absolute\";>Se ha añadido el alumno $nombre al fichero</h1>";
      echo "</body>";
    echo "</html>";
  }else {echo "Formato de fecha incorrecto";}



 ?>
