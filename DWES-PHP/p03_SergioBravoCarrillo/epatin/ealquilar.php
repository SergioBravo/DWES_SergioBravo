<?php
  session_start();
  include "funcionesComunes/funcionesComunes.php";
  include "funciones/funcionesealquilar.php";
  $conn = abrirConexion();
  $datosCliente = sacarDatosCliente($_SESSION['dni'],$conn);
  $_SESSION['fecha'] = date('Y-m-d h:i:s', time());

  if(!isset($_SESSION['carrito'])) {//En caso de que no este creado el carrito creamos la variable de sesión
    $_SESSION['carrito'] = array();
    $carrito = $_SESSION['carrito'];
  }
  else {$carrito = $_SESSION['carrito'];}
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
		<div class="card-header">Menú Usuario - ALQUILAR PATINETES</div>
		<div class="card-body">


	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">

    <B>Bienvenido/a: </B><?php echo $datosCliente[0]." ".$datosCliente[1] ?><BR><BR>
		<B>Saldo Cuenta: </B><?php echo $datosCliente[2] ?> €<BR><BR>

		<B>PATINETES disponibles </B><?php echo $_SESSION['fecha'] ?><BR>

			<select name="patinetes" class="form-control">
        <?php
          $optionsPatines = optionsPatines($conn);
          $size = count($optionsPatines);

          for ($i=0; $i < $size; $i++) {
            echo "<option value=".$optionsPatines[$i].">".$optionsPatines[$i]."</option>";
          }
         ?>
			</select>


		<BR> <BR><BR><BR><BR><BR>
		<div>
			<p>
        <input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
  			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
  			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
      </p>
      <p><input type="submit" value="Volver" name="volver" class="btn btn-warning disabled"></p>
		</div>
	</form>
	<!-- FIN DEL FORMULARIO -->

<?php
  if ($_POST) {//Cuando se realize cualquier submitt del formulario
    //LIMPIAMOS LOS DATOS
    $patin = test_input($_POST['patinetes']);
    //LOGICA DE NEGOCIO
    //--------------Agregar al carrito---------------------------
    if (!empty($_POST['agregar'])) {
      if (!comprobarCarrito($carrito,$patin)) {//Comprobamos que el patin no se haya agregado ya al carrito
        array_push($carrito,$patin);
        echo "Patin añadido al carrito";
        actualizarDisponible($patin,$conn,"N");
      }
      else {
        echo "Ya se ha añadido ese producto al carrito";
      }
      $_SESSION['carrito'] = $carrito;
    }
    //--------------Alquilar patines---------------------------------
    if (!empty($_POST['alquilar'])) {
      if (count($carrito) == 0) {
        echo "No hay productos en el carrito";
      }
      else if ($datosCliente[2] <= 10) {//En caso de tener menos de 10€ en la cuenta no puede alquilar
        echo "<h2>No se puede realizar el alquiler su saldo es inferior a 10€</h2>";
      }
      else {
        $size = count($carrito);
        for ($i=0; $i < $size; $i++) {//Alquilamos cada uno de los patines
          alquilarPatin($_SESSION['dni'],$carrito[$i],$_SESSION['fecha'],$conn);
        }
        echo "<h2>Se han alquilado los patines</h2>";
      }
    }
    //---------------Vaciar el carrito--------------------------------------
    if (!empty($_POST['vaciar'])) {
      $size = count($carrito);
      for ($i=0; $i < $size; $i++) {//Volvemos a dejar disponibles todos los productos del carrito
        actualizarDisponible($carrito[$i],$conn,"S");
      }
      $_SESSION['carrito'] = array();
      echo "El carrito se ha vaciado";
    }
    //-----------Volver------------------------
    if (!empty($_POST["volver"])) {//Volvemos al menu de usuario
      header("location: einicio.php");
    }
  }
 ?>
 <p><a href = "funciones/cerrarSesion.php">Cerrar Sesion</a></p>
 </body>
</html>
