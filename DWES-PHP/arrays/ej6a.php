<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $uno = ["Bases Datos", "Entornos Desarrollo", "Programación"];
      $dos = ["Sistemas Informáticos","FOL","Mecanizado"];
      $tres = ["Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces","Inglés"];

      #UNIMOS LOS ARRAYS UNSANOD LA FUNCION ARRAY_MERGE()
      $union = array_merge($uno, $dos, $tres);

      for ($i=0; $i < count($union); $i++) {#Quitamos el valor mecanizado
        if ($union[$i] == "Mecanizado")unset($union[$i]);
      }

      $reves = array_reverse($union);#Le damos la vuelta al array

      echo "<h2>Array al reves y quitando la asignatura \"Mecanizado\"</h2>";
      for ($i=0; $i < count($reves); $i++) {
        echo $reves[$i]."|";
      }
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
