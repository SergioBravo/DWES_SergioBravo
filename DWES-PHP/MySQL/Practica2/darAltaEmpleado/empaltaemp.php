<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Alta Empleado</title>
  </head>
  <body>
    <h1>Alta Empleado</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>DNI: <input type=text name=dni placeholder="DNI"></p>
    <p>Nombre: <input type=text name=nombre placeholder="Nombre"></p>
    <p>Apellidos: <input type=text name=apellidos placeholder="Apellidos"></p>
    <p>Fecha Nacimiento: <input type=date name=fecha></p>
    <p>Salario: <input type=text name=salario placeholder="Salario"></p>
    <p>Departamento: <select name=departamento><?php
          include './funciones/funcionesPDO.php';
          //Abrimos la conexión
          $conn = abrirConexion();
          //Creamos el select de los departamentos
          selectDepartamentos($conn)
       ?></select></p>
    <p><input type=submit name=alta value=Alta></p>
    </form>
  </body>
</html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Limpiamos los parametros
    $dni = test_input($_POST['dni']);
    $nombre = test_input($_POST['nombre']);
    $apellidos = test_input($_POST['apellidos']);
    $fecha = test_input($_POST['fecha']);
    $salario = test_input($_POST['salario']);
    $cod_dpto = $_POST['departamento'];
    //Comprobamos que no nos pasen parametros vacios
    if (empty($dni) || empty($nombre) || empty($apellidos) || empty($fecha) || empty($salario)) {echo "Error: Faltan datos";}
    else {
      //Logica de negocio
      altaEmpleado($dni,$nombre,$apellidos,$fecha,$salario,$conn);//Creamos el empleados
      altaEmpDep($dni,$cod_dpto,$conn);
      //Cerramos conexión
      cerrarConexion($conn);
    }
  }
 ?>
