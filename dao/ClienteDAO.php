<?php
require_once '../ds/AccesoDB.php';

class ClienteDAO {
	
	/*
	 *	Retorna el listado de todos los clientes
	*/
	public function consultarTodos() {
		try {
			$pdo = AccesoDB::getPDO();
			$query = "select * from cliente";
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