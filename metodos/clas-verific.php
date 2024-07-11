<?php 
class Verificaciones{
    /**
     * Metodo verifica la gerarquia del usuario
     */
    public static function verificarPerfil($des,$id_user){
        include_once("modelo.php");
        $salida = "";
        $consulta = Model::sqlVerificarPerfil($des,$id_user);
        while($fila = $consulta->fetch_array()){
            $salida .= $fila[0];
        }
        return $salida;
    }
    /**
     * Metodo actualiza el estado del usuario
     */
    public static function actualizarEstadoUser($des,$id_user){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlActualizarEstadoUser($des,$id_user);
        if($consulta){
            $salida = 1;
        }
        return $salida;

    }
    /**
     * Meotdo busca el codifo del usuario
     */
    public static function buscarIdUsuario($email){
        include_once("modelo.php");
        $salida = 0; 
        $consulta = Model::sqlUsuario(2,$email);
        while($fila=$consulta->fetch_array()){
            $salida += $fila['id'];
        }
        return $salida;
    }

    public static function cargarImagen($img,$id_user){
        include_once("modelo.php");
        $consulta = Model::sqlActualizarImagen($img,$id_user);
    }
}