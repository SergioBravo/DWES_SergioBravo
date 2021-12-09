<?php
  include '../funciones/funcionesempcambiodpto.php';
  //Abrimos la conexión
  $conn = abrirConexion();
?>

<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Cambiar departamento a empleado</title>
  </head>
  <body>
    <h1>Cambiar departamento a empleado</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>Empleado:
      <select name=empleado>
      <?php
          //Creamos el select de los empleados
          selectEmpleado($conn)
       ?>
     </select>
    </p>

    <p>Departamento:
      <select name=departamento>
        <?php
          //Creamos el select de los departamentos
            selectDepartamento($conn)
       ?>
     </select>
    </p>
    <p><input type=submit name=cambiar value=Cambiar></p>
    </form>
  </body>
</html>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empleado = $_POST['empleado'];
    $departamento = $_POST['departamento'];
    //Logica de negocio
    PonerFechaFin($empleado,$conn);
    cambiarDepEmp($empleado,$departamento,$conn);
    //Cerramos conexión
    cerrarConexion($conn);
  }
 ?>
