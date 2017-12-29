<?php

require_once '../ds/AccesoDB.php';

class MonedaDAO {

	/*
	 *	Retorna el listado de las monedas
	*/
	public function consultarTodos() {
		try {
			$pdo = AccesoDB::getPDO();
			$query = "select * from moneda";
			$stm = $pdo->query($query);
			$lista = $stm->fetchAll();
			$stm = null;
			return $lista;
		} catch (Exception $e) {
			throw $e;
		}
	}
}
?>