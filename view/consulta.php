<?php
session_start();

require_once '../util/Session.php';
require_once '../util/Util.php';

if( ! Session::existsAttribute("empleado") ) {
	header("location: logon.php");
	return;
}

$lista = Session::getAttribute2('lista');
$saldo = Session::getAttribute2('saldo');
$error = Session::getAttribute2('error');
$msg = Session::getAttribute2('msg');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<title>Consulta</title>
	</head>
	<body>
		<h2>Consulta de Movimientos</h2>
		<form name="form1" method="post" action="../controller/CuentaController.php">
			<input type="hidden" name="action" value="doConsulta"/>
			Cuenta:
			<input name="cuenta" type="text" class="campoEdicion" id="cuenta" size="10" maxlength="8">
			<input name="btnConsultar" type="submit" class="boton" id="btnConsultar" value="Consultar">
		</form>
		<?php if ($lista) { ?>
		<div id="divResultado">
			<table width="400" border="1" cellspacing="0">
				<tr class="TablaDato">
					<td>Cuenta</td>
					<td colspan="2"><?php echo $lista[0]['chr_cuencodigo'] ?></td>
					<td>Saldo</td>
					<td><?php echo $saldo; ?></td>
				</tr>
				<tr class="tablaTitulo">
			    <td width="61">Nro.Mov.</td>
					<td width="47">Tipo</td>
					<td width="81">Fecha</td>
					<td width="88">Importe</td>
					<td width="101">Ref.</td>
				</tr>
				<?php foreach( $lista as $row ) { ?>
				<tr class="TablaDato">
					<td><?php echo $row['int_movinumero'] ?></td>
					<td><?php echo $row['chr_tipocodigo'] ?></td>
					<td><?php echo $row['dtt_movifecha'] ?></td>
					<td><?php echo $row['dec_moviimporte'] ?></td>
					<td><?php echo Util::nullToSpace($row['chr_cuenreferencia']) ?></td>
				</tr>
				<?php } ?>
			</table>
		</div>
			<?php } ?>
		<div class="mensajeError" id="divError"><?php echo $error; ?></div>
		<p><?php echo $msg; ?></p>
	</body>
</html>
