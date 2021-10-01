<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $uno = ["Bases Datos", "Entornos Desarrollo", "Programación"];
      $dos = ["Sistemas Informáticos","FOL","Mecanizado"];
      $tres = ["Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces","Inglés"];

      #UNIMOS LOS ARRAYS SIN USAR FUNCIONES
      for ($i=0; $i < count($uno); $i++) {//Vamos a unir el primero
        $union[$i] = $uno[$i];
      }

      $posicion = count($union);#Para controlar la posicion en el array donde añadiremos el contenido
      for ($i=0; $i < count($dos); $i++) {//Vamos a unir el segundo
        $union[$posicion] = $dos[$i];
        $posicion++;
      }

      $posicion = count($union);#Para controlar la posicion en el array donde añadiremos el contenido
      for ($i=0; $i < count($tres); $i++) {//Vamos a unir el tercero
        $union[$posicion] = $tres[$i];
        $posicion++;
      }

      #UNIMOS LOS ARRAYS UNSANOD LA FUNCION ARRAY_MERGE()
      $union2 = array_merge($uno, $dos, $tres);

      #UNIMOS LOS ARRAYS USANDO LA FUNCION ARRAY_PUSH()
      $union3 = $uno;
      for ($i=0; $i < count($dos); $i++) {//Vamos a unir el segundo
        array_push($union3, $dos[$i]);
      }

      for ($i=0; $i < count($tres); $i++) {//Vamos a unir el tercero
        array_push($union3, $tres[$i]);
      }

      #MOSTRAMOS LOS RESULTADOS
      echo "<h2>Sin usar funciones</h2>";
      for ($i=0; $i < count($union); $i++) {
        echo $union[$i]."|";
      }
      echo "<br><h2>Usando la función array_merge()</h2>";
      for ($i=0; $i < count($union2); $i++) {
        echo $union2[$i]."|";
      }
      echo "<br><h2>Usando la función array_push()</h2>";
      for ($i=0; $i < count($union3); $i++) {
        echo $union3[$i]."|";
      }
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
