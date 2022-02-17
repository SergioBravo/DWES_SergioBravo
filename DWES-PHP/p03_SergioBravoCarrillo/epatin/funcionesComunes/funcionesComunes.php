<?php
  include "./econfig.php";
  function test_input($data) {//Limpiamos los datos que nos pasan
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  function abrirConexion() {//Devolvemos la conexión con el servidor si ha sido posible realizarla si no mostramos un mensaje
    $servername = DB_SERVER;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;
    $dbname = DB_DATABASE;

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

  function cerrarConexion($conn) {
    $conn = null;//Cerramos la conexión
  }

  function sacarDatosCliente($dni,$conn) {//Le pasamos el dni de un cliente y la conexión a la bdd y devolvemos el nombre que corresponde a dicho dni
    try {
      $datos = array();
      $stmt = $conn->prepare("SELECT nombre,apellido,saldo FROM eclientes WHERE dni = '$dni'");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
          $datos[0] = $row["nombre"];
          $datos[1] = $row["apellido"];
          $datos[2] = $row["saldo"];
       }
       return $datos;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }
 ?>
