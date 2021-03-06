<?php
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
        echo "Error: ".$e->getMessage();
    }
  }

  function cerrarConexion($conn) {$conn = null;}//Cerramos la conexión

  function selectDepartamento($conn) {
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
        echo "Error: ".$e->getMessage();
    }
  }

  function verHistorico($departamento,$conn) {
    try {
      $con = 0;
      $departamento = "\"".$departamento."\"";
      $stmt = $conn->prepare("SELECT nombre FROM empleado,departamento,emple_depart
                              WHERE empleado.dni = emple_depart.dni AND departamento.cod_dpto = emple_depart.cod_dpto
                              AND departamento.cod_dpto = $departamento AND emple_depart.fecha_fin IS NOT NULL");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          echo "<li>".$row["nombre"]."</li>";
          $con++;
       }
       if ($con == 0) {echo "<li>No existe Historico del departamento</li>";}
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }
 ?>
