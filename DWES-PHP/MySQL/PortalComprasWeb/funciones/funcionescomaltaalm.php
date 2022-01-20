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

  function altaProducto($localidad,$conn) {//Pasamos la localidad, generamos el numero del almacen y lo guardamos en almacen
    try {//Intentamos insertar el campo
      $stmt = $conn->prepare("INSERT INTO almacen (NUM_ALMACEN,LOCALIDAD) VALUES (:codigo,:localidad)");

      $ultimo = sacarUltimo($conn);
      $codigo = $ultimo+10;

      $stmt->bindParam(':codigo', $codigo);
      $stmt->bindParam(':localidad', $localidad);
      $stmt->execute();//Ejecutamos el insert

      echo "Almacen creado en $localidad";
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: " . $e->getMessage();
    }
  }

  function sacarUltimo($conn) {
    try {
      $stmt = $conn->prepare("SELECT NUM_ALMACEN FROM almacen");
      $stmt->execute();
      $ultimo = 0;

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados

	    foreach($stmt->fetchAll() as $row) {
        $numero = intval($row["NUM_ALMACEN"]);
        if ($numero > $ultimo) {$ultimo = $numero;}
      }

     return $ultimo;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
 ?>
