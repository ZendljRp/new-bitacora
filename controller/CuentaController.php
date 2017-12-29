<?php
session_start();

require_once '../model/CuentaModel.php';
require_once '../util/Session.php';

$action = $_REQUEST["action"];
$controller = new CuentaController();
$target = call_user_func(array($controller,$action));
header("location: $target");
return;

class CuentaController {

	public function doTraerClientes() {
		try {
			$model = new CuentaModel();
			$lista = $model->consultarClientes();
			Session::setAttribute("clientes", $lista);
		} catch (Exception $e) {
			Session::setAttribute("error", $e->getMessage());
		}
		return "../view/comboClientes.php";
	}

	public function doTraerMonedas() {
		try {
			$model = new CuentaModel();
			$lista = $model->consultarMonedas();
			Session::setAttribute("monedas", $lista);
		} catch (Exception $e) {
			Session::setAttribute("error", $e->getMessage());
		}
		return "../view/comboMonedas.php";
	}

	/*
	 * $rec["cliente"] -> Codigo del cliente
	 * $rec["importe"] -> Importe de apertura
	 *$rec["clave"] -> Clave de la cuenta
	 * $rec["moneda"] -> Moneda
	*/
	public function doCrearCuenta() {
		try {
			// Datos
			$rec["cliente"] = $_REQUEST["cliente"];
			$rec["importe"] = $_REQUEST["importe"];
			$rec["clave"] = $_REQUEST["clave"];
			$rec["moneda"] = $_REQUEST["moneda"];
			// Proceso
			$model = new CuentaModel();
			$nroCuenta = $model->crear($rec);
			$recRpta["state"] = 1;
			$recRpta["message"] = "Numero de cuenta: $nroCuenta";
		} catch (Exception $e) {
			$recRpta["state"] = -1;
			$recRpta["message"] = $e->getMessage();
		}
		Session::setAttribute( "rpta", $recRpta );
		return "../view/showRpta.php";
	}

	/*
	*  Estructura del Registro:
	*   $rec["cuenta"] -> Codigo de cuenta
	*   $rec["importe"] -> Importe del depósito
	*/
	public function doDeposito() {
		try {
			// Datos
			$rec["cuenta"] = $_REQUEST["cuenta"];
			$rec["importe"] = $_REQUEST["importe"];
			// Proceso
			$model = new CuentaModel();
			$nroCuenta = $model->deposito($rec);
			$recRpta["state"] = 1;
			$recRpta["message"] = "Proceso ejecutado correctamente.";
		} catch (Exception $e) {
			$recRpta["state"] = -1;
			$recRpta["message"] = $e->getMessage();
		}
		Session::setAttribute( "rpta", $recRpta );
		return "../view/showRpta.php";
	}


	/*
	*  Estructura del Registro:
	*   $rec["cuenta"] -> Codigo de cuenta
	*   $rec["importe"] -> Importe del depósito
	*   $rec["clave"] -> Clave de la cuenta
	*/
	public function doRetiro() {
		try {
			// Datos
			$rec["cuenta"] = $_REQUEST["cuenta"];
			$rec["importe"] = $_REQUEST["importe"];
			$rec["clave"] = $_REQUEST["clave"];
			// Proceso
			$model = new CuentaModel();
			$nroCuenta = $model->retiro($rec);
			$recRpta["state"] = 1;
			$recRpta["message"] = "Proceso ejecutado correctamente.";
		} catch (Exception $e) {
			$recRpta["state"] = -1;
			$recRpta["message"] = $e->getMessage();
		}
		Session::setAttribute( "rpta", $recRpta );
		return "../view/showRpta.php";
	}

	/*
	*  Estructura del Registro:
	*   $rec["cuenta1"] -> Código de cuenta origen
	*   $rec["cuenta2"] -> Código de cuenta destino
	*   $rec["clave1"] -> Clave de cuenta origen
	*   $rec["importe"] -> Importe a transferir
	*/
	public function doTransferencia() {
		try {
			// Datos
			$rec["cuenta1"] = $_REQUEST["cuenta1"];
			$rec["cuenta2"] = $_REQUEST["cuenta2"];
			$rec["importe"] = $_REQUEST["importe"];
			$rec["clave1"] = $_REQUEST["clave1"];
			// Proceso
			$model = new CuentaModel();
			$nroCuenta = $model->transferencia($rec);
			$recRpta["state"] = 1;
			$recRpta["message"] = "Proceso ejecutado correctamente.";
		} catch (Exception $e) {
			$recRpta["state"] = -1;
			$recRpta["message"] = $e->getMessage();
		}
		Session::setAttribute( "rpta", $recRpta );
		return "../view/showRpta.php";
	}

	public function doConsulta(){
		try {
			// Datos
			$cuenta = $_REQUEST["cuenta"];
			// Proceso
			$model = new CuentaModel();
			$lista = $model->consultarMovimientos($cuenta);
			$saldo = $model->consultaSaldo($cuenta);
			Session::setAttribute("lista", $lista);
			Session::setAttribute("saldo", $saldo);
		} catch (Exception $e) {
			Session::setAttribute("error", $e->getMessage());
		}
		return "../view/consulta.php";
	}
}
?>