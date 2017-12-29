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
		<script type="text/javascript" src="../js/deposito.js"></script>
		<title>Depósito</title>
	</head>
	<body>
		<h2>Depósito</h2>
		<form name="form1" method="post" action="">
			<table width="187">
				<tr>
					<td width="101">Nro. Cuenta</td>
					<td width="74">
						<input name="cuenta" type="text" class="campoEdicion" id="cuenta" size="10" maxlength="8">
					</td>
				</tr>
				<tr>
					<td>Importe</td>
					<td>
						<input name="importe" type="text" class="campoEdicion" id="importe" size="10" maxlength="10">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input onclick="hacerDeposito()" name="btnProcesar" type="button" class="boton" id="btnProcesar" value="Procesar">
					</td>
				</tr>
			</table>
		</form>
		<div id="divError" class="mensajeError"></div>
	</body>
</html>
