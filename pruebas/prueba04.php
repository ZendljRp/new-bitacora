<?php
require_once '../dao/CuentaDAO.php';

$rec["cuenta"] = "00500001";
$rec["empl"] = "0001";
$rec["importe"] = 1000.0;
$rec["clave"] = '123456';

try {
	$dao = new CuentaDAO();
	$codigo = $dao->retiro($rec);
	echo'Proceso ok.';
} catch (Exception $e) {
	echo $e->getMessage();
}

?>