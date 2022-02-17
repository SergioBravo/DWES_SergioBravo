<?php
  if (isset($error)) {//En caso de existir la variable error
    switch ($error) {
      case 1:
        echo "<h2>Se deben introducir las fechas</h2>";
        break;
      case 2:
        echo "<h2>".$datosCliente[0]." ".$datosCliente[1]." no tiene patines alquilados en estas fechas </h2>";
        break;
      case 3:
        echo "<h2>No hay productos en el carrito</h2>";
        break;
      case 4:
        echo "<h2>No se puede realizar el alquiler su saldo es inferior a 10€</h2>";
        break;
    }
  }
  else if(isset($crearTabla)) {
      ?>
      <table border=1>
        <tr>
          <th>Matricula</th>
          <th>Fecha inicio</th>
          <th>Fecha fin</th>
        </tr>
        <?php
          for ($i=0; $i < $size; $i+=3) {//Recorremos el array "ventas" y vamos mostrando los resultados en una tabla
            echo "<tr>";
            echo "<td>$consultar[$i]</td>";
            echo "<td>".$consultar[$i+1]."</td>";
            echo "<td>".$consultar[$i+2]."</td>";
            echo "</tr>";
            }
         ?>
      </table>
      <?php
    }
  else {
 ?>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
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

 <p><a href = "../controlador/conCerrarSesion">Cerrar Sesion</a></p>

</body>

</html>
<?php } ?>
