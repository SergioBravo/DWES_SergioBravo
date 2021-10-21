<?php
include './funciones/creartabla.php';
  echo "<html>";
  echo "<head>";
    echo "<meta charset=utf-8>";
    echo "<title>Formulario Alumnos</title>";
  echo "</head>";
  echo "<body>";
  #PRINCIPIO CODIGO
  $mensaje = "";

  if (empty($_POST['nombre']))$mensaje .= "Falta el nombre |";
  if (empty($_POST['email']))$mensaje .= "Falta el email |";
  if (empty($_POST['sexo']))$mensaje .= "Falta el sexo |";

  if (empty($mensaje)) {
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];

    crearTabla($nombre,$apellido1,$apellido2,$email,$sexo);
  }else {
    echo "<h1 align=center>$mensaje</h1>";
  }
    #FINAL CODIGO
  echo "</body>";
  echo "</html>";
 ?>
