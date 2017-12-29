<?php

session_start();
require_once '../util/Session.php';
$lista = Session::getAttribute2("monedas");
$error = Session::getAttribute2("error");

?>

<?php if( $lista ){ ?>
<select name="moneda" class="campoEdicion" id="moneda">
	<?php foreach( $lista as $rec) { ?>
	<option value="<?php echo($rec["chr_monecodigo"]); ?>">
		<?php echo("{$rec["vch_monedescripcion"]}"); ?>
	</option>
	<?php } ?>
</select>
<?php } ?>

<?php if( $error ) { ?>
<p class="mensajeError"><?php echo($error); ?></p>
<?php } ?>