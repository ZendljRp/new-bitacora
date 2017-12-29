<?php
session_start();

require_once '../util/Session.php';

if( ! Session::existsAttribute("empleado") ) {
	header("location: logon.php");
	return;
}
$emp = Session::getAttribute("empleado");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<title>EurekaBank</title>
		<script type="text/javascript">
			function initPage(){
				document.getElementById("work").style.display="none";
			}
			function cargarPagina( pagina ){
				document.getElementById("work").style.display="block";
				document.getElementById("work").src = pagina;
			}
		</script>
	</head>
	<body onload="initPage()">
		<h1>EurekaBank</h1>
		<p>Usuario: <?php echo($emp["vch_emplusuario"]); ?></p>
		<table width="600" border="1">
			<tr class="menu01">
				<td width="97"><a href="javascript: cargarPagina('apertura.php')">Apertura</a></td>
				<td width="98"><a href="javascript: cargarPagina('deposito.php')">Depósito</a></td>
				<td width="82"><a href="javascript: cargarPagina('retiro.php')">Retiro</a></td>
				<td width="132"><a href="javascript: cargarPagina('transferencia.php')">Transferencia</a></td>
				<td width="98"><a href="javascript: cargarPagina('consulta.php')">Consulta</a></td>
				<td width="53"><a href="salir.php">Salir</a></td>
			</tr>
		</table>
		<iframe id="work" width="600" height="400" frameborder="1"></iframe>
	</body>
</html>