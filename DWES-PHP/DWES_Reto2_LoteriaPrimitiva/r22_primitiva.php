<?php
include './funciones/r22Funciones.php';
echo "<html>";
echo "<head>";
	echo "<meta charset=utf-8>";
	echo "<title>Primitiva HTML</title>";
	echo "<link rel=stylesheet href=\"./css/r22.css\">";
echo "</head>";
echo "<body>";
	echo "<img src=./imagenes/primitiva.jpg>";
	echo "<form method=post action=".htmlspecialchars($_SERVER["PHP_SELF"]).">";
	echo "<p>Fecha del sorteo <input type='date' name='fechasorteo' size=15><br>";
	echo "<p>Recaudación Sorteo <input type='text' name='recaudacion' size=10><br>";
		echo "<p>Pulsa para generar combinación ganadora: <input type=submit value=Combinacion name=combinacion></p>";
	echo "</form>";
echo "</body>";
echo "</html>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {//Con esto comprobamos que se pulsa el botón "submit"
	if (empty($_POST['fechasorteo']) || empty($_POST['recaudacion'])) {
		echo "<h1>DATOS INSUFICIENTES: Revisar Fecha o Premio</h1>";
	}
	else {
		$fecha = cambiarFormatoFecha($_POST['fechasorteo']);//Recogemos la fecha del campo fecha
		$combinacion = generarCombinacion();//Recogemos le array con la combinación ganadora

		echo "<pre><span class=gris>Lotería Primitiva de España</span> / Sorteo      ".$fecha."</pre>";
		mostrarCombinacion($combinacion);

		$aciertos = verAciertos($combinacion);//Guardamos el array de aciertos
		$participantes = participantesSorteo();//Guardamos el número de participantes
		echo "<p>Apuestas jugadas: <b>$participantes<b></p>";
		echo "<ul>";
			echo "<li>Acertantes 6 números: <b>".$aciertos[6]."</b></li>";
			echo "<li>Acertantes 5 números: <b>".$aciertos[5]."</b></li>";
			echo "<li>Acertantes 4 números: <b>".$aciertos[4]."</b></li>";
			echo "<li>Acertantes 3 números: <b>".$aciertos[3]."</b></li>";
			echo "<li>Acertantes Reintegros: <b>".$aciertos[7]."</b></li>";
			echo "<li>Sin premio 2 números: <b>".$aciertos[2]."</b></li>";
			echo "<li>Sin premio 1 números: <b>".$aciertos[1]."</b></li>";
			echo "<li>Sin premio 0 números: <b>".$aciertos[0]."</b></li>";
		echo "</ul>";

		$premio = $_POST['recaudacion'];
		gestionarPremios($premio);
	}
}
 ?>
