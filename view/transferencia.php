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
		<script type="text/javascript" src="../js/transferencia.js"></script>
		<title>Transferencia</title>
	</head>
	<body>
		<h2>Transferencia</h2>
		<form name="form1" method="post" action="">
			<table width="242" cellspacing="0">
				<tr>
					<td width="117">Cuenta Origen</td>
					<td width="119"><input name="cuenta1" type="text" class="campoEdicion" id="cuenta1" size="10" maxlength="8"></td>
				</tr>
				<tr>
					<td>Importe</td>
					<td><input name="importe" type="text" class="campoEdicion" id="importe" size="10" maxlength="10"></td>
				</tr>
				<tr>
					<td>Clave</td>
					<td><input name="clave1" type="text" class="campoEdicion" id="clave1" size="10" maxlength="6"></td>
				</tr>
				<tr>
					<td>Cueta Destino</td>
					<td><input name="cuenta2" type="text" class="campoEdicion" id="cuenta2" size="10" maxlength="8"></td>
				</tr>
			</table>
			<p>
				<input onclick="hacerTransferencia()" name="btnProcesar" type="button" class="boton" id="btnProcesar" value="Procesar">
			</p>
		</form>
		<div class="mensajeError" id="divError"></div>
	</body>
</html>
