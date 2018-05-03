<?php
$Respuesta=$_POST['respuesta2'];
session_start();
$comparar=$_SESSION['regreso2'];
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="prog.php" source="this"> 
<?php
if ($Respuesta==$comparar) {
	echo "Acertado<br>";
}else{
	echo "No acertado<br>";
}
?>
Deseas Regresar:<br><input type="submit" value="Si"><br>
</form>
<input id="nad" type="submit" value="No">
</body>
</html>
