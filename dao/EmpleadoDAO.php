<?php
require_once '../ds/AccesoDB.php';

class EmpleadoDAO {

	/*
	*	Retorna los datos de un empleado según su nombre de usuario
	*/
	public function consultarPorUsuario($usuario) {
		try {
			$pdo = AccesoDB::getPDO();
			$query = "select * from empleado where vch_emplusuario = ?";
			$stm = $pdo->prepare($query);
			$stm->execute(array($usuario));
			$rec = $stm->fetch();
			if( ! $rec ) {
				$rec = null;
			}
			$stm = null;
			return $rec;
		} catch (Exception $e) {
			throw $e;
		}
	}

	/*
	*	Retorna el código de la sucursal donde labora un empleado
	*/
	public function consultarSucursal($codEmp) {
		try {
			$pdo = AccesoDB::getPDO();
			$query = "select chr_sucucodigo from asignado
				where chr_emplcodigo=? and dtt_asigfechabaja is null;";
			$stm = $pdo->prepare($query);
			$stm->execute(array($codEmp));
			$rec = $stm->fetch();
			$sucu = null;
			if( $rec ) {
				$sucu = $rec["chr_sucucodigo"];
			}
			$stm = null;
			return $sucu;
		} catch (Exception $e) {
			throw $e;
		}
	}
}
?>