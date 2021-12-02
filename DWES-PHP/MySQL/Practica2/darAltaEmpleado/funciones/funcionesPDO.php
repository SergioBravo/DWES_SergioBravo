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
    $dbname="empleadosnn";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    catch(PDOException $e) {
        echo mostrarErrores($e);
    }
  }

  function cerrarConexion($conn) {$conn = null;}//Cerramos la conexión

  function selectDepartamentos($conn) {
    try {
      $stmt = $conn->prepare("SELECT * FROM departamento");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
  	    foreach($stmt->fetchAll() as $row) {
          echo "<option value=".$row["cod_dpto"].">".$row["cod_dpto"]." ".$row["nombre_dpto"]."</option>";
       }
    }
    catch(PDOException $e) {
        echo mostrarErrores($e);
    }
  }

  function altaEmpleado($dni,$nombre,$apellidos,$fecha,$salario,$conn) {//Le pasamos los datos del empleado y lo insertamos
    try {//Intentamos insertar el campo
      $stmt = $conn->prepare("INSERT INTO empleado(dni,nombre,apellidos,fecha_nac,salario) VALUES (:DNI,:NOMBRE,:APELLIDOS,:FECHA,:SALARIO)");
      //Definimos los parametros a insertar
      $stmt->bindParam(':DNI', $dni);
      $stmt->bindParam(':NOMBRE', $nombre);
      $stmt->bindParam(':APELLIDOS', $apellidos);
      $stmt->bindParam(':FECHA', $fecha);
      $stmt->bindParam(':SALARIO', $salario);
      $stmt->execute();//Ejecutamos el insert

      echo "<h1>Empleado creado</h1>";
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo mostrarErrores($e);
    }
  }

  function altaEmpDep($dni,$cod_dpto,$conn) {
    try {//Intentamos insertar el campo
      $stmt = $conn->prepare("INSERT INTO emple_depart(dni,cod_dpto,fecha_ini,fecha_fin) VALUES (:DNI,:COD,:FECHA_INI,:FECHA_FIN)");
      //Definimos los parametros a insertar
      $stmt->bindParam(':DNI', $dni);
      $stmt->bindParam(':COD', $cod_dpto);
      $fechaIni = date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s");//aaaa-mm-dd hh:mm:ss
      $stmt->bindParam(':FECHA_INI', $fechaIni);
      $fechaFin = null;
      $stmt->bindParam(':FECHA_FIN', $fechaFin);
      $stmt->execute();//Ejecutamos el insert
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo mostrarErrores($e);
    }
  }

  function mostrarErrores($e) {//Le pasamos el objeto exception y mostramos sus errores de una forma más comprensible
    $mensaje = "Error: ";

    switch ($e->getCode()) {
      case "23000":
        $mensaje.="Clave primaria duplicada";
        break;

      default:
        $mensaje.= $e->getMessage();
        break;
    }

    return $mensaje;
  }
 ?>
