<?php
  session_start();
  session_unset();
  session_destroy();
?>
<html>
  <head>
    <meta charset="UTF-8"/>
    <title>Cerrar sesion</title>
  </head>
  <body>
    <p>Has Cerrado Sesion</p>
    <p><a href="../php/comlogincli.php">Volver a pagina de login</a></p>
  </body>
</html>
