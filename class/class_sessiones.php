<?php
class Session{
    /**
     * Metodo para inicar las sessiones
     */
    public static function iniciarSessiones(){
        if(!isset($_SESSION))session_start();
        if(!isset($_SESSION['id']))$_SESSION['id'] = "";
    }
    public static function verificarSesssiones(){
        $salida = 1;
        if(!isset($_SESSION['id']))$salida = 0;
        if($_SESSION['id'] == "")$salida = 0;
        return $salida;
    }

    public static function sessionRecapchat(){
        if( !isset($_SESSION['stop']))$_SESSION['stop'] = 0;
    }

    public static function sessionToken(){
        if(! isset($_SESSION['token'])) $_SESSION['token'] = "";
    }

    public static function sessionCodigo(){
        if(! isset($_SESSION['codigo'])) $_SESSION['codigo'] = "";
    }

    public static function EliminarRango(){
       if(isset($_SESSION['rango'])){
            unset($_SESSION['rango']);
        }
    }

    public static function sessionHistorial(){
        if(! isset($_SESSION['historial'])){
            $_SESSION['historial'] = "";
            return 1;
        } unset($_SESSION['codigo_ejecutado']);
    }

    public static function eliminarHistorial(){
        if(isset($_SESSION['historial'])){
            unset($_SESSION['historial']);
        } 
    }

    public static function reinicarEnvio(){
        $_SESSION['correo'] = "";
        $_SESSION['departamento'] = "";
        $_SESSION['municipios'] = "";
        $_SESSION['telefono'] = "";
        $_SESSION['barrio'] = "";
        $_SESSION['direccion'] = "";
        if(isset($_SESSION['cantidades']))$_SESSION['cantidades'] = 0;
     }
    /**
     * Metodo para eliminar las sessiones
     */
    public static function destruirSessiones($des = null){
        include_once("class_user.php");
        Usuarios::actualizarEstadoUser(2, $_SESSION['id']);
        session_destroy();
        setcookie(session_name(), "", time() - 3600, "/");
        if($des === 1){
            return "../../index.php";
        }else{
            header("location: ../../index.php");
            exit();
        }
    }

}