<?php

require_once '../ds/AccesoDB.php';

try {
	$pdo = AccesoDB::getPDO();
	$stm = $pdo->query("select * from cliente");
	foreach ($stm->fetchAll() as $rec) {
		echo("{$rec["vch_clienombre"]}<br>");
	}
} catch(Exception $e) {
	echo("Error: {$e->getMessage()}");
}


?>
