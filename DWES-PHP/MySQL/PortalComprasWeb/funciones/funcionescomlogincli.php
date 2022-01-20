<?php
  function test_input($data) {//Limpiamos los datos que nos pasan
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  function abrirConexion() {//Devolvemos la conexión con el servidor si ha sido posible realizarla si no mostramos un mensaje
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname="comprasweb";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

  function cerrarConexión($conn) {
    $conn = null;//Cerramos la conexión
  }

  function comprobarInicio($nombre,$contraseña,$conn) {
    try {
      $valido = false;
      $stmt = $conn->prepare("SELECT NOMBRE,CLAVE FROM CLIENTE WHERE NOMBRE = '$nombre'");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      foreach($stmt->fetchAll() as $row) {
        if ($row['CLAVE'] == $contraseña && $row['NOMBRE'] == $nombre) {$valido = true;}
      }

     return $valido;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

  function sacarNif($nombre,$contraseña,$conn) {
    try {
      $valido = false;
      $stmt = $conn->prepare("SELECT NIF FROM CLIENTE WHERE NOMBRE = '$nombre' AND CLAVE = '$contraseña'");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      foreach($stmt->fetchAll() as $row) {
        $nif = $row['NIF'];
      }

     return $nif;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
?>
