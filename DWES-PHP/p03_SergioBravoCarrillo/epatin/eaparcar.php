<?php
  session_start();
  include "funcionesComunes/funcionesComunes.php";
  include "funciones/funcioneseaparcar.php";
  include "funciones/funcionesealquilar.php";
  $conn = abrirConexion();
  $carrito = $_SESSION['carrito'];
  $datosCliente = sacarDatosCliente($_SESSION['dni'],$conn);
 ?>
<html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a EPATIN</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
  </head>

  <body>
    <h1>Servicio de ALQUILER PATINETES ELÉCTRICOS</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - APARCAR PATINETE </div>
		<div class="card-body">



	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">

    <B>Bienvenido/a: </B><?php echo $datosCliente[0]." ".$datosCliente[1] ?><BR><BR>
		<B>Saldo Cuenta: </B><?php echo $datosCliente[2] ?> €<BR><BR>

			<B>PATINETES ALQUILADOS: </B><select name="patinetes" class="form-control">
        <?php
          $size = count($carrito);

          for ($i=0; $i < $size; $i++) {
            echo "<option value=".$carrito[$i].">".$carrito[$i]."</option>";
          }
         ?>
			</select>
		<BR><BR>
		<div>
			<input type="submit" value="Aparcar Patinete" name="devolver" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href = "funciones/cerrarSesion.php">Cerrar Sesion</a>

  </body>

</html>
<?php
if ($_POST) {//Cuando hagamos un submit del formulario
  //-----------Devolver------------------------
  if (!empty($_POST["devolver"])) {
    //LOGICA DE NEGOCIO
    if (empty($_POST['patinetes']) || count($carrito) == 0) {
      echo "<p>No hay patines para devolver</p>";
    }
    else {
      //LIMPIAMOS LOS DATOS
      $patin = test_input($_POST['patinetes']);
      //PROGRAMA
      devolverPatin($_SESSION['dni'],$patin,$_SESSION['fecha'],$conn);
      actualizarDisponible($carrito[array_search($patin,$carrito)],$conn,"S");
      array_splice($carrito,array_search($patin,$carrito),1);
      echo "<h2>Patinete Aparcado</h2>";
      $_SESSION['carrito'] = $carrito;
    }
  }
  //------------Volver---------------------
  if (!empty($_POST["volver"])) {
    header("location: einicio.php");
  }
  //CERRAMOS LA CONEXIÓN
  cerrarConexion($conn);
}
 ?>
