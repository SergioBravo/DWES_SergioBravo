<?php
  include './funciones/funcionesempinfosal.php';
  //Abrimos la conexión
  $conn = abrirConexion();
?>

<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Información salario empleados por departamento</title>
  </head>
  <body>
    <h1>Información salario empleados por departamento</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>Departamento:
      <select name=departamento>
        <?php
          //Creamos el select de los departamentos
            selectDepartamento($conn)
       ?>
     </select>
    </p>
    <p><input type=submit name=ver value="Ver salario"></p>
    </form>
  </body>
</html>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departamento = $_POST['departamento'];
    //Mostrar salarios
    mostrarSalario($departamento,$conn);
    //Cerramos conexión
    cerrarConexion($conn);
  }
 ?>
