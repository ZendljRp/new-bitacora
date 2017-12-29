<?php
require_once '../dao/CuentaDAO.php';

$rec["cuenta"] = "00100001";
$rec["empl"] = "0001";
$rec["importe"] = 500.0;

try {
	$dao = new CuentaDAO();
	$codigo = $dao->deposito($rec);
	echo'Proceso ok.';
} catch (Exception $e) {
	echo $e->getMessage();
}

?>