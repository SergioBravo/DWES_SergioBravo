<?php
  //Llamamos al fichero que nos conecta a la base de datos
  require_once("../db/db.php");
  session_start();
  require_once "../modelo/modelDatosCliente.php";
  $conn = abrirConexion();
  $datosCliente = sacarDatosCliente($_SESSION['dni'],$conn);

  //Llamada a la vista para poder visualizar el inicio
  require_once("../vista/viewInicio.php");
 ?>
