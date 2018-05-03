<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form action="" method="post">
 Escribe un numero: <input type="text" name="numero">
<br>
<br>
 Seleccione a convertir: <select method="post" name="conversion">
 	<option>Hexadecimal</option><option>Binario</option></select>
<br>
<br>
<input type="submit" value"convertir">
<?php
if(isset($_POST['numero']) && isset($_POST['conversion'])){
include "binario.php";
}
?>
</form>
</body>
</html>
