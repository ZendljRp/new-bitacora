<?php
require_once '../dao/UsuarioDAO.php';

class LoginModel {

    public function validar($usuario, $clave){
        try {
            $dao = new UsuarioDAO();
            $rec = $dao->consultarPorUsuario($usuario);
            if( $rec == NULL ){
                throw new Exception("Usuario no existe.");
            }
            if( $rec["vch_userclave"] != $clave ){
                throw new Exception("Clave incorrecta.");
            }
            return $rec;
        }catch (Exception $e) {
            throw $e;
        }
    }

}