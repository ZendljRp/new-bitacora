<?php
session_start();

require_once '../util/Session.php';

if( ! Session::existsAttribute("empleado") ) {
	header("location: logon.php");
	return;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<script type="text/javascript" src="../ajax/ajax.js"></script>
		<script type="text/javascript" src="../js/apertura.js"></script>
		<title></title>
	</head>
	<body onLoad="initPage()">
		<h2>Apertura de Cuenta</h2>
		<form name="form1" method="post" action="">
			<table width="237">
				<tr>
					<td width="65">Cliente</td>
					<td width="160">
						<div id="divCliente">
							<select name="cliente" class="campoEdicion" id="cliente">
								<option value="001">Gustavo</option>
								<option value="002">Claudia</option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>Moneda</td>
					<td>
						<div id="divMoneda">
							<select name="moneda" id="moneda">
								<option value="01">Moneda 1</option>
								<option value="02">Moneda 2</option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>Importe</td>
					<td><input name="importe" type="text" class="campoEdicion" id="importe" size="10" maxlength="10"></td>
				</tr>
				<tr>
					<td>Clave</td>
					<td><input name="clave" type="password" class="campoEdicion" id="clave" size="10" maxlength="6"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input onClick="crearCuenta()" name="btnCrear" type="button" class="boton" id="btnCrear" value="Crear Cuenta">					</td>
				</tr>
			</table>
		</form>
		<div id="divError" class="mensajeError"></div>
	</body>
</html>