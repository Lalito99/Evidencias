<?php
/*
Archivo:  tabpacientes.php
Objetivo: consulta general sobre pacientes y acceso a operaciones detalladas
Autor:    
*/
include_once("modelo\Usuario.php");
include_once("modelo\PacienteHospitalario.php");
session_start();
$sErr="";
$sNom="";
$arrPersHosp=null;
$oUsu = new Usuario();
$oPersHosp = new PacienteHospitalario();
	/*Verificar que exista sesión*/
	if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
		$oUsu = $_SESSION["usu"];
		$sNom = $oUsu->getPersHosp()->getNombre();
		try{
			$arrPersHosp = $oPersHosp->buscarTodos();
			//Buscar lista de pacientes
		}catch(Exception $e){
			//Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
			error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
			$sErr = "Error en base de datos, comunicarse con el administrador";
		}
	}
	else
		$sErr = "Falta establecer el login";
	
	if ($sErr == ""){
		include_once("cabecera.html");
		include_once("menu.php");
		include_once("aside.html");
	}
	else{
		header("Location: error.php?sError=".$sErr);
		exit();
	}
?>
		<section>
			<h3>Pacientes</h3>
			<form name="formTablaGral" method="post" action="abcPacPersona.php">
				<input type="hidden" name="txtClave">
				<input type="hidden" name="txtOpe">
			<table border="1">
					<tr>
						<td>Clave</td>
						<td>Nombre</td>
						<td>Fecha De Nacimiento</td>
						<td>Sexo</td>
						<td>Alergia</td>
						
						<td>Operaci&oacute;n</td>
					</tr>
					<?php
						if ($arrPersHosp!=null){
							foreach($arrPersHosp as $oPersHosp){
					?>
					<tr>
						<td class="llave"><?php echo $oPersHosp->getIdPac(); ?></td>
						<td><?php echo $oPersHosp->getNombreCompleto(); ?></td>
						<td><?php echo $oPersHosp->getFechaNacim()->format('Y-m-d'); ?></td>
						<td><?php echo $oPersHosp->getSexo(); ?></td>
						<td><?php echo $oPersHosp->getsAlergia(); ?></td>
						
						<td>
							<input type="submit" name="Submit" value="Modificar" onClick="txtClave.value=<?php echo $oPersHosp->getIdPac(); ?>; txtOpe.value='m'">
							<input type="submit" name="Submit" value="Borrar" onClick="txtClave.value=<?php echo $oPersHosp->getIdPac(); ?>; txtOpe.value='b'">
						</td>
					</tr>
					<?php 
							}//foreach
						}else{
					?>     
					<tr>
						<td colspan="3">No hay datos</td>
					</tr>
					<?php
						}
					?>
				</table>
				<input type="submit" name="Submit" value="Crear Nuevo" onClick="txtClave.value='-1';txtOpe.value='a'">

			</form>
		</section>
<?php
include_once("pie.html");
?>