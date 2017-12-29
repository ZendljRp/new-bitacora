<?php

require_once '../dao/ClienteDAO.php';
require_once '../dao/MonedaDAO.php';
require_once '../dao/EmpleadoDAO.php';
require_once '../dao/CuentaDAO.php';

class CuentaModel {

	/*
	 * $rec["cliente"] -> Codigo del cliente
	 * $rec["empl"] -> Codigo del empleado
	 * $rec["importe"] -> Importe de apertura
	 *$rec["clave"] -> Clave de la cuenta
	 * $rec["moneda"] -> Moneda
	 * $rec["sucu"] -> Codigo de sucursal
	 * Retorna el codigo de la cuenta
	*/
	public function crear($rec) {
		try {
			if( $rec['importe'] <= 0 ) {
				throw new Exception("El importe debe ser una cantidad positiva.");
			}
			$recEmp = Session::getAttribute("empleado");
			$rec["empl"] = $recEmp["chr_emplcodigo"];
			$objEmp = new EmpleadoDAO();
			$rec["sucu"] = $objEmp->consultarSucursal($rec["empl"]);
			$objCuen = new CuentaDAO();
			$nroCuenta = $objCuen->crear($rec);
			return $nroCuenta;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function consultarClientes() {
		try {
			$dao = new ClienteDAO();
			$lista = $dao->consultarTodos();
			return $lista;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function consultarMonedas() {
		try {
			$dao = new MonedaDAO();
			$lista = $dao->consultarTodos();
			return $lista;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function consultarMovimientos( $cuenta ) {
		try {
			$dao = new CuentaDAO();
			$lista = $dao->consultaMovimientos($cuenta);
			return $lista;
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function consultaSaldo( $cuenta ) {
		try {
			$dao = new CuentaDAO();
			$saldo = $dao->consultaSaldo($cuenta);
			return $saldo;
		} catch (Exception $e) {
			throw $e;
		}
	}

	/*
	*  Estructura del Registro:
	*   $rec["cuenta"] -> Codigo de cuenta
	*   $rec["importe"] -> Importe del depósito
	*   $rec["empl"] -> Código del empleado
	*/
	public function deposito($rec) {
		try {
			if( $rec['importe'] <= 0 ) {
				throw new Exception("El importe debe ser una cantidad positiva.");
			}
			$recEmp = Session::getAttribute("empleado");
			$rec["empl"] = $recEmp["chr_emplcodigo"];
			$dao = new CuentaDAO();
			$dao->deposito($rec);
		} catch (Exception $e) {
			throw $e;
		}
	}

	/*
	*  Estructura del Registro:
	*   $rec["cuenta"] -> Codigo de cuenta
	*   $rec["importe"] -> Importe del depósito
	*   $rec["empl"] -> Código del empleado
	*/
	public function retiro($rec) {
		try {
			if( $rec['importe'] <= 0 ) {
				throw new Exception("El importe debe ser una cantidad positiva.");
			}
			$recEmp = Session::getAttribute("empleado");
			$rec["empl"] = $recEmp["chr_emplcodigo"];
			$dao = new CuentaDAO();
			$dao->retiro($rec);
		} catch (Exception $e) {
			throw $e;
		}
	}

	/*
	*  Estructura del Registro:
	*   $rec["cuenta1"] -> Código de cuenta origen
	*   $rec["cuenta2"] -> Código de cuenta destino
	*   $rec["clave1"] -> Clave de cuenta origen
	*   $rec["importe"] -> Importe a transferir
	*   $rec["empl"] -> Código del empleado
	*/
	public function transferencia($rec) {
		try {
			if( $rec['importe'] <= 0 ) {
				throw new Exception("El importe debe ser una cantidad positiva.");
			}
			$recEmp = Session::getAttribute("empleado");
			$rec["empl"] = $recEmp["chr_emplcodigo"];
			$dao = new CuentaDAO();
			$dao->transferencia($rec);
		} catch (Exception $e) {
			throw $e;
		}
	}
}
?>