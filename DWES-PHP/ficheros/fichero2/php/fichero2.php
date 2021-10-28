<?php
$valores = explode('-', $_POST['fecha']);//Dividimos la fecha en partes con el metodo explode usando como separador "-" y nos la da en formato aaaa mm dd
if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){//Formato del checkdate mm dd aaaa
  $ruta = "../fichero/alumnos.txt";
  $datosAlumno = $_POST['nombre']."##".$_POST['apellido1']."##".$_POST['apellido2']."##".$_POST['fecha']."##".$_POST['localidad'];//Creamos una linea completa con los separadores para los datos del alumno

  if (file_exists($ruta)){$datosAlumno = "\n".$datosAlumno;}
  else {$datosAlumno = $datosAlumno;}

  $datos = fopen("../fichero/alumnos.txt","a");//Creamos el fichero y lo ponemos en modo "Write"
  fwrite($datos,$datosAlumno);//Escribimos en el fichero el contenido de la caja nombre
  fclose($datos);//Cerramos el fichero

  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
      echo "<title>php ejemplo</title>";
    echo "</head>";
    echo "<body>";
      echo "<h1 style=\"top:50%;left:30%;position:absolute\";>Se ha añadido el alumno ".$_POST['nombre']." al fichero alumnos.txt</h1>";
    echo "</body>";
  echo "</html>";
} else {echo "formato de fecha incorrecto";}
 ?>
