<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      $calificaciones = array ("Sergio" => array("php" => 9,"ingles" => 10,"diw" => 8,"daw" => 9),
                      "Ana" => array("php" => 8,"ingles" => 7,"diw" => 6,"daw" => 5),
                      "Carlos" => array("php" => 8,"ingles" => 9,"diw" => 8,"daw" => 4),
                      "Dani" => array("php" => 7,"ingles" => 8,"diw" => 9,"daw" => 10),
                      "Santiago" => array("php" => 8,"ingles" => 7,"diw" => 6,"daw" => 5),
                      "Bea" => array("php" => 3,"ingles" => 4,"diw" => 3,"daw" => 9),
                      "Patricia" => array("php" => 2,"ingles" => 5,"diw" => 2,"daw" => 9),
                      "Miranda" => array("php" => 2,"ingles" => 6,"diw" => 8,"daw" => 2),
                      "Felix" => array("php" => 1,"ingles" => 7,"diw" => 9,"daw" => 8),
                      "Pablo" => array("php" => 9,"ingles" => 8,"diw" => 10,"daw" => 9));
      //Mostramos el array
      echo "<h2>Tabla de notas por asignatura</h2>";
      foreach ($calificaciones as $alumno => $notas) {
        echo "Alumno: $alumno |";
        foreach ($notas as $asignatura => $nota) {
          echo "| $asignatura ==> $nota";
        }
        echo "<br>";
      }
      echo "-----------------------------------------------------------------------------------------------------------------------------------";
      //Mayor nota en cada asignatura
      $mphp = 0;$mingles = 0;$mdiw = 0;$mdaw = 0;
      foreach ($calificaciones as $alumno => $notas) {
        foreach ($notas as $asignatura => $nota) {
          if ($asignatura == "php" && $nota > $mphp)$mphp = $nota;
          if ($asignatura == "ingles" && $nota > $mingles)$mingles = $nota;
          if ($asignatura == "diw" && $nota > $mdiw)$mdiw = $nota;
          if ($asignatura == "daw" && $nota > $mdaw)$mdaw = $nota;
        }
      }
      echo "<p>La mayor nota en php es: ".$mphp."</p>";
      echo "<p>La mayor nota en ingles es: ".$mingles."</p>";
      echo "<p>La mayor nota en diw es: ".$mdiw."</p>";
      echo "<p>La mayor nota en daw es: ".$mdaw."</p>";
      echo "-----------------------------------------------------------------------------------------------------------------------------------";

      //Alumno menor nota en cada asignatura
      //La variable a"Asignatura" guardara al alumno con la menor nota
      $miphp = 10;$miingles = 10;$midiw = 10;$midaw = 10;
      foreach ($calificaciones as $alumno => $notas) {
        foreach ($notas as $asignatura => $nota) {
          if ($asignatura == "php" && $nota < $miphp) {$aphp = $alumno;$miphp = $nota;}
          if ($asignatura == "ingles" && $nota < $miingles) {$aingles = $alumno;$miingles = $nota;}
          if ($asignatura == "diw" && $nota < $midiw) {$adiw = $alumno;$midiw = $nota;}
          if ($asignatura == "daw" && $nota < $midaw) {$adaw = $alumno;$midaw = $nota;}
        }
      }
      echo "<p>El alumno con la menor nota en php es: ".$aphp."</p>";
      echo "<p>El alumno con la menor nota en ingles es: ".$aingles."</p>";
      echo "<p>El alumno con la menor nota en diw es: ".$adiw."</p>";
      echo "<p>El alumno con la menor nota en daw es: ".$adaw."</p>";
      echo "-----------------------------------------------------------------------------------------------------------------------------------";

      //Mostramos la nota más baja de cada alumno
      $min = 10;
      foreach ($calificaciones as $alumno => $notas) {
        $min = 10;
        foreach ($notas as $asignatura => $nota) {
          if ($nota < $min) {$asig = $asignatura;$min = $nota;}
        }
        echo "<p>La menor nota del alumno ".$alumno." es en la asignatura ".$asig."</p>";
      }
      echo "-----------------------------------------------------------------------------------------------------------------------------------";

      //Mostramos la nota más alta de cada alumno
      $max = 0;
      foreach ($calificaciones as $alumno => $notas) {
        $max = 0;
        foreach ($notas as $asignatura => $nota) {
          if ($nota > $max){$asig = $asignatura;$max = $nota;}
        }
        echo "<p>La mayor nota del alumno ".$alumno." es en la asignatura ".$asig."</p>";
      }
      echo "-----------------------------------------------------------------------------------------------------------------------------------";

      //Mostramos la media por materia de todos los alumnos
      $sphp = 0;$singles = 0;$sdiw = 0;$sdaw = 0;
      foreach ($calificaciones as $alumno => $notas) {
        foreach ($notas as $asignatura => $nota) {
          if ($asignatura == "php")$sphp += $nota;
          if ($asignatura == "ingles")$singles += $nota;
          if ($asignatura == "diw")$sdiw += $nota;
          if ($asignatura == "daw")$sdaw += $nota;
        }
      }
      echo "<p>La media de las notas en php es: ".($sphp/10)."</p>";
      echo "<p>La media de las notas en ingles es: ".($singles/10)."</p>";
      echo "<p>La media de las notas en diw es: ".($sdiw/10)."</p>";
      echo "<p>La media de las notas en daw es: ".($sdaw/10)."</p>";
      echo "-----------------------------------------------------------------------------------------------------------------------------------<br>";

      //Mostramos la media por alumno de todos las materias
      foreach ($calificaciones as $alumno => $notas) {
        $suma = 0;
        foreach ($notas as $asignatura => $nota) {
          $suma += $nota;
        }
        echo "El alumno $alumno tiene una media de ".($suma/4)." en todas las asignaturas<br>";
      }
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
