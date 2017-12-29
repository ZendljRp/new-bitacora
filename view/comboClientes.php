<?php
session_start();

require_once '../util/Session.php';

$lista = Session::getAttribute2("clientes");
$error = Session::getAttribute2("error");

?>

<?php if( $lista ){ ?>
<select name="cliente" class="campoEdicion" id="cliente">
	<?php foreach( $lista as $rec) { ?>
	<option value="<?php echo($rec["chr_cliecodigo"]); ?>">
		<?php echo("{$rec["vch_clienombre"]} {$rec["vch_cliepaterno"]}"); ?>
	</option>
	<?php } ?>
</select>
<?php } ?>

<?php if( $error ) { ?>
<p class="mensajeError"><?php echo($error); ?></p>
<?php } ?>