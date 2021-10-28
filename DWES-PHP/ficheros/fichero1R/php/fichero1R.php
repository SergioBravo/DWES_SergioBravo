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
        $linea = fgets($datos);
        $nfilas = 0;

        while(!feof($datos)){
          echo "<tr>";
            echo "<td>".substr($linea,0,40)."</td>";
            echo "<td>".substr($linea,41,40)."</td>";
            echo "<td>".substr($linea,82,39)."</td>";
            echo "<td>".substr($linea,121,10)."</td>";
            echo "<td>".substr($linea,134,26)."</td>";
          echo "</tr>";
          $linea = fgets($datos);
          $nfilas++;
        }
        fclose($datos);//Cerramos el fichero
        #FINAL DEL CODIGO
      echo "</table>";
      echo "<h2>El fichero tiene $nfilas filas</h2>";
    echo "</body>";
  echo "</html>";
 ?>
