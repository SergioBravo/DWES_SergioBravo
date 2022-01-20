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

  function optionsCategorias($conn) {
    try {
      $con = 0;
      $stmt = $conn->prepare("SELECT ID_CATEGORIA,NOMBRE FROM categoria");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
          $options[$con] = $row["ID_CATEGORIA"];
          $con++;
          $options[$con] = $row["NOMBRE"];
          $con++;
       }
       return $options;
    }
    catch(PDOException $e) {
        echo mostrarErrores($e);
    }
  }

  function altaProducto($nombre,$precio,$categoria,$conn) {//Le pasamos los datos del producto y generamos el id luego lo insertamos en productos
    try {//Intentamos insertar el campo
      $stmt = $conn->prepare("INSERT INTO producto (ID_PRODUCTO,NOMBRE,PRECIO,ID_CATEGORIA) VALUES (:codigo,:nombre,:precio,:categoria)");

      $ultimo = sacarUltimo($conn);
      $ultimo++;
      $codigo = "P".str_pad($ultimo,4,0,STR_PAD_LEFT);

      $stmt->bindParam(':codigo', $codigo);
      $stmt->bindParam(':nombre', $nombre);
      $precio = floatval($precio);
      $stmt->bindParam(':precio', $precio);
      $stmt->bindParam(':categoria', $categoria);
      $stmt->execute();//Ejecutamos el insert

      echo "Producto $nombre creado";
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: " . $e->getMessage();
    }
  }

  function sacarUltimo($conn) {
    try {
      $stmt = $conn->prepare("SELECT ID_PRODUCTO FROM producto");
      $stmt->execute();
      $ultimo = 0;

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados

	    foreach($stmt->fetchAll() as $row) {
        $numero = intval(substr($row["ID_PRODUCTO"],1,4));
        if ($numero > $ultimo) {$ultimo = $numero;}
      }

     return $ultimo;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
 ?>
