<?php
include "prog.php";
?>
<?php
$pregunta  = array("Cuanto es 2+2","De que colores conforman la bandera de mexico","cuanto es 3*4","Qiuen invento microsof","cuantos dias tiene una semana");
$respuesta = array("4","3colores","12","BillG.","7dias");
$numero= $_POST['numero'];



if ($numero >=1 && $numero <=5) {
	$comparo=$respuesta[$numero-1];
	print($comparo);

	session_start();
	$_SESSION['regreso']= $numero['numero'];
	$_SESSION['regreso2']= $comparo;
	$pregunta2=$pregunta[$numero-1];
	echo "<form action='prog3.php' method='post' source='this'> $pregunta2".": "."<input type='text' name='respuesta2' size='1'>"."  "."<input type='submit' value='Aceptar'></form>";
	echo "<p>"; 
    echo "<br>";
} else{
	echo "no esta en el rango";

}
?>
