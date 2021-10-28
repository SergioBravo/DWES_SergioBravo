<?php
  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
      echo "<title>php ejemplo</title>";
    echo "</head>";
    echo "<body>";
      echo "<table border=1>";
        echo "<tr>";
          echo "<th>Nombre</th>";
          echo "<th>Apellido1</th>";
          echo "<th>Apellido2</th>";
          echo "<th>Fecha de nacimiento</th>";
          echo "<th>Localidad</th>";
        echo "</tr>";
        #PRINCIPIO DEL CODIGO
        $datos = fopen("../fichero/alumnos.txt","r");//Abrimos el fichero y nos situamos al inicio en modo lectura
        $nfilas = 0;

        while(!feof($datos)){
          $alumno = fgets($datos);
          $datosAlumno = explode("##",$alumno);
          $nombre = $datosAlumno[0];
          $apellido1 = $datosAlumno[1];
          $apellido2 = $datosAlumno[2];
          $fecha = $datosAlumno[3];
          $localidad = $datosAlumno[4];
          echo "<tr>";
            echo "<td>".$nombre."</td>";
            echo "<td>".$apellido1."</td>";
            echo "<td>".$apellido2."</td>";
            echo "<td>".$fecha."</td>";
            echo "<td>".$localidad."</td>";
          echo "</tr>";
          $nfilas++;
        }
        fclose($datos);//Cerramos el fichero
        #FINAL DEL CODIGO
      echo "</table>";
      echo "<h2>El fichero tiene $nfilas filas</h2>";
    echo "</body>";
  echo "</html>";
 ?>
