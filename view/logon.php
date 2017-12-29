<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<script type="text/javascript" src="../ajax/ajax.js"></script>
		<script type="text/javascript" src="../js/logon.js"></script>
		<title></title>
	</head>
	<body>
		<h1>EurekaBank</h1>
		<h2>Ingreso al Sistema</h2>
		<form name="form1" method="post" action="">
			<table width="328">
				<tr>
					<td width="73">Usuario</td>
					<td width="102"><input name="usuario" type="text" class="campoEdicion" id="usuario" size="15" maxlength="15"></td>
					<td width="137">&nbsp;</td>
				</tr>
				<tr>
					<td>Clave</td>
					<td><input name="clave" type="password" class="campoEdicion" id="clave" size="15" maxlength="15"></td>
					<td><input onclick="funcLogon()" name="btnIngresar" type="button" class="boton" id="btnIngresar" value="Ingresar"></td>
				</tr>
			</table>
		</form>
		<div class="mensajeError" id="divError"></div>
	</body>
</html>
