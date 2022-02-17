<?php
  session_start();
  include "funcionesComunes/funcionesComunes.php";
  include "funciones/funcioneseconsultar.php";
  //Abrimos la conexión
  $conn = abrirConexion();
  $datosCliente = sacarDatosCliente($_SESSION['dni'],$conn);
 ?>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
  </head>

 <body>
    <h1>Servicio de ALQUILER PATINETES ELÉCTRICOS</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - CONSULTA ALQUILERES </div>
		<div class="card-body">




	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">

    <B>Bienvenido/a: </B><?php echo $datosCliente[0]." ".$datosCliente[1] ?><BR><BR>
		<B>Saldo Cuenta: </B><?php echo $datosCliente[2] ?> €<BR><BR>

			 Fecha Desde: <input type='date' name='fechadesde' value='' size=10 placeholder="fechadesde" class="form-control">
			 Fecha Hasta: <input type='date' name='fechahasta' value='' size=10 placeholder="fechahasta" class="form-control"><br><br>

		<div>
			<input type="submit" value="Consultar" name="consultar" class="btn btn-warning disabled">

			<input type="submit" value="Volver" name="Volver" class="btn btn-warning disabled">

		</div>
	</form>
	<!-- FIN DEL FORMULARIO -->

<?php
  if ($_POST) {//Cuando hagamos un submit del formulario
    //-----------Consultar------------------------
    if (!empty($_POST["consultar"])) {
      //LIMPIAMOS LOS PARAMETROS
      $inicio = test_input($_POST['fechadesde']);
      $fin = test_input($_POST['fechahasta']);
      $consultar = ConsultarPatines($_SESSION['dni'],$inicio,$fin,$conn);
      $size = count($consultar);
      //LOGICA DEL PROGRAMA
      if (empty($_POST['fechadesde']) || empty($_POST['fechahasta'])) {
        echo "Se deben introducir las fechas";
      }
      else if ($size == 0) {echo "<h2>".$datosCliente[0]." ".$datosCliente[1]." no tiene patines alquilados en estas fechas </h2>";}
      else {
        ?>
        <table border=1>
          <tr>
            <th>Matricula</th>
            <th>Fecha inicio</th>
          </tr>
          <?php
          for ($i=0; $i < $size; $i+=2) {//Recorremos el array "ventas" y vamos mostrando los resultados en una tabla
            echo "<tr>";
            echo "<td>$consultar[$i]</td>";
            echo "<td>".$consultar[$i+1]."</td>";
            echo "</tr>";
          }
          ?>
        </table>
        <?php
      }//Cierre del else
    }
    //------------Volver---------------------
    if (!empty($_POST["Volver"])) {
      header("location: einicio.php");
    }
    //CERRAMOS LA CONEXIÓN
    cerrarConexion($conn);
  }
 ?>

 <p><a href = "funciones/cerrarSesion">Cerrar Sesion</a></p>

</body>

</html>
