<?php
require_once '../ds/AccesoDB.php';

class UsuarioDAO {
    /*
    *	Retorna los datos del usuario según su nombre de usuario
    */
    public function consultarPorUsuario($usuario) {
        try {
            $pdo   = AccesoDB::getPDO();
            $query = "SELECT us.chr_emplcodigo, empl.vch_emplpaterno, empl.vch_emplnombre, empl.vch_emplarea, us.vch_userusuario, us.vch_userclave 
                FROM usuario AS us
                INNER JOIN empleado AS empl ON empl.chr_emplcodigo = us.chr_emplcodigo
                WHERE us.vch_userusuario = ?";
            $stm   = $pdo->prepare($query);
            $stm->execute(array($usuario));
            $rec = $stm->fetch();
            if( !$rec ) {
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
            $pdo   = AccesoDB::getPDO();
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