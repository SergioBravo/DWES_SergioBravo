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

  function altaCategoria($nombre,$conn) {//Le pasamos el nombre de la categoria y lo metemos en la tabla categoria
    try {//Intentamos insertar el campo
      $stmt = $conn->prepare("INSERT INTO categoria (ID_CATEGORIA,NOMBRE) VALUES (:codigo,:nombre)");

      $ultimo = sacarUltimo($conn);
      $ultimo++;
      $codigo = "C-".str_pad($ultimo,3,0,STR_PAD_LEFT);

      $stmt->bindParam(':codigo', $codigo);
      $stmt->bindParam(':nombre', $nombre);//Definimos el parametro a insertar
      $stmt->execute();//Ejecutamos el insert

      echo "Categoria $nombre creada";
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: " . $e->getMessage();
    }
  }

  function sacarUltimo($conn) {
    try {
      $stmt = $conn->prepare("SELECT ID_CATEGORIA FROM categoria");
      $stmt->execute();
      $ultimo = 0;

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados

	    foreach($stmt->fetchAll() as $row) {
        $numero = intval(substr($row["ID_CATEGORIA"],2,4));
        if ($numero > $ultimo) {$ultimo = $numero;}
      }

     return $ultimo;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
 ?>
