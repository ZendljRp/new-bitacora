<?php
session_start();

require_once '../model/LoginModel.php';
require_once '../util/Session.php';

$action = $_REQUEST["action"];
$controller = new LoginController();
$target = call_user_func(array($controller,$action));
header("location: $target");
return;

class LoginController {

    public function doProcesar(){
        try {
            // Datos
            $usuario = $_REQUEST["username"];
            $clave   = $_REQUEST["userpassword"];
            // Proceso
            $model = new LoginModel();
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