<?php
require_once '../dao/EmpleadoDAO.php';

class LogonModel {

	public function validar($usuario, $clave){
		try {
			$dao = new EmpleadoDAO();
			$rec = $dao->consultarPorUsuario($usuario);
			if( $rec == NULL ){
				throw new Exception("Usuario no existe.");
			}
			if( $rec["vch_emplclave"] != $clave ){
				throw new Exception("Clave incorrecta.");
			}
			return $rec;
		}catch (Exception $e) {
			throw $e;
		}
	}

}
?>