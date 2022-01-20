<?php
  include '../funciones/funcionescomaltacli.php';
  //Abrimos la conexión
  $conn = abrirConexion();
 ?>
<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Alta Cliente</title>
  </head>
  <body>
    <h1>Alta Cliente</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>NIF: <input type=text name=nif placeholder="NIF"></p>
    <p>Nombre: <input type=text name=nombre placeholder="Nombre"></p>
    <p>Apellido: <input type=text name=apellido placeholder="Apellido"></p>
    <p>CP: <input type=text name=cp placeholder="CP"></p>
    <p>Direccion: <input type=text name=direccion placeholder="Direccion"></p>
    <p>Ciudad: <input type=text name=ciudad placeholder="Ciudad"></p>
    <p><input type=submit name=alta value=Alta></p>
    </form>
    <p><a href="../index.html">Volver al menu</a></p>
  </body>
</html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Limpiamos los parametros
    $nif = test_input($_POST['nif']);
    $nombre = test_input($_POST['nombre']);
    $apellido = test_input($_POST['apellido']);
    $cp = test_input($_POST['cp']);
    $direccion = test_input($_POST['direccion']);
    $ciudad = test_input($_POST['ciudad']);
    //Logica de negocio
    $compNif = preg_match('/[0-9]{8}[A-Z]/', $nif);//Expresión regular que comprueba el nif
    if ($compNif == 1) {
      altaCliente($nif,$nombre,$apellido,$cp,$direccion,$ciudad,$conn);
    }
    else {
      echo "Formato de NIF incorrecto";
    }
    //Cerramos conexión
    cerrarConexión($conn);
  }
 ?>
