<?php
require_once '../ds/AccesoDB.php';
require_once '../util/Util.php';

class CuentaDAO {

	/*
	 * $rec["cliente"] -> Codigo del cliente
	 * $rec["empl"] -> Codigo del empleado
	 * $rec["importe"] -> Importe de apertura
	 * $rec["clave"] -> Clave de la cuenta
	 * $rec["moneda"] -> Moneda
	 * $rec["sucu"] -> Codigo de sucursal
	 * Retorna el codigo de la cuenta
	*/
	public function crear($rec) {
		$pdo = null;
		try {
			$pdo = AccesoDB::getPDO();
			$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
			$pdo->beginTransaction();
			// Generar el codigo de cuenta
			$query = "select int_sucucontcuenta as cont from sucursal
				where chr_sucucodigo = ?";
			$stm = $pdo->prepare($query);
			$stm->execute( array( $rec["sucu"] ) );
			$rec2 = $stm->fetch();
			$cont = $rec2["cont"] + 1;
			$query = "update sucursal set int_sucucontcuenta = ?
				where chr_sucucodigo = ?";
			$stm = $pdo->prepare($query);
			$stm->execute( array( $cont, $rec["sucu"] ) );
			$codCuenta = $rec["sucu"] . str_pad("$cont", 5, "0", STR_PAD_LEFT);
			// Insertar Cuenta
			$query = "insert into cuenta(chr_cuencodigo,chr_monecodigo,chr_sucucodigo,
				chr_emplcreacuenta,chr_cliecodigo,dec_cuensaldo,dtt_cuenfechacreacion,
				vch_cuenestado,int_cuencontmov,chr_cuenclave) values(?,?,?,?,?,?,
				sysdate(),'ACTIVO',1,?)";
			$stm = $pdo->prepare($query);
			$stm->bindParam(1,$codCuenta);
			$stm->bindParam(2,$rec["moneda"]);
			$stm->bindParam(3,$rec["sucu"]);
			$stm->bindParam(4,$rec["empl"]);
			$stm->bindParam(5,$rec["cliente"]);
			$stm->bindParam(6,$rec["importe"]);
			$stm->bindParam(7,$rec["clave"]);
			$stm->execute();
			// Insertar Movimiento
			$query = "insert into movimiento(chr_cuencodigo,int_movinumero,
				dtt_movifecha,chr_emplcodigo,chr_tipocodigo,dec_moviimporte,
				chr_cuenreferencia) values(?,1,sysdate(),?,'001',?,null)";
			$stm = $pdo->prepare($query);
			$stm->bindParam(1,$codCuenta);
			$stm->bindParam(2,$rec["empl"]);
			$stm->bindParam(3,$rec["importe"]);
			$stm->execute();
			// Confirmar Transacción
			$pdo->commit();
			return $codCuenta;
		} catch (Exception $e) {
			try {
				$pdo->rollBack();
			} catch (Exception $exc) {
			}
			Util::rigistrarLog($e, $query);
			throw $e;
		}
	}


	/*
	*  Estructura del Registro:
	*   $rec["cuenta"] -> Codigo de cuenta
	*   $rec["importe"] -> Importe del depósito
	*   $rec["empl"] -> Código del empleado
	*/
	function deposito($rec) {
		try {
			$pdo = AccesoDB::getPDO();
			$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, TRUE);
			// Preparar la ejecución del procedimiento
			$query = "CALL usp_deposito(?,?,?)";
			$stm = $pdo->prepare($query);
			// Asignar los parámetros
			$stm->bindParam(1,$rec['cuenta']);
			$stm->bindParam(2,$rec['importe']);
			$stm->bindParam(3,$rec['empl']);
			// Ejecutar el procedimiento
			$stm->execute();
			// Obtener el estado
			$row = $stm->fetch();
			if( $row['state'] == -1 ) {
				throw new PDOException($row['message']);
			}
		} catch ( PDOException $e ) {
			throw $e;
		}
	}

	/*
	*  Estructura del Registro:
	*   $rec["cuenta"] -> Codigo de cuenta
	*   $rec["importe"] -> Importe del depósito
	*   $rec["clave"] -> Clave de la cuenta
	*   $rec["empl"] -> Código del empleado
	*/
	function retiro($rec) {
		try {
			$pdo = AccesoDB::getPDO();
			$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, TRUE);
			// Preparar la ejecución del procedimiento
			$query = "CALL usp_retiro(?,?,?,?)";
			$stm = $pdo->prepare($query);
			// Asignar los parámetros
			$stm->bindParam(1,$rec['cuenta']);
			$stm->bindParam(2,$rec['importe']);
			$stm->bindParam(3,$rec['clave']);
			$stm->bindParam(4,$rec['empl']);
			// Ejecutar el procedimiento
			$stm->execute();
			// Obtener el estado
			$row = $stm->fetch();
			if( $row['state'] == -1 ) {
				throw new PDOException($row['message']);
			}
		} catch ( PDOException $e ) {
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
	function transferencia($rec) {
		try {
			$pdo = AccesoDB::getPDO();
			$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, TRUE);
			// Preparar la ejecución del procedimiento
			$query = "CALL usp_transferencia(?,?,?,?,?)";
			$stm = $pdo->prepare($query);
			// Asignar los parámetros
			$stm->bindParam(1,$rec['cuenta1']);
			$stm->bindParam(2,$rec['cuenta2']);
			$stm->bindParam(3,$rec['clave1']);
			$stm->bindParam(4,$rec['importe']);
			$stm->bindParam(5,$rec['empl']);
			// Ejecutar el procedimiento
			$stm->execute();
			// Obtener el estado
			$row = $stm->fetch();
			if( $row['state'] == -1 ) {
				throw new PDOException($row['message']);
			}
		} catch ( PDOException $e ) {
			throw $e;
		}
	}

	/*
	 * Retorna los movimientos de una cuenta
	*/
	function consultaMovimientos($cuenta) {
		try {
			$pdo = AccesoDB::getPDO();
			// Preparar la ejecución del procedimiento
			$query = "select * from movimiento where chr_cuencodigo = ?";
			$stm = $pdo->prepare($query);
			// Asignar valor al parámetro
			$stm->bindParam(1,$cuenta);
			// Ejecutar Consulta
			$stm->execute();
			// Obtener lista de movimientos
			$lista = $stm->fetchAll();
			return $lista;
		} catch ( PDOException $e ) {
			throw $e;
		}
	}

	/*
	 * Retorna el saldo de una cuenta
	*/
	function consultaSaldo($cuenta) {
		try {
			$pdo = AccesoDB::getPDO();
			// Preparar la ejecución del procedimiento
			$query = "select dec_cuensaldo from cuenta where chr_cuencodigo = ?";
			$stm = $pdo->prepare($query);
			// Asignar valor al parámetro
			$stm->bindParam(1,$cuenta);
			// Ejecutar Consulta
			$stm->execute();
			// Obtener el resultado
			$saldo = null;
			if( $stm->rowCount() > 0 ) {
				$saldo = $stm->fetchColumn();
			}
			return $saldo;
		} catch ( PDOException $e ) {
			throw $e;
		}
	}
}
?>