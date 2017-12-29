<?php
session_start();

require_once '../model/LogonModel.php';
require_once '../util/Session.php';

$action = $_REQUEST["action"];
$controller = new LogonController();
$target = call_user_func(array($controller,$action));
header("location: $target");
return;

class LogonController {

	public function doProcesar(){
		try {
			// Datos
			$usuario = $_REQUEST["usuario"];
			$clave = $_REQUEST["clave"];
			// Proceso
			$model = new LogonModel();
			$rec = $model->validar($usuario, $clave);
			Session::setAttribute("empleado", $rec);
			$recRpta["state"] = 1;
			$recRpta["message"] = "Proceso ok.";
		} catch (Exception $e) {
			$recRpta["state"] = -1;
			$recRpta["message"] = $e->getMessage();
		}
		Session::setAttribute( "rpta", $recRpta );
		return "../view/showRpta.php";
	}
}
?>