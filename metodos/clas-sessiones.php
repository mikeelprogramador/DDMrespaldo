<?php
class Session{
    /**
     * Metodo para inicar las sessiones
     */
    public static function iniciarSessiones(){
        if(!isset($_SESSION))session_start();
        if(!isset($_SESSION['id']))$_SESSION['id'] = "";
    }
    /**
     * Metodo para eliminar las sessiones
     */
    public static function destruirSessiones(){
        include_once("clas-verific.php");
        Verificaciones::actualizarEstadoUser(2, $_SESSION['id']);
        session_destroy();
        setcookie(session_name(), "", time() - 3600, "/");
        header("location: ../../index.php");
    }

}