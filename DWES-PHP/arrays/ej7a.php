<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
       $alumnos = array ("Ana"=>19, "Sergio"=>22, "Carlos"=>31, "Dani"=>25, "Bea"=>28);#Definimos un array asociativo

       echo "<h2>Array asociativo desordenado</h2>";
       foreach($alumnos as $clave => $valor) {#Mostramos el contenido
         echo "Alumno: ".$clave." Edad: ".$valor;
         echo "<br>";
       }

       next($alumnos);//Avanzamos el puntero una posición
       echo "Segundo elemento del array: ".$alumnos[key($alumnos)]."<br>";//Sacamos el valor actual de la posición del array
       next($alumnos);//Repetimos el proceso
       echo "Siguiente elemento del array: ".$alumnos[key($alumnos)]."<br>";
       echo "Ultimo valor del array: ".end($alumnos)."<br>";

       asort($alumnos);#Ordenamos el array de menor a mayor edad

       echo "<h2>Array asociativo ordenado</h2>";
       foreach($alumnos as $clave => $valor) {#Mostramos el contenido
         echo "Alumno: ".$clave." Edad: ".$valor;
         echo "<br>";
       }

       echo "Primer elemento del array: ".reset($alumnos)."<br>";
       echo "Ultimo valor del array: ".end($alumnos)."<br>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
