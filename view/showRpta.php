<?php

session_start();
require_once '../util/Session.php';

$rpta = Session::getAttribute2("rpta");
$salida = json_encode($rpta);
echo($salida);

?>