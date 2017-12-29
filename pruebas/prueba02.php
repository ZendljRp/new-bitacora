<?php
require_once '../dao/CuentaDAO.php';

$rec["cliente"] = "00001";
$rec["empl"] = "0001";
$rec["importe"] = 5000.0;
$rec["clave"] = "123456";
$rec["moneda"] = "02";
$rec["sucu"] = "007";

try {
	$dao = new CuentaDAO();
	$codigo = $dao->crear($rec);
	echo($codigo);
} catch (Exception $e) {
	echo($e->getMessage());
}

?>
